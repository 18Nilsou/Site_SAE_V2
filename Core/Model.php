<?php

/**
 * Abstract class Model provides methods to manipulate a database
 *
 * @abstract
 */
abstract class Model{

    /**
     * Selects a record from the database of the called class
     *
     * @param string $S_id The id of the record
     *
     * @return array The record with the given id
     */
    public static function selectById($S_id) {
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class()." WHERE ID = ? ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute(array($S_id));
        $A_row = $P_sth->fetch(PDO::FETCH_ASSOC);
        $O_con = null;
        return $A_row;
    }

    /**
     * Deletes a record from the database of the called class
     *
     * @param string $S_id The id of the record
     *
     * @return bool Whether the record was deleted or not
     */
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

    /**
     * Creates a record in the database of the called class
     *
     * @param Array $A_postParams The parameters of the record
     *
     * @return bool Whether the record is created or not
     */
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

    /**
     * Updates a record in the database of the called class
     *
     * @param Array $A_postParams The parameters of the record
     * @param string $S_id The id of the record
     *
     * @return bool Whether the record is updated or not
     */
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

    /**
     * Selects the number of records in the database of the called class
     *
     * @return int The number of records
     */
    public static function selectHowMany() : int{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT count(*) FROM ".get_called_class();
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute();
        $A_row = $P_sth->fetch(PDO::FETCH_ASSOC);
        $O_con = null;
        return $A_row['count'];
    }

    /**
     * Selects all records from the database of the called class
     *
     * @return array All records
     */
    public static function selectAll(): array{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class();
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute();
        $O_con = null;
        return $P_sth->fetchAll();
    }

    /**
     * Checks if a record exists in the database of the called class
     *
     * @param string $S_id The id of the record
     *
     * @return bool Whether the record exists or not
     */
    public static function checkIfExistsById($_id) : bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM ".get_called_class()." WHERE ID = ? ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth->execute(array($_id));
        return (!empty($P_sth -> fetchAll()));
    }
}