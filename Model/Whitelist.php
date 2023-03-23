<?php

final class Whitelist extends Model {
    public static function selectByRoom(string $S_room):array{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM Whitelist WHERE room_id = :room_id";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":room_id", $S_room, PDO::PARAM_STR);
        $O_sth->execute();
        return $O_sth-> fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteByRoomIdAndUserId(string $S_roomId, string $S_userId) {
        if(!self::checkIfExistsByRoomIdAndUserId($S_roomId, $S_userId)){
            return false;
        }
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM whitelist WHERE ROOM_ID = ? AND USER_ID = ? ";
        $P_sth = $O_con->prepare($S_stmnt);
        $B_state = $P_sth->execute(array($S_roomId, $S_userId));
        $O_con = null;
        return $B_state;
    }

    public static function checkIfExistsByRoomIdAndUserId(string $S_roomId, string $S_userId) {
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM whitelist WHERE ROOM_ID = ? AND USER_ID = ?";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute(array($S_roomId, $S_userId));
        return (!empty($P_sth -> fetchAll()));
    }

    public static function deleteByUser($S_id): bool{
        if(!self::checkIfExistsById($S_id)){
            return false;
        }
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM whitelist WHERE user_id = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }
}