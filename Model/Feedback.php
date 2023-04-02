<?php

/**
 * Model class to interact with the DB table Feedback
 *
 * @extends Model
 * @final
 */
final class Feedback extends Model{
    public static function deleteByUser($S_id): bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM Feedback WHERE user_id = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

    public static function deleteByRoom($S_id): bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM Feedback WHERE user_id = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

    public static function selectByRoom($S_id):array{
        $O_con = Connection::initConnection();
        $S_stmnt = "select rating , comment , u.name, u.lastname, f.user_id
        from feedback f , rooms r, users u
        WHERE f.room_id = :id
                and f.room_id = r.id
                and f.user_id = u.id";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $P_sth->execute();
        $O_con = null;
        return $P_sth->fetchAll();
    }
}