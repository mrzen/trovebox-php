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

namespace Trovebox\Tests\Models;

use GuzzleHttp\Subscriber\Mock;

/**
 * Test for Tags Model
 */
class TagsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test we create the tag with out any options
     */
    public function testCreateNewTag()
    {

        $tag = new \Trovebox\Models\Tag();

        $this->assertInstanceOf('Trovebox\Models\Tag', $tag);
    }

    /**
     * Test we can save a tag using `Trovebox\Client::createTag()`
     */
    public function testSaveNewTag()
    {

        $client = \Trovebox\Tests\getTestClient();
        $tag    = new \Trovebox\Models\Tag('Test Tag');
        
        $mock   = new Mock([
            MOCK . '/tags/create_tag.txt'
        ]);

        $client->getEmitter()->attach($mock);

        $new = $client->createTag($tag);

        $this->assertInstanceOf('Trovebox\Models\Tag', $tag);

    }

}