<?php
final class Scores extends Model{

    public static function deleteByUser($S_id): bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM Scores WHERE user_id = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

    public static function deleteByRoom($S_id): bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM Scores WHERE room_id = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }
}