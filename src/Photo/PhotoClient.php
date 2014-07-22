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
 * Photo Client Methods
 */
namespace Trovebox\Photo;

use Trovebox\Models\Photo;

trait PhotoClient {

    /**
     * Query photos
     *
     * @param array $query_params Parameters to give the query
     *                            Can include any of the options referenced in the Trovebox API
     *
     * @return array[\Trovebox\Models\Photo] array of photos
     */
    public function photos(array $query_params = []) {

        /*
         * If an array of tags is provided,
         * implode them into a comma delimited list
         */
        if (array_key_exists('tags', $query_params) && is_array($query_params['tags'])) {
            $query_params['tags'] = implode(',', $query_params['tags']);
        }

        $response = $this->get('/photos/list.json', ['query' => $query_params]);

        $data = $response->json();
        $photos = [];

        foreach($data['result'] as $result) {
            $photos[] = new Photo($result);
        }

        return $photos;
    }

    
    /**
     * Get a single photo by ID
     *
     * @param string                         $id Trovebox image ID
     * @param array[\Trovebox\Models\Size]   $returnSizes Return sizes
     * @param bool                           $generate    Generate images on request
     */
    public function photo($id , $returnSizes = null, $generate = false)
    {
        
        $response = $this->get('/photos/{$id}/view.json');
        $data = $response->json();
        
        $photo = new Photo($data['result'], $this);
        return $photo;
    }

}