<?php
final class QuestionsController{
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Questions::form($A_postParams);
        header("location: Admin");
    }
}