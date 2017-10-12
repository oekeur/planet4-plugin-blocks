<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit356100170ff2882375cd04c4c76f9df3
{
    public static $prefixLengthsPsr4 = array (
        'P' =>
        array (
            'P4BKS\\Controllers\\Menu\\' => 23,
            'P4BKS\\Controllers\\Blocks\\' => 25,
            'P4BKS\\Controllers\\' => 18,
            'P4BKS\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'P4BKS\\Controllers\\Menu\\' =>
        array (
            0 => __DIR__ . '/../..' . '/classes/controller/menu',
        ),
        'P4BKS\\Controllers\\Blocks\\' =>
        array (
            0 => __DIR__ . '/../..' . '/classes/controller/blocks',
        ),
        'P4BKS\\Controllers\\' =>
        array (
            0 => __DIR__ . '/../..' . '/classes/controller',
        ),
        'P4BKS\\' =>
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_CarouselSplit_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-carouselsplit-controller.php',
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_ContentFourColumn_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-contentfourcolumn-controller.php',
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-controller.php',
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_HappyPoint_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-happypoint-controller.php',
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_StaticFourColumn_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-staticfourcolumn-controller.php',
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_Subheader_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-subheader-controller.php',
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_Tasks_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-tasks-controller.php',
        'P4BKS\\Controllers\\Blocks\\P4BKS_Blocks_TwoColumn_Controller' => __DIR__ . '/../..' . '/classes/controller/blocks/class-p4bks-blocks-twocolumn-controller.php',
        'P4BKS\\Controllers\\Menu\\P4BKS_Controller' => __DIR__ . '/../..' . '/classes/controller/menu/class-p4bks-controller.php',
        'P4BKS\\Controllers\\Menu\\P4BKS_Settings_Controller' => __DIR__ . '/../..' . '/classes/controller/menu/class-p4bks-settings-controller.php',
        'P4BKS\\Controllers\\P4BKS_Uninstall_Controller' => __DIR__ . '/../..' . '/classes/controller/class-p4bks-uninstall-controller.php',
        'P4BKS\\P4BKS_Loader' => __DIR__ . '/../..' . '/classes/class-p4bks-loader.php',
        'P4BKS\\Views\\P4BKS_View' => __DIR__ . '/../..' . '/classes/view/class-p4bks-view.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit356100170ff2882375cd04c4c76f9df3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit356100170ff2882375cd04c4c76f9df3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit356100170ff2882375cd04c4c76f9df3::$classMap;

        }, null, ClassLoader::class);
    }
}
