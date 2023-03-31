<?php

/**
 * Model class to interact with the DB table Users
 *
 * @extends Model
 * @final
 */
final class Users extends Model{

    /**
     * Connects a user to the application
     *
     * @param array $A_getParams The parameters of the connection
     * @return string The type of user (visitor, user or admin)
     */
    public static function connect(array $A_getParams):string{
        $S_id = $A_getParams['id'];
        $A_user = self::selectById($S_id);
        $S_password = hash('sha512', $A_getParams['password'].$A_getParams['id']);
        if(self::checkIfExistsById($S_id) && $A_user['password']== $S_password){
            if(Admins::checkIfExistsById($S_id)){
                return "admin";
            }
            return "user";
        }
        return "Mot de passe ou Pseudo invalide";
    }

    /**
     * Checks if the user is a visitor, user or admin
     *
     * @param array $A_getParams The parameters of the connection
     * @return string The type of user (visitor, user or admin)
     */
    public static function isUser(array $A_getParams):string{
        $S_id = $A_getParams['id'];
        $A_user = self::selectById($S_id);
        $S_password = hash('sha512', $A_getParams['password'].$A_getParams['id']);
        if ($A_user && $A_user['password']== $S_password) {
            if(Admins::selectById($S_id)) {
                return 'admin';
            }
            return 'user';
        }
        return 'visitor';
    }

    /**
     * Gets the user's status
     *
     * @param string $S_id The user's id
     * @return string The user's status
     */
    public static function getStatus($S_id){
        if(Admins::selectById($S_id)) {
            return 'admin';
        }
        return 'user';
    }

    /**
     * Checks if a user exists by his email
     *
     * @param string $S_email The user's email
     * @return bool Whether the user exists or not
     */
    public static function checkIfExistsByEmail(string $S_email):bool{
        $A_user = self::selectByEmail($S_email);
        return isset($A_user['id']);
    }

    /**
     * Selects a user by his email
     *
     * @param string $S_email The user's email
     * @return array The user's data
     */
    public static function selectByEmail(string $S_email){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM Users WHERE email = :email ";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":email", $S_email, PDO::PARAM_STR);
        $O_sth->execute();
        return ($O_sth-> fetch());
    }

    /**
     * Selects the user's scores
     *
     * @param string $S_id The user's id
     * @return array The user's scores
     */
    public static function selectMyScore(string $S_id):array{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM Scores, Rooms WHERE user_id = :id AND room_id = Rooms.id";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":id", $S_id, PDO::PARAM_STR);
        $O_sth->execute();
        $A_data = $O_sth -> fetchAll();
        return $A_data;
    }

    /**
     * Selects the user's feedbacks
     *
     * @param string $S_id The user's id
     * @return array The user's feedbacks
     */
    public static function selectMyFeedBack(string $S_id):array{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT f.id, rating, comment, r.name , f.user_id, f.room_id FROM feedback f, Rooms r WHERE user_id = :id AND room_id = r.id";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":id", $S_id, PDO::PARAM_STR);
        $O_sth->execute();
        $A_data = $O_sth -> fetchAll();
        return $A_data;
    }

}