<?php

/**
 * Test bootstrapper
 *
 * Configures the environment for testing and injects mockups.
 */


error_reporting(-1);

// Set our timezone to UTC
date_default_timezone_set('UTC');


// Ensure that composer has been run for dependencies
if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die(<<<MESSAGE
'composer.lock' file not found.
This indicates that dependencies have not been installed.
Use `composer install` to install the required dependencies.
See http://getcomposer.org for more information on installing and using composer.
MESSAGE
    );
}


// Include the phar files if testing against phars
if (get_cfg_var('trovebox_phar')) {
    include dirname(__DIR__) . '/build/' . get_cfg_var('trovebox_phar');
}

// Include the composer autoloader, and add our tests to it.
$loader = include dirname(__DIR__) . '/vendor/autoload.php';
$loader->add('Trovebox\\Test', __DIR__);


// Register services with GuzzleTestCase
Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . '/mock');


// Allow config overrides in CLI
if (get_cfg_var('CONFIG')) {
    $_SERVER['OCNFIG'] = get_cfg_var('CONFIG');
}


// Set the service configuration file
// unless it was provider by the CLI
if ( !isset($_SERVER['CONFIG']) ) {
    $serviceConfig = dirname(__DIR__) . '/test_services.json';
    if ( file_exists($serviceConfig) ) {
        $_SERVER['CONFIG'] = $serviceConfig;
    }
}

// If the global prefix is 'hostname' (or not set) use crc32 gethostname
if (!isset($_SERVER['PREFIX']) || $_SERVER['PREFIX'] === 'hostname') {
    $_SERVER['PREFIX'] = crc32(gethostname());
}


// Instantiate the service builder
$trovebox = Trovebox\Common\Trovebox::factory( isset($_SERVER['CONFIG']) ? $_SERVER['CONFIG'] : 'test_services.dist.json' );

// Turn on wire-level logging
$trovebox->getEventDispatcher()->addListener('service_builder.create_Client', function (\Guzzle\Common\Event $event) {
    if (isset($_SERVER['WIRE_LOGGING']) && $_SERVER['WIRE_LOGGING']) {
        $event['client']->addSubscriber(Guzzle\Plugin\Log\LogPlugin::getDebugPlugin());
    }
}
);

// Configure the tests to use the created service builder
Guzzle\Tests\GuzzleTestCase::setServiceBuilder($trovebox);

// Show deprecation warnings
Guzzle\Common\Version::$emitWarnings = true;

