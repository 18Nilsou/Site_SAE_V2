<?php

/**
 * Class FeedbackController
 *
 * Provides the logic for the feedback pages of the application.
 */
final class FeedbackController{

    /**
     * Default action of the FeedbackController class
     *
     * @param array|null $A_parameters the parameters passed to the controller
     * @param array|null $A_postParams the post parameters passed to the controller
     *
     * @return void
     */
    public function defaultAction(Array $A_parameters = null, Array $A_postParams = null): void{
        View::show("feedback/add",$A_postParams);
    }

    /**
     * Executes the add action of the controller
     *
     * @param array|null $A_parameters the parameters passed to the controller
     * @param array|null $A_postParams the post parameters passed to the controller
     *
     * @return void
     */
    public function addAction(Array $A_parameters = null, Array $A_postParams = null): void
    {
        Feedback::create($A_postParams);
        header("location: /user");
    }

    /**
     * Executes the delete action of the controller
     *
     * @param array|null $A_parameters the parameters passed to the controller
     * @param array|null $A_postParams the post parameters passed to the controller
     *
     * @return void
     */
    public function deleteAction(Array $A_parameters = null, Array $A_postParams = null): void
    {
        Feedback::deleteByID($A_postParams['id']);
        header("location: /user");
    }

    /**
     * Executes the edit form action of the controller
     *
     * @param array|null $A_parameters the parameters passed to the controller
     * @param array|null $A_postParams the post parameters passed to the controller
     *
     * @return void
     */
    public function editFormAction(Array $A_parameters = null, Array $A_postParams = null): void
    {
        View::show("feedback/edit",$A_postParams);
    }

    /**
     * Executes the edit action of the controller
     *
     * @param array|null $A_parameters the parameters passed to the controller
     * @param array|null $A_postParams the post parameters passed to the controller
     *
     * @return void
     */
    public function editAction(Array $A_parameters = null, Array $A_postParams = null): void
    {
        var_dump($A_postParams);
        $S_id = $A_postParams['id'];
        unset($A_postParams['id']);
        Feedback::updateById($A_postParams, $S_id);
        header("location: /user");
    }
}