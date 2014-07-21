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
class PhotoTestCase extends \Guzzle\Tests\GuzzleTestCase
{

    /**
     * @covers Trovebox\Photo\PhotoClient::factory
     */
    public function testFactoryInitializesClient()
    {
        $cleint = PhotoClient::factory(array(
            'consumer_key' => 'wow',
            'consumer_secret' => 'much test',
            'authorization_token' => 'very mock',
            'authorization_secret' => 'so tdd'
        ));

    }

    
    

}
