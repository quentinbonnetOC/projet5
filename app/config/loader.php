<?php

$loader = new \Phalcon\Loader();

// Load composer vendor stuff
$loader->registerFiles([ BASE_PATH . "/vendor/autoload.php" ]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();
