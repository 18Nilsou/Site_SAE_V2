<?php
final class Users extends Model{


    public static function deleteByID($S_id): bool{
        if(!self::checkIfExistsById($S_id)){
            return false;
        }
        DoubleAuthentication::deleteByID($S_id);
        Retrievepassword::deleteByID($S_id);
        Scores::deleteByUser($S_id);
        Feedback::deleteByUser($S_id);
        Whitelist::deleteByUser($S_id);

        if(Session::isAdmin()){
            Admins::deleteByID($S_id);
        }
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM USERS WHERE ID = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

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

    public static function getStatus($S_id){
        if(Admins::selectById($S_id)) {
            return 'admin';
        }
        return 'user';
    }

    public static function checkIfExistsByEmail(string $S_email):bool{
        $A_user = self::selectByEmail($S_email);
        return isset($A_user['id']);
    }

    public static function selectByEmail(string $S_email){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM Users WHERE email = :email ";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":email", $S_email, PDO::PARAM_STR);
        $O_sth->execute();
        return ($O_sth-> fetch());
    }

    public static function selectMyScore(string $S_id):array{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM Scores, Rooms WHERE user_id = :id AND room_id = Rooms.id";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":id", $S_id, PDO::PARAM_STR);
        $O_sth->execute();
        $A_data = $O_sth -> fetchAll();
        return $A_data;
    }

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