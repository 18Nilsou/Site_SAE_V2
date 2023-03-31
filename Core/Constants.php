<?php

/**
 * Class Constants
 *
 * This class provides directory constants and related methods
 *
 * @final
 */
final class Constants {

    /**
     * @var string VIEW_DIRECTORY
     */
    const VIEW_DIRECTORY = '/Views/';

    /**
     * @var string MODEL_DIRECTORY
     */
    const MODEL_DIRECTORY = '/Model/';

    /**
     * @var string CORE_DIRECTORY
     */
    const CORE_DIRECTORY = '/Core/';

    /**
     * @var string EXCEPTIONS_DIRECTORY
     */
    const EXCEPTIONS_DIRECTORY = '/Core/Exceptions/';

    /**
     * @var string CONTROLLERS_DIRECTORY
     */
    const CONTROLLERS_DIRECTORY = '/Controllers/';

    /**
     * @var string DATABASE_DIRECTORY
     */
    const DATABASE_DIRECTORY = '/Core/Database/';

    /**
     * @var string PHPMAILER_DIRECTORY
     */
    const PHPMAILER_DIRECTORY = '/Core/Phpmailer/';

    /**
     * Returns the root directory
     *
     * @return string
     */
    public static function rootDirectory() {
        return realpath(__DIR__ . '/../');
    }

    /**
     * Returns the core directory
     *
     * @return string
     */
    public static function coreDirectory() {
        return self::rootDirectory() . self::CORE_DIRECTORY;
    }

    /**
     * Returns the exceptions directory
     *
     * @return string
     */
    public static function exceptionsDirectory() {
        return self::rootDirectory() . self::EXCEPTIONS_DIRECTORY;
    }

    /**
     * Returns the views directory
     *
     * @return string
     */
    public static function viewsDirectory() {
        return self::rootDirectory() . self::VIEW_DIRECTORY;
    }

    /**
     * Returns the model directory
     *
     * @return string
     */
    public static function modelDirectory() {
        return self::rootDirectory() . self::MODEL_DIRECTORY;
    }

    /**
     * Returns the controllers directory
     *
     * @return string
     */
    public static function controllersDirectory() {
        return self::rootDirectory() . self::CONTROLLERS_DIRECTORY;
    }

    /**
     * Returns the databse directory
     *
     * @return string
     */
    public static function databseDirectory() {
        return self::rootDirectory() . self::DATABASE_DIRECTORY;
    }

    /**
     * Returns the phpMailer directory
     *
     * @return string
     */
    public static function phpMailerDirectory() {
        return self::rootDirectory() . self::PHPMAILER_DIRECTORY;
    }
}
