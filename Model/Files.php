<?php

/**
 * Class used to read and use files
 *
 * @final
 */
final class Files{

    /**
     *  Write the scores in a file.
     *
     *  @param array $A_Params The array containing the data of the users.
     */
    public static function score(Array $A_Params): void{
        $O_file = fopen('Files/score.txt', 'w');
        fwrite($O_file, 'Voici les scores pour la room '.$A_Params[0]['room'].':');
        foreach($A_Params as $A_data){
            $S_text = "\n" .  $A_data['user_id'] .' '. $A_data['name']  .' '. $A_data['lastname']  ." : " . $A_data['score'];
            fwrite($O_file, $S_text);
        }
        fclose($O_file);
    }

    /**
     *  Download a file.
     *
     *  @param string $S_file The name of the file.
     *  @param string $S_dir The directory of the file.
     */
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

    /**
     *  Read a txt file containing questions.
     *
     *  @param string $S_name The name of the file.
     *  @param string $S_room_id The room id.
     *  @return array The array containing the data of the questions.
     */
    public static function readquestion($S_name, $S_room_id){
        
        $O_file = fopen($S_name, 'r');
        $I_order = 1;
        fgetcsv($O_file,1024);
        while (!feof($O_file) ) {
            $A_question = fgetcsv($O_file,1024);
            if (strlen($A_question[0]) < 40 && strlen($A_question[1]) < 255 &&
                strlen($A_question[2]) < 255 && strlen($A_question[3]) < 255){

                $A_questions[] = [
                "order_question" => $I_order,
                "title" =>$A_question[0],
                "assignement" =>$A_question[1],
                "answer" =>$A_question[2],
                "suggestion" => $A_question[3],
                "room_id" =>$S_room_id
                ];

            }
            else{
                $A_questions[] = [
                    "order_question" => $I_order,
                    "title" =>"Question trop longue",
                    "assignement" =>"Question trop longue",
                    "answer" =>"Question trop longue",
                    "suggestion" =>"Question trop longue",
                    "room_id" =>$S_room_id
                    ];
            }
            ++$I_order;
        }
        fclose($O_file);
        return $A_questions;
    }
}