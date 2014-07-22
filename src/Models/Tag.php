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


namespace Trovebox\Models;

/**
 * Tag class
 *
 * Class for an image tag
 */
class Tag
{


    /**
     * @var Tag ID
     */
    public $id;

    /**
     * @var Tag Usage Count
     */
    public $count;


    /**
     * @var Geo tag Longitude
     */
    public $lng;

    /**
     * @var Geo tag Latitude
     */
    public $lat;


    /**
     * @var Email???
     */
    public $email;


    /**
     * Constructor
     * 
     * @param int    $id    Tag ID (from Trovebox)
     * @param int    $count Usage count
     * @param float  $lng   Longitude (for Geo tag)
     * @param float  $lat   Latitude   (for Geo tag)
     * @param string $email ???
     */
    public function __construct($id = 0, $count = 0, $lng = null, $lat = null, $email = null)
    {
        $this->id    = $id;
        $this->count = $count;
        $this->lng   = $lng;
        $this->lat   = $lat;
        $this->email = $email;
        
    }

    /**
     * Check if Tag is Geo Tag
     *
     * @return bool Is Geo Tag?
     */
    public function isGeoTag()
    {
        return ($this->lng && $this->lat);
    }

}