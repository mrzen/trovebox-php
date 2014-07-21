<?php

/**
 * © 2014 Mr.Zen Ltd
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, US.A
 */

/**
 * Test Bootstrapper
 */
namespace Trovebox\Test;

$loaderPath = dirname(__DIR__) . '/vendor/autoload.php'; 
require $loaderPath;

use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Message\Response;

use Trovebox\Client;

error_reporting(-1);
date_default_timezone_set('UTC');


// Ensure composer is up-to-date
if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install\n\n"
        . "See http://getcomposer.org for help with installing composer\n");
}

// Check for overriden config values
if (get_cfg_var('CONFIG')) {
    $_SERVER['CONFIG'] = get_cfg_var('CONFIG');
}

// Set the config file if not provided by CLI
if (!isset($_SERVER['CONFIG'])) {
    $serviceConfig = dirname(__DIR__) . 'test_services.json';
    
    if (file_exists($serviceConfig)) {
        $_SERVER['CONFIG'] = $serviceConfig;
    }
}


// Instantiate the client
$client = new Client( isset($_SERVER['CONFIG']) ? $_SERVER['CONFIG'] : 'test_services.dist.json');

// Enable History
$history = new History();
