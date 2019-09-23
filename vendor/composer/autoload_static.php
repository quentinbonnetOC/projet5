<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit250c24ded812ccf29a9de08f525a4d05
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mikehaertl\\tmp\\' => 15,
            'mikehaertl\\shellcommand\\' => 24,
            'mikehaertl\\pdftk\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mikehaertl\\tmp\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-tmpfile/src',
        ),
        'mikehaertl\\shellcommand\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-shellcommand/src',
        ),
        'mikehaertl\\pdftk\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-pdftk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit250c24ded812ccf29a9de08f525a4d05::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit250c24ded812ccf29a9de08f525a4d05::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
