<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite27659bdea19ebe2cf293a8edcd728b9
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInite27659bdea19ebe2cf293a8edcd728b9::$classMap;

        }, null, ClassLoader::class);
    }
}
