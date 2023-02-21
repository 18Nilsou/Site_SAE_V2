<?php
final class Files{
    
    public static function score(Array $A_Params): void{
        $O_file = fopen('Files/score.txt', 'w');
        fwrite($O_file, 'Voici les scores :');
        foreach($A_Params as $A_data){
            fwrite($O_file, "\n" . $A_data['user_id'] . " : " . $A_data['score']);
        }
        fclose($O_file);
    }

    public static function download($S_file, $S_dir){
        header('Content-Description: File Transfer');
        header('Content-Type: application/txt');
        header('Content-Disposition: attachment; filename="' . $S_file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($S_dir));
        readfile($S_dir); 
    }

}