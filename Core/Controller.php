<?php

/**
 * This class is responsible for controlling the page.
 *
 * It takes an URL and a set of post parameters, then translates this into a controller and an action.
 * The controller and the action are then called, and if they don't exist, an exception is thrown.
 *
 * @final
 */
final class Controller {
    private $_A_peeredUrl; // The transformed URL
    private $_A_urlParameters; // The parameters of the URL
    private $_A_postParams; // The post parameters

    /**
     * The constructor of the Controller class
     *
     * @param string $S_url - The URL to be transformed
     * @param array $A_postParams - The post parameters
     */
    public function __construct ($S_url, $A_postParams) {
        if(!empty($S_url)) {
            // Eliminate any slash at the end of the URL, otherwise our explode will return a last empty entry
            if ('/' == substr($S_url, -1, 1)) {
                $S_url = substr($S_url, 0, strlen($S_url) - 1);
            }

            // Explode the URL, it will be placed in an array
            $A_urlToPeered = explode('/', $S_url);
        }

        if (empty($A_urlToPeered[0])) {
            // We have taken the part of prefixing all controllers with "Controller"
            $A_urlToPeered[0] = 'HomeController';
        } else {
            $A_urlToPeered[0] =  ucfirst($A_urlToPeered[0]) . 'Controller';
        }

        if (empty($A_urlToPeered[1])) {
            // The action is empty! We value it by default
            $A_urlToPeered[1] = 'defaultAction';
        } else {
            // We assume that all our actions are suffixed with 'Action' ... we have to add it
            $A_urlToPeered[1] = $A_urlToPeered[1] . 'Action';
        }


        // we take out 2 times in a row from the beginning, that is to say we remove from our array the controller and the action
        // so there are only the eventual parameters (if we have them) ...
        $this->_A_peeredUrl['controller'] = array_shift($A_urlToPeered); // we get the controller
        $this->_A_peeredUrl['action']     = array_shift($A_urlToPeered); // then the action

        // ... we store these eventual parameters in the instance variable reserved for them
        $this->_A_urlParameters = $A_urlToPeered;

        // We take care of the $ A_postParams array
        $this->_A_postParams = $A_postParams;
    }

    // We execute our triplet

    /**
     * Executes the transformed URL with the controller and the action
     */
    public function execute() {
        if (!class_exists($this->_A_peeredUrl['controller'])) {
            throw new ControllerException();
        }

        if (!method_exists($this->_A_peeredUrl['controller'], $this->_A_peeredUrl['action'])) {
            throw new ControllerException();
        }

        $B_called = call_user_func_array(array(new $this->_A_peeredUrl['controller'],
            $this->_A_peeredUrl['action']), array($this->_A_urlParameters, $this->_A_postParams ));

        if (false === $B_called) {
            throw new ControllerException();
        }
    }
}