<?php
/*
 * Copyright (C) 2015 Welch IT Consulting
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Filename : locallib
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 17 Jun 2015
 */

define('AUTO_RESIZE_SCREEN', 1);
define('AUTO_RESIZE_UPLOAD', 2);
define('AUTO_RESIZE_BOTH', 3);


function sbgallery_rss_enabled()
{
    global $CFG;

    return ($CFG->enablerssfeeds && get_config('sbgallery', 'sbgallery_enablerssfeeds'));
}

function sbgallery_store_metadata()
{
    $metadata = new stdClass();
    $metadata->width = 480;
    $metadata->height = 480;
    $metadata->file = '2013/05/slide-01.jpg';
    $metadata->sizes = array('thumbnail' => array('file'      => 'slide-01-150x150.jpg',
                                                  'width'     => 150,
                                                  'height'    => 150,
                                                  'mime-type' => 'image/jpeg'),
                             'medium'    => array('file'      => 'slide-01-300x300.jpg',
                                                  'width'     => 300,
                                                  'height'    => 300,
                                                  'mime-type' => 'image/jpeg'));
    $metadata->image_meta = array('aperture'          => 0,
                                  'credit'            => "",
                                  'camera'            => "",
                                  'caption'           => "",
                                  'created_timestamp' => 9,
                                  'copyright'         => "",
                                  'focal_length'      => 0,
                                  'iso'               => 0,
                                  'shutter_speed'     => 0,
                                  'title'             => "");
}
