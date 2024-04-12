<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit132ffa4dcf4120aac9b2ff2e769d5cd6
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'Joferreira\\DataMapperOrm\\' => 25,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Joferreira\\DataMapperOrm\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit132ffa4dcf4120aac9b2ff2e769d5cd6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit132ffa4dcf4120aac9b2ff2e769d5cd6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit132ffa4dcf4120aac9b2ff2e769d5cd6::$classMap;

        }, null, ClassLoader::class);
    }
}
