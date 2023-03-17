<?php

final class Rooms extends Model{
    public static function selectRoomsByAdmin(string $S_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM ROOMS WHERE admin_id = :admin_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':admin_id', $S_id, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }


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

    public static function getScore(array $A_params):array{

        $P_db = Connection::initConnection();
        $S_sql = "SELECT user_id, score, u.name, lastname, r.name room
                FROM scores s, rooms r, users u
                WHERE r.id = :room_id
                and user_id = u.id
                AND user_id = ";

        foreach($A_params['id'] as $S_id){
            $S_sql .=  ":$S_id OR user_id = ";
            $A_paramBindValue[":$S_id"] = $S_id;
        }
        $S_sql = substr($S_sql, 0, -13);
        $S_sql .= " order by score desc ";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':room_id', $A_params['room_id'], PDO::PARAM_STR);

        
        foreach($A_paramBindValue as $key => $value){
            $P_sth->bindValue($key, $value, PDO::PARAM_STR);
        }

        $P_sth->execute();
        return $P_sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
