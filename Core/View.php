<?php

/**
 * View class
 *
 * This class is used to build the view of the application.
 *
 * @final
 */
final class View
{
    /**
     * Starts the main output buffer.
     *
     * @return void
     */
    public static function openBuffer()
    {
        ob_start();
    }

    /**
     * Returns the content of the main output buffer.
     *
     * @return string Output buffer content
     */
    public static function getBufferContent()
    {
        return ob_get_clean();
    }

    /**
     * Shows the view specified in the parameters.
     *
     * @param string $S_location View file path
     * @param array $A_parameters Parameters passed to the view
     *
     * @return void
     */
    public static function show ($S_location, $A_parameters = array())
    {
        $S_file = Constants::viewsDirectory() . $S_location . '.php';

        $A_view = $A_parameters;
        // Start of a sub-buffer
        ob_start();
        include $S_file; // The view is included in the sub-buffer
        ob_end_flush();
    }
}