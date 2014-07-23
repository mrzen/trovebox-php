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
 * Class for an image size
 *
 * @package  Trovebox\Models
 * @author   Leo Adamek <leo.adamek@mrzen.com>
 * @license  GPL-2.0+
 * @link     https://github.com/mrzen/trovebox-php/src/Models/Size.php
 * @category Model
 */
class Size
{

    /**
     * Image width
     */
    private $_width;


    /**
     * Image height
     */
    private $_height;


    /**
     * Cropped
     */
    private $_cropped;

    
    /**
     * Black & White Filter
     */
    private $_monochrome;
    
    
    /**
     * Constructor
     *
     * @param int  $width      Image width
     * @param int  $height     Image height
     * @param bool $cropped    Cropped to aspect ratio
     * @param bool $monochrome Black-and-white Monochrome filtered
     */
    public function __construct($width, $height, $cropped=false, $monochrome=false)
    {
        $this->_width      = (int)$width;
        $this->_height     = (int)$height;

        $this->_cropped    = (bool)$cropped;
        $this->_monochrome = (bool)$monochrome;
    }


    /**
     * Serializer
     *
     * @return string Serialized image size
     */
    public function __toString(){
        $str = "{$_width}x{$_height}";

        if ($this->_cropped) {
            $str .= "xCR";
        }

        if ($this->_monochrome) {
            $str .= "xBW";
        }
    }
}



