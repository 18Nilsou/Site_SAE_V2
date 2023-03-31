<?php

final class Questions extends Model{

    public static function deleteByRoom($S_id): bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM questions WHERE room_id = :id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth-> bindValue(":id",$S_id,PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

    public static function selectOne($S_room_id, $I_order_question){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM QUESTIONS WHERE order_question = :order_question and room_id = :room_id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":room_id", $S_room_id, PDO::PARAM_STR);
        $P_sth -> bindValue(":order_question", $I_order_question, PDO::PARAM_INT);
        $P_sth -> execute();
        return $P_sth -> fetch();
    }

    public static function deleteQuestion($S_room_id, $I_order_question): bool{
        $I_max = self::getNumberOfQuestionByRoom($S_room_id);
        $O_con = Connection::initConnection();
        $S_stmnt = "DELETE FROM QUESTIONS WHERE order_question = :order_question and room_id = :room_id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":room_id", $S_room_id, PDO::PARAM_STR);
        $P_sth -> bindValue(":order_question", $I_order_question, PDO::PARAM_INT);
        $B_state = $P_sth->execute();
        $O_con = null;
        if (isset($I_max) && $I_order_question != $I_max){
            $A_questions = self::selectByRoom($S_room_id);
            $I_num = 0;
            while($A_questions[$I_num]['order_question'] < $I_order_question){
                unset($A_questions[$I_num]);
                ++$I_num;
            }
            foreach($A_questions as $A_question){
                $A_question['order_questionold'] = $A_question['order_question'];
                $A_question['order_question'] = $A_question['order_question'] - 1;
                self::updateOrderQuestion($A_question);
            }
        }

        return $B_state;
    }
    

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
                            <input type='hidden' name='order_question' value='".$A_question["order_question"]."'>
                            <input type='hidden' name='room_id' value='".$S_room."'>
                            <tr>
                                <th>".$A_question["order_question"]."</th>
                                <th><input type='text' name='title' maxlength='40' size='25' value='".$A_question["title"]."'></th>
                                <th><textarea name='assignement' maxlength='255' rows='3' >".$A_question["assignement"]." </textarea></th>
                                <th><input type='text' name='suggestion' maxlength='255' size='25' value='".$A_question["suggestion"]."'></th>
                                <th><input type='text' name='answer'  maxlength='255' size='25' value='".$A_question["answer"]."'></th>
                                <th><input type='submit' name='submit' id='modify' value='Modifier'></th>
                                <th><input type='submit' name='submit' value='Supprimer' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette question ?\")'></th>
                            </tr>
                        </form>";
        }
        $S_array .= "</table>";
        return $S_array;
    }

    public static function updateQuestion(array $A_postParams): bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "UPDATE QUESTIONS SET title = :title , assignement = :assignement , suggestion = :suggestion , answer = :answer WHERE order_question = :order_question and room_id = :room_id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":room_id", $A_postParams['room_id'], PDO::PARAM_STR);
        $P_sth -> bindValue(":order_question", $A_postParams['order_question'], PDO::PARAM_INT);
        $P_sth -> bindValue(":assignement", $A_postParams['assignement'], PDO::PARAM_STR);
        $P_sth -> bindValue(":title", $A_postParams['title'], PDO::PARAM_STR);
        $P_sth -> bindValue(":answer", $A_postParams['answer'], PDO::PARAM_STR);
        $P_sth -> bindValue(":suggestion", $A_postParams['suggestion'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

    public static function updateOrderQuestion(array $A_postParams): bool{
        $O_con = Connection::initConnection();
        $S_stmnt = "UPDATE QUESTIONS SET title = :title , assignement = :assignement , suggestion = :suggestion , answer = :answer , order_question = :order_question WHERE order_question = :order_questionold and room_id = :room_id ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":room_id", $A_postParams['room_id'], PDO::PARAM_STR);
        $P_sth -> bindValue(":order_question", $A_postParams['order_question'], PDO::PARAM_INT);
        $P_sth -> bindValue(":order_questionold", $A_postParams['order_questionold'], PDO::PARAM_INT);
        $P_sth -> bindValue(":assignement", $A_postParams['assignement'], PDO::PARAM_STR);
        $P_sth -> bindValue(":title", $A_postParams['title'], PDO::PARAM_STR);
        $P_sth -> bindValue(":answer", $A_postParams['answer'], PDO::PARAM_STR);
        $P_sth -> bindValue(":suggestion", $A_postParams['suggestion'], PDO::PARAM_STR);
        $B_state = $P_sth->execute();
        $O_con = null;
        return $B_state;
    }

    public static function form(array $A_param):bool{
        if($A_param['submit']=="Valider"){
            unset($A_param['submit']);
            return self::updateQuestion($A_param);
        }
        return self::deleteQuestion($A_param['room_id'],$A_param['order_question']);
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
        $A_param["order_question"] = self::getNumberOfQuestionByRoom($A_param['room_id']) + 1;
        return Questions::create($A_param);
    }

}