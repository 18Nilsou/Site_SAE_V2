<?php


abstract class Model{

    public static function selectById($S_id) {
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class()." WHERE ID = ? ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute(array($S_id));
        $A_row = $P_sth->fetch(PDO::FETCH_ASSOC);
        $O_con = null;
        return $A_row;
    }

    public static function deleteByID($S_id) : bool{
        if(!self::checkIfExistsById($S_id)){
            return false;
        }
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM ".get_called_class()." WHERE ID = ? ";
        $P_sth = $O_con->prepare($S_stmnt);
        $B_state = $P_sth->execute(array($S_id));
        $O_con = null;
        return $B_state;
    }

    
    public static function create(Array $A_postParams) : bool{
        $O_con = Connection::initConnection();

        $S_keys = " ";
        $S_vals = " ";
        foreach (array_keys($A_postParams) as &$S_key){
            $S_keys .= $S_key.",";
            $S_vals .= "?,";
        }
        $S_keys[-1] = " ";
        $S_vals[-1] = " ";

        $S_stmnt = "INSERT INTO ".get_called_class()." ($S_keys) VALUES ($S_vals)";
        $P_sth = $O_con->prepare($S_stmnt);
        $O_con = null;
        $B_state = $P_sth->execute(array_values($A_postParams));
        return $B_state;
    }

    public static function updateById(Array $A_postParams, $S_id ) : bool{
        $O_con = Connection::initConnection();

        $S_keys = "";
        foreach (array_keys($A_postParams) as &$S_key){
            $S_keys.= $S_key."= ? ,";
        }
        $S_keys[-1] = " ";

        $S_stmnt = "UPDATE ".get_called_class()." SET ".$S_keys." WHERE ID = ?";
        $P_sth = $O_con->prepare($S_stmnt);
        array_push($A_postParams,$S_id);
        $B_state = $P_sth->execute(array_values($A_postParams));
        $O_con = null;
        return $B_state;
    }

    public static function selectHowMany() : int{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT count(*) FROM ".get_called_class();
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute();
        $A_row = $P_sth->fetch(PDO::FETCH_ASSOC);
        $O_con = null;
        return $A_row['count'];
    }

    public static function selectAll(): array{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class();
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute();
        $O_con = null;
        return $P_sth->fetchAll();
    }

    public static function checkIfExistsById($_id) : bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class()." WHERE ID = ? ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute(array($_id));
        return ($P_sth -> fetchAll() > 0);
    }
}