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

namespace Trovebox\Tests;

use Trovebox\Client;


/**
 * Trovebox Client Test Case
 *
 * @covers Trovebox\Client
 */
class TroveboxClientTest extends \PHPUnit_Framework_TestCase {


    /**
     * @var Testing Config
     */
    private static $testConfig = [
        'baseurl' => 'http://test.example.com/api/',
        'oauth'   => [
            'consumer_key' => 'wow',
            'comsumer_secret' => 'such test',
            'token' => 'very mock',
            'secret' => 'so tdd'
        ]
    ];

    /**
     * Test we can initialize a client by passing an array
     */
    public function testInitializesWithArray()
    {
        
        $client = new Client(self::$testConfig);


        $this->assertInstanceOf('Trovebox\Client', $client);
    }

    /**
     * Test we can initialize a client by passing a json string
     */
    public function testInitializesWithJSONString()
    {
        $client = new Client( json_encode(self::$testConfig) );

        $this->assertInstanceOf('Trovebox\Client', $client);
    }


    /**
     * Test we can initialize a client by passing a file path (to json)
     */
    public function testInitializesWithJSONFilePath()
    {
        $file_path = dirname(dirname(__DIR__)) . '/test_config.dist.json';

        $client = new Client($file_path);

        $this->assertInstanceOf('Trovebox\Client', $client);
    }


}