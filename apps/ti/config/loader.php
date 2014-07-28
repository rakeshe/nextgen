<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerDirs(
	array(
		$config->application->controllersDir,
		$config->application->modelsDir,
		$config->application->libraryDir,
		$config->application->componentDir,
		$config->application->languageDir,
                $config->application->formsDir
	));

$loader->registerClasses(
    array(
        "simple_html_dom"         => $config->application->libraryDir."simple_html_dom.php"        
    )
);
$loader->register();
