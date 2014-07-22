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

use Trovebox\Models\Photo;

/**
 * Tests for Photo Class
 */
class PhotoTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test creating an empty new photo
     */
    public function testCreateNew()
    {
        $p = new Photo();
        
        $this->assertInstanceOf('Trovebox\Models\Photo', $p);
    }

    /**
     * Test getting the original
     */
    public function testGetOriginalRaw()
    {
        $trovebox = \Trovebox\Tests\getTestClient();

        $mocks = new Mock([
            MOCK . '/photo/get_photo_aa.txt', // Get the photo object
            MOCK . '/photo/test_image.jpg.txt'  , // Test Image
        ]);

        $trovebox->getEmitter()->attach($mocks);

        $photo = $trovebox->photo('aa');

        $original = $photo->getOriginalRaw();

        // Expect a (binary) string of image data
        $this->assertTrue(is_string($original));

        // Expect the correct length
        $this->assertEquals(
            strlen($original),
            strlen(file_get_contents(MOCK . '/photo/test_image.jpg.txt')) + 4
        );
    }

}
