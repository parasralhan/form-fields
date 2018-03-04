<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit821f001ea32811b5931679ce591d9f96
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Bonzer\\Inputs\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Bonzer\\Inputs\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'L' => 
        array (
            'Less' => 
            array (
                0 => __DIR__ . '/..' . '/oyejorge/less.php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'lessc' => __DIR__ . '/..' . '/oyejorge/less.php/lessc.inc.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit821f001ea32811b5931679ce591d9f96::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit821f001ea32811b5931679ce591d9f96::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit821f001ea32811b5931679ce591d9f96::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit821f001ea32811b5931679ce591d9f96::$classMap;

        }, null, ClassLoader::class);
    }
}