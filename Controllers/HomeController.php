<?php
/**
* HomeController
*
* This class represents the controller for the Home page.
*/
final class HomeController
{
    /**
    * defaultAction
    *
    * This method is the default action for the Home page.
    * It will show the view for the Home page.
    */
    public function defaultAction(): void
    {
        View::show("home/home");
    }
}