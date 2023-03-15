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

}