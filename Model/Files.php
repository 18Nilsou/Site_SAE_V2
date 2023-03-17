<?php
final class Files{
    
    public static function score(Array $A_Params): void{
        $O_file = fopen('Files/score.txt', 'w');
        fwrite($O_file, 'Voici les scores pour la room '.$A_Params[0]['room'].':');
        foreach($A_Params as $A_data){
            $S_text = "\n" .  $A_data['name'] .' '. $A_data['user_id']  .' '. $A_data['lastname']  ." : " . $A_data['score'];
            fwrite($O_file, $S_text);
        }
        fclose($O_file);
    }

    public static function download($S_file, $S_dir){
        header('Content-Description: File Transfer');
        header('Content-Type: application/txt');
            header('Content-Disposition: attachment; filename='.$S_file);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($S_dir));
        readfile($S_dir);
        exit;
    }

    public static function readquestion($S_name, $S_room_id){
        $O_file = fopen($S_name, 'r');
        fgetcsv($O_file,1024);
        while (!feof($O_file) ) {
            $A_question = fgetcsv($O_file,1024);
            if (strlen($A_question[1]) < 40 && strlen($A_question[2]) < 255 &&
                strlen($A_question[3]) < 255 && strlen($A_question[4]) < 255 && strlen($S_room_id) < 10){

                $A_questions[] = [
                "order_question" => $A_question[0],
                "title" =>$A_question[1],
                "assignement" =>$A_question[2],
                "answer" =>$A_question[3],
                "suggestion" => $A_question[4],
                "room_id" =>$S_room_id
                ];

            }
        }
        fclose($O_file);
        return $A_questions;
    }
}