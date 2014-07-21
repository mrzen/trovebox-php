<?php

namespace Trovebox\Common;

use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Service\Builder\ServiceBuilderLoader;


/**
 * Base classs for interacting with web service clients
 */
class Trovebox extends ServiceBuilder
{


    /**
     * @var Current Client Version
     */
    const VERISON = "0.0.1";



    /**
     * Create a new service locator for the Trovebox API
     *
     * @param array|string $config  The full path to a .php, .js or .json file
     *                              or an assocative array to use as the global parameters
     *                              to pass to each service.
     *
     *
     * @param array $globalParameters Global parameters to pass to every services as it is
     *                                instantiated.
     *
     * @return Trovebox
     */
    public static function factory($config = null, array $globalParameters = array())
    {
    
        if (!$config) {
            // If no configuration is passed then use the default congfiguration file
            // with credentials from the environment
            $config = self::getDefaultServiceDefinition();

        } elseif ( is_array($config) ) {

            // If an array is passed, 
            // use the default configuration with $config parameters as ovverrides.
            $globalParameters = $config;
            $config = self::getDefaultServiceDefinition();

        }


        $loader = new ServiceBuilderLoader();
        $loader->addAlias('_trovebox', self::getDefaultServiceDefinition());

        return $loader->load($config, $globalParameters);
            

    
    }


    /**
     * Load the full path to the default service builder definition file
     *
     * @return string Full path to the default service builder definition
     */
    public static function getDefaultServiceDefinition()
    {
        return __DIR__ . '/Resources/trovebox-config.php';
        
    }

    /**
     * Get the configuration for the service builder
     *
     * @return array Service builder configuration
     */
    public function getConfig()
    {
        return $this->builderConfig;
    }
    

    
    

}