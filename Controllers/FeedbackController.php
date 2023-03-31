<?php

final class FeedbackController{
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null): void{
        View::show("feedback/add",$A_postParams);
    }

    public function addAction(Array $A_parametres = null, Array $A_postParams = null){
        Feedback::create($A_postParams);
        header("location: /user");
    }

    public function deleteAction(Array $A_parametres = null, Array $A_postParams = null){
        Feedback::deleteByID($A_postParams['id']);
        header("location: /user");
    }

    public function testAction(Array $A_parametres = null, Array $A_postParams = null){
        echo'ben c est bon';
        die;
    }

    public function editFormAction(Array $A_parametres = null, Array $A_postParams = null){
        View::show("feedback/edit",$A_postParams);
    }

    public function editAction(Array $A_parametres = null, Array $A_postParams = null){
        var_dump($A_postParams);
        $S_id = $A_postParams['id'];
        unset($A_postParams['id']);
        Feedback::updateById($A_postParams, $S_id);
        header("location: /user");
    }

}