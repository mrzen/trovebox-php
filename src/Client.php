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

namespace Trovebox;

use Trovebox\Hello\Hello;
use Trovebox\Photo\PhotoClient;

use GuzzleHttp\Subscriber\Oauth\Oauth1;

/**
 * Main Trovebox Client Class
 *
 */
class Client extends \GuzzleHttp\Client {
    
    use Hello;
    use PhotoClient;
    
    /**
     * Create a Client
     *
     * @param array $config Configuration options.
     */
    public function __construct($config = null)
    {
        // Load the appropreate configuration
        $configuration = $this->getConfig($config);

        parent::__construct($configuration);

        // Attach the OAuth
        if(isset($configuration['oauth'])) {
            $oauth = new Oauth1($configuration['oauth']);
            $this->getEmitter()->attach($oauth);
        }
    }


    /**
     * Get the Configuration
     *
     * @param string|array $config Configuration to use
     *
     * @return array Configuration
     */
    private function getConfig($config = null)
    {

        if ($config) {
            return $this->loadConfig($config);
        }

        // Check for $_SERVER['CONFIG']
        if ( isset($_SERVER['CONFIG']) ) {
            return $this->loadConfig($_SERVER['CONFIG']);
        }

        return [];

    }


    /**
     * Load the configuration
     *
     * @param array|string $config Configuration Source
     *
     */
    private function loadConfig($config) {
            if (is_string($config)) {

                if (file_exists($config)) {
                    // $config is path to configuration file
                    return json_decode(file_get_contents($config),true);
                } else {
                    // $config is configuration data as JSON
                    return json_decode($config,true);
                }
            }

            if (is_array($config)) {
                // Config is already an array
                return $config;
            }
    }
}