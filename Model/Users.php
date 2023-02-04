<?
final class Users extends Model{

    public static function connect(array $A_getParams):string{
        $S_id = $A_getParams['id'];
        $A_user = self::selectById($S_id);
        $S_password = hash('sha512', $A_getParams['password']);
        if(self::checkIfExistsById($S_id) && $A_user['password']== $S_password){
            if(Admins::checkIfExistsById($S_id)){
                return "admin";
            }
            return "user";
        }
        return "Mot de passe ou Pseudo invalide";
    }
}