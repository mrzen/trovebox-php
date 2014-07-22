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
 * Photo Model
 */

namespace Trovebox\Models;

class Photo extends \stdClass {
    
    /**
     * @var Trovebox Client
     */
    private $_client;
 
    /**
     * Constructor
     *
     * @param array  $data Photo Data
     * @parma &\Trovebox\Client Client which created this photo
     */
    public function __construct(array $data = [], \Trovebox\Client &$client = null) {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }

        if ($client) {
            $this->_client = $client;
        }
    }


    /**
     * Get the raw, original image data
     *
     * @return \Imagick
     */
    public function getOriginalRaw()
    {

        // Null if there is no client
        if (!$this->_client) {
            return null;
        }

        $response = $this->_client->get($this->pathOriginal);
        return (string)$response;
    }

}