<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbe729b3d653bb73cf6f3225cc2cd8b14
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Application\\Controller\\' => 23,
            'Application\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Application\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Controller',
        ),
        'Application\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbe729b3d653bb73cf6f3225cc2cd8b14::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbe729b3d653bb73cf6f3225cc2cd8b14::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
