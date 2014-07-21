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
 * Photo list Tests
 */

namespace Trovebox\Tests\Photo;


use GuzzleHttp\Subscriber\Mock;


class PhotosTest extends \PHPUnit_Framework_TestCase {

    /**
     * Test we can list all photos
     */
    public function testListAllPhotos()
    {

        $trovebox = \Trovebox\Tests\getTestClient();

        $mock = new Mock([
            MOCK . "photo/list_all_photos.txt"
        ]);


        $trovebox->getEmitter()->attach($mock);
        
        $photos = $trovebox->photos();

        $this->assertTrue(is_array($photos));

        // Ensure the response is an array of Photos
        $this->assertInstanceOf('Trovebox\Models\Photo', $photos[0]);

                
    }
    
}