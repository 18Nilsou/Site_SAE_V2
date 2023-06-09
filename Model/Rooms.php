<?php

/**
 * Model class to interact with the DB table Rooms
 *
 * @extends Model
 * @final
 */
final class Rooms extends Model{

    /**
     * Delete rooms by admin
     *
     * @param $S_id
     * @return bool Whether the deletion was successful
     */
    public static function deleteByAdmin($S_id): bool{


        $A_rooms = self::selectRoomsByAdmin($S_id);
        foreach ($A_rooms as $A_room){
            Scores::deleteByRoom($A_room['id']);
            Feedback::deleteByRoom($A_room['id']);
            Whitelist::deleteByRoom($A_room['id']);
            Questions::deleteByRoom($A_room['id']);
        }

        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM ROOMS WHERE admin_id = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

    /**
     * Select rooms by admin
     *
     * @param string $S_id Admin ID
     *
     * @return array Rooms
     */
    public static function selectRoomsByAdmin(string $S_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM ROOMS WHERE admin_id = :admin_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':admin_id', $S_id, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    /**
     * Generate unique ID
     *
     * @return string Unique ID
     */
    public static function uniqueId():string{
        $S_characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $S_randomId = '';
        do {
            for ($i = 0; $i < 6; $i++) {
                $S_randomId .= $S_characters[rand(0, strlen($S_characters) - 1)];
            }
        } while(Rooms::checkIfExistsById($S_randomId));
        return $S_randomId;
    }

    /**
     * Get room status
     *
     * @param string $start_date Start date
     * @param string $end_date End date
     *
     * @return string Status
     */
    public static function getStatus($start_date=null, $end_date=null):string{
        date_default_timezone_set('Europe/Paris');
        if (!is_null($start_date) && !is_null($end_date)) {
            if ($start_date < date("Y-m-d H:i:s") && date("Y-m-d H:i:s") < $end_date) {
                return "Active";
            }
            return "Inactive";
        }
        return "Indeterminable";
    }

    /**
     * Get score of users
     *
     * @param array $A_params Parameters
     *
     * @return array Score
     */
    public static function getScore(array $A_params):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT user_id, score, u.name, lastname, r.name room
                FROM scores s, rooms r, users u
                WHERE s.room_id = :room_id
                and user_id = u.id
                and s.room_id = r.id
                AND (user_id = ";

        foreach($A_params['id'] as $S_id){
            $S_sql .=  ":$S_id OR user_id = ";
            $A_paramBindValue[":$S_id"] = $S_id;
        }
        $S_sql = substr($S_sql, 0, -13);
        $S_sql .= " ) order by score desc ";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':room_id', $A_params['room_id'], PDO::PARAM_STR);
        foreach($A_paramBindValue as $key => $value){
            $P_sth->bindValue($key, $value, PDO::PARAM_STR);
        }
        $P_sth->execute();
        return $P_sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getScoreRoom(array $A_params):array{

        $P_db = Connection::initConnection();
        $S_sql = "SELECT s.score, r.name room, s.user_id, u.name, u.lastname 
        FROM scores s, rooms r, users u 
        WHERE s.room_id = :room_id
        and s.room_id = r.id
        and s.user_id = u.id";

        $S_sql .= " order by score desc ";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':room_id', $A_params['room_id'], PDO::PARAM_STR);
        $P_sth->execute();

        return $P_sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
