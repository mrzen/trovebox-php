<?php


namespace Trovebox\Tests;

/**
 * Base Integration Test Case
 *
 */
class IntegrationTestCase extends \GuzzleHttp\Tests\ClientTest {

    /**
     * Log a message to STDERR
     *
     * @param string $message Message to log
     *
     * @return \void
     */
    public static function log($message)
    {
        fwrite(STDERR, $message . "\n");
    }


    /**
     * Get the resource prefix to add to created resouces
     *
     * @return string Resource Prefix to add
     */
    public static function getResourcePrefix()
    {
        if (!isset($_SERVER['PREFIX']) || $_SERVER['PREFIX'] === 'hostname') {
            $_SERVER['PREFIX'] = crc32(gethostname()) . rand(0, 10000);
        }

        return $_SERVER['PREFIX'];
    }

 
    /**
     * Check if mocks should be used for tests, rather than live calls
     *
     * @return bool Using Mocks?
     */
    public function useMocks()
    {
        return (bool)get_cfg_var('mock');
    }





}