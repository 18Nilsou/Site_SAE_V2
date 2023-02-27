<?php

final class Questions extends Model{

    public static function selectByRoom(string $S_room):array{
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM Questions WHERE room_id = :room_id order by order_question";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":room_id", $S_room, PDO::PARAM_STR);
        $O_sth->execute();
        return $O_sth-> fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getQuestionArray(string $S_room, string $S_action):string{
        $S_array = "<table><tr><th>Numéro</th><th>Titre</th><th>Consigne</th><th>Indice</th><th>Solution</th><th>Modifier</th><th>Supprimer</th></tr>";
        $A_Allquestions = self::selectByRoom($S_room);
        foreach($A_Allquestions as $key => $A_question){
            $S_array .= "<form action='".$S_action."' method='post'>
                            <input type='hidden' name='id' value='".strval($A_question["id"])."'>
                            <input type='hidden' name='order_question' value='".$A_question["order_question"]."'>
                            <input type='hidden' name='room_id' value='".$S_room."'>
                            <tr>
                                <th>".$A_question["order_question"]."</th>
                                <th><input type='text' name='title' size='25' value='".$A_question["title"]."'></th>
                                <th><textarea name='assignement' rows='3' >".$A_question["assignement"]." </textarea></th>
                                <th><input type='text' name='suggestion' size='25' value='".$A_question["suggestion"]."'></th>
                                <th><input type='text' name='answer' size='25' value='".$A_question["answer"]."'></th>
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
            return self::updateById($A_param, $I_id);
        }
        return self::deleteByID($A_param['id']);
    }

    public static function getNumberOfQuestionByRoom(string $S_room){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT MAX(order_question) FROM Questions WHERE room_id = :room_id";
        $O_sth = $O_con->prepare($S_stmnt);
        $O_sth -> bindValue(":room_id", $S_room, PDO::PARAM_STR);
        $O_sth->execute();
        $A_row = $O_sth-> fetch();
        return $A_row['max'];
    }

    public static function add(array $A_param){
        $I_max = self::getNumberOfQuestionByRoom($A_param['room_id']);
        if($A_param['order_question'] == ""){
            unset($A_param['submit']);
            $A_param['order_question'] = $I_max+1;
            return Questions::create($A_param);
        }

        if($A_param['order_question'] == $I_max+1){
            return Questions::create($A_param);
        }

        if($A_param['order_question'] > $I_max + 1){
            $A_param['order_question'] = $I_max + 1; 
            return Questions::create($A_param);
        }

        $A_allQuestions = self::selectByRoom($A_param['room_id']);
        var_dump($A_allQuestions['0']);
        foreach($A_allQuestions as $key => $A_question){
            if($A_question['order_question'] = $A_param['order_question']){
                $A_question['order_question'] = intval($A_question['order_question']) + 1;
                self::updateById($A_question, $A_question['id']);
            }
        }
        return Questions::create($A_param);
    }

}