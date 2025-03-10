<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0cbdc4fc2fc4d6d57cc3c94f5123009a
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'src\\' => 4,
        ),
        'f' => 
        array (
            'financeiro\\' => 11,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
            'MF\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'financeiro\\' => 
        array (
            0 => __DIR__ . '/../..' . '/financeiro',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'MF\\' => 
        array (
            0 => __DIR__ . '/..' . '/MF',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0cbdc4fc2fc4d6d57cc3c94f5123009a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0cbdc4fc2fc4d6d57cc3c94f5123009a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0cbdc4fc2fc4d6d57cc3c94f5123009a::$classMap;

        }, null, ClassLoader::class);
    }
}
