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

    public static function topFive($S_id):array{
        $P_db = Connection::initConnection();
        $S_sql = "SELECT s.score, s.user_id, u.name, u.lastname 
        FROM scores s, rooms r, users u 
        WHERE s.room_id = :room_id
        and s.room_id = r.id
        and s.user_id = u.id
        order by score desc
        LIMIT 5";
        
        $P_sth = $P_db->prepare($S_sql);
        $P_sth->bindValue(':room_id', $S_id, PDO::PARAM_STR);
        $P_sth->execute();

        return $P_sth->fetchAll(PDO::FETCH_ASSOC);
    }
}