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
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomId = '';
        do {
            for ($i = 0; $i < 6; $i++) {
                $randomId .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while(Rooms::checkIfExistsById($randomId));
        return $randomId;
    }

    public static function getLiterralStatus(bool $status):string{
        if ($status) {
            return "Démarrée";
        }
        return "Inactive";
    }
    public static function getScore(array $A_params):array{

        $P_db = Connection::initConnection();
        $S_sql = "SELECT user_id, score
                FROM scores s, rooms r
                WHERE r.id = :room_id
                AND user_id = ";

        foreach($A_params['id'] as $S_id){
            $S_sql .=  ":$S_id OR user_id = ";
            $A_paramBindValue[":$S_id"] = $S_id;
        }
        $S_sql = substr($S_sql, 0, -13);
        $S_sql .= " order by score ";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':room_id', $A_params['room_id'], PDO::PARAM_STR);

        
        foreach($A_paramBindValue as $key => $value){
            $P_sth->bindValue($key, $value, PDO::PARAM_STR);
        }

        $P_sth->execute();
        return $P_sth->fetchAll();
    }
}
