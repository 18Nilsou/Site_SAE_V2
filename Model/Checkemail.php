<?php

/**
 * Model class to interact with the DB table Checkmail
 *
 * @extends Model
 * @final
 */
final class Checkemail extends Model{

    /**
     * Selects a record based on the token
     *
     * @param string $S_token The token to use for selection
     *
     * @return array
     */
    public static function selectByToken(string $S_token): array {
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM checkemail WHERE token = :token ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":token", $S_token, PDO::PARAM_INT);
        $P_sth->execute();
        return $P_sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Send an email with a token
     *
     * @param string $S_id    The id to use in the record
     * @param string $S_email The email to send the token to
     *
     * @return bool
     */
    public static function sendmail(string $S_id, string $S_email): bool {
        $A_params['token'] = self::genToken();
        $A_params['creation_date'] = date("d-M-Y H:i");
        $A_params['id'] = $S_id;
        if(self::create($A_params)){
            $A_mailContent['subject'] = "Vérification d'email";
            $A_mailContent['body'] = "Voici votre token valable pendant 10min : ".$A_params['token'];
            return Mailer::sendMail($S_email, $A_mailContent);
        }
        return false;
    }

    /**
     * Generates a random token
     *
     * @return int
     */
    public static function genToken(): int {
        return rand(100000, 999999);
    }
}