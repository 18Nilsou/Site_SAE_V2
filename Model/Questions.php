<?php

final class Questions extends Model{

    public static function selectByRoom(string $S_room):string{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM Questions WHERE room_id = :room_id order by order_question";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":room_id", $S_room, PDO::PARAM_STR);
        $O_sth->execute();
        $S_array = "<table><tr><th>Numéro</th><th>Titre</th><th>Consigne</th><th>Indice</th><th>Solution</th><th></th><th></th></tr>";
        while($A_question = $O_sth-> fetch()){
            $S_array .= "<form action='questions' method='post'>
                            <input type='hidden' name='id' value='".strval($A_question["id"])."'>
                            <input type='hidden' name='order_question' value='".$A_question["order_question"]."'>
                            <input type='hidden' name='room_id' value='".$A_question["room_id"]."'>
                            <tr>
                                <th>".$A_question["order_question"]."</th>
                                <th><input type='text' name='title' size='25' value='".$A_question["title"]."'></th>
                                <th><textarea name='assignement' rows='3' >".$A_question["assignement"]." </textarea></th>
                                <th><input type='text' name='suggestion' size='25' value='".$A_question["suggestion"]."'></th>
                                <th><input type='text' name='suggestion' size='25' value='".$A_question["answer"]."'></th>
                                <th><input type='submit' name='submit' value='Modifier'></th>
                                <th><input type='submit' name='submit' value='Supprimer'></th>
                            </tr>
                        </form>";
        }
        $S_array .= "</table>";
        return $S_array;
    }

    public static function form(array $A_param):bool{
        if($A_param['submit']=="Modifier"){
            $I_id = $A_param['id'];
            unset($A_param['id']);
            unset($A_param['submit']);
            var_dump($A_param);
            return self::updateById($A_param, $I_id);
        }
        return self::deleteByID($A_param['id']);
    }

}