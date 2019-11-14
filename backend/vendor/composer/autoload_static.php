<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita15883bf25080e143ea7304fceb2009f
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita15883bf25080e143ea7304fceb2009f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita15883bf25080e143ea7304fceb2009f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
