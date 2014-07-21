<?php


namespace Trovebox\Tests\Photo;

use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Url;
use Guzzle\Plugin\History\HistoryPlugin;
use Guzzle\Plugin\Mock\MockPlugin;


use Trovebox\Photo\PhotoClient;

/**
 * Photo test case
 *
 * @covers Trovebox\Photo\PhotoClient
 */
class PhotoTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Trovebox\Photo\PhotoClient::factory
     */
    public function testFactoryInitializesClient()
    {
        $client = PhotoClient::factory([
            'consumer_key' => 'wow',
            'consumer_secret' => 'much test',
            'authorization_token' => 'very mock',
            'authorization_secret' => 'so tdd'
        ]);

        $this->assertInstanceOf('Trovebox\Photo\PhotoClient' , $client);

    }

    
    

}
