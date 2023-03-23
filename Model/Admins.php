<?php
final class Admins extends Model{

    public static function deleteByID($S_id): bool{
        if(!self::checkIfExistsById($S_id)){
            return false;
        }

        Rooms::deleteByAdmin($S_id);
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM Admins WHERE ID = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

}