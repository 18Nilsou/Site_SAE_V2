<?php

require 'Core/Constants.php';

/**
 * AutoLoad Class
 *
 * The AutoLoad class is responsible for loading the core, model, view, controller, database, and PHPMailer classes.
 * It is a final class and is registered for autoloading with spl_autoload_register.
 *
 * @final
 */
final class AutoLoad
{
    /**
     * Load Core Classes
     *
     * Load classes from the core directory.
     *
     * @param string $S_className The name of the class to load.
     *
     * @return void
     */
    public static function loadCoreClasses($S_className)
    {
        $S_file = Constants::coreDirectory() . "$S_className.php";
        return static::_load($S_file);
    }

    /**
     * Load Exception Classes
     *
     * Loads classes from the exceptions directory.
     *
     * @param string $S_className The name of the class to load.
     *
     * @return void
     */
    public static function loadExceptionClasses($S_className)
    {
        $S_file = Constants::exceptionsDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    /**
     * Load Model Classes
     *
     * Loads classes from the model directory.
     *
     * @param string $S_className The name of the class to load.
     *
     * @return void
     */
    public static function loadModelClasses($S_className)
    {
        $S_file = Constants::modelDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    /**
     * Load View Classes
     *
     * Loads classes from the views directory.
     *
     * @param string $S_className The name of the class to load.
     *
     * @return void
     */
    public static function loadViewClasses($S_className)
    {
        $S_file = Constants::viewsDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    /**
     * Load Controller Classes
     *
     * Loads classes from the controllers directory.
     *
     * @param string $S_className The name of the class to load.
     *
     * @return void
     */
    public static function loadControllerClass($S_className)
    {
        $S_file = Constants::controllersDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    /**
     * Load Database Classes
     *
     * Loads classes from the database directory.
     *
     * @param string $S_className The name of the class to load.
     *
     * @return void
     */
    public static function loadDatabaseClass($S_className)
    {
        $S_file = Constants::databseDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    /**
     * Load PHPMailer Classes
     *
     * Loads classes from the PHPMailer directory.
     *
     * @param string $S_className The name of the class to load.
     *
     * @return void
     */
    public static function loadPHPMailerClasses($S_className)
    {
        $S_file = Constants::phpMailerDirectory() . "$S_className.php";

        return static::_load($S_file);
    }

    /**
     * Load
     *
     * Loads a class from a given file.
     *
     * @param string $S_fileToLoad The file to load the class from.
     *
     * @return void
     */
    private static function _load($S_fileToLoad)
    {
        if (is_readable($S_fileToLoad)) {
            require $S_fileToLoad;
        }
    }
}

spl_autoload_register('AutoLoad::loadCoreClasses');
spl_autoload_register('AutoLoad::loadExceptionClasses');
spl_autoload_register('AutoLoad::loadModelClasses');
spl_autoload_register('AutoLoad::loadViewClasses');
spl_autoload_register('AutoLoad::loadControllerClass');
spl_autoload_register('AutoLoad::loadDatabaseClass');
spl_autoload_register('AutoLoad::loadPHPMailerClasses');