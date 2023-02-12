<?php

final class Rooms extends Model{
    public static function selectRoomsByAdmin(string $S_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT * FROM ROOMS WHERE admin_id = :admin_id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':admin_id', $S_id, PDO::PARAM_INT);
        $P_sth->execute();
        return $P_sth->fetchAll();
    }

    public static function idAlreadyExists(string $S_id):bool {
        $P_db = Connection::initConnection();
        $S_sql = "SELECT ID FROM ROOMS WHERE id = :id";
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':id', $S_id, PDO::PARAM_INT);
        $P_sth->execute();
        return $P_sth->fetch();
    }

    public static function uniqueId():string{
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomId = '';
        for ($i = 0; $i < 6; $i++) {
            $randomId .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomId;
    }

    public static function passwordRoomGenerator():string{
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($alphabet), 0, 8);
    }
}