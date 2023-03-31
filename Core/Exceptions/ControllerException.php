<?php

/**
 * Class used to make a custom exception for the controllers
 */
class ControllerException extends Exception {
    /**
     * Constructor of class
     * @param $message
     */
    public function __construct($message = null) {
        View::show("errors/error404");
    }
}