<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc8220e96e6029ecaf4fe23a8aef77a21
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitc8220e96e6029ecaf4fe23a8aef77a21', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc8220e96e6029ecaf4fe23a8aef77a21', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc8220e96e6029ecaf4fe23a8aef77a21::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
