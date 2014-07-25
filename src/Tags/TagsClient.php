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


namespace Trovebox\Tags;

use Trovebox\Models\Tag;

/**
 * Tags Trait
 * Methods for getting tags
 */
trait TagsClient
{


    /**
     * Get all tags
     *
     * @return array[\Trovebox\Models\Tag] Tags
     */
    public function tags()
    {
        $response = $this->get('/tags/list.json');

        $data = $response->json();

        $tags = [];

        foreach($data['result'] as $tag){

            // Null missing fields
            if (!array_key_exists('longitude', $tag)) {
                $tag['longitude'] = null;
            }

            if (!array_key_exists('latitude', $tag)) {
                $tag['latitude'] = null;
            }

            if (!array_key_exists('email', $tag)) {
                $tag['email'] = null;
            }
                

            $tags[] = new Tag(
                $tag['id'],
                $tag['count'],
                $tag['longitude'],
                $tag['latitude'],
                $tag['email']
            );

        }

        return $tags;
        
    }


    /**
     * Create a new tag
     *
     * @param \Trovebox\Models\Tag &$tag Tag to create
     *
     * @return \Trovebox\Models\Tag The created tag
     */
    public function createTag(\Trovebox\Models\Tag &$tag)
    {
        $response = $this->post(
            "/tag/create.json", ['query' => [
            'tag'   => $tag->id,
            'count' => $tag->count,
            'email' => $tag->email,
            'latitude' => $tag->lat,
            'longitude' => $tag->lng
        ]]);

        $data = $response->json()['result'];
        
        $tag = new \Trovebox\Models\Tag(
            $data['id'],
            $data['count'],
            $data['longitude'],
            $data['latitude'],
            $data['email'],
            $this
        );

        return $tag;

    }

}