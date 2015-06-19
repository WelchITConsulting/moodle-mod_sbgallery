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
 * Filename : restore_sbgallery_stepslib
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 18 Jun 2015
 */

class restore_sbgallery_activity_structure_step extends restore_activity_structure_step
{
    protected function define_structure()
    {
        $paths = array();
        $userinfo = $this->get_setting_value('userinfo');

        $paths = new restore_path_element('sbgallery', '/activity/sbgallery');

        $paths[] = new restore_path_element('sbgallery_images', '/activity/sbgallery/images/image');

        if ($userinfo) {
            $paths[] = new restore_path_element('sbgallery_comment', '/activity/sbgallery/usercomments/comment');
        }
        return $this->prepare_activity_structure($paths);
    }

    protected function process_sbgallery($data)
    {

    }

    protected function process_sbgallery_comment($data)
    {

    }

    protected function process_sbgallery_image_meta($data)
    {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->gallery = $this->get_new_parentid('sbgallery');
        $newitemid = $DB->insert_record('sbgallery_images', $data);
    }

    protected function after_execute()
    {
        $this->add_related_files('mod_sbgallery', 'gallery_images', null);
        $this->add_related_files('mod_sbgallery', 'gallery_thummbs', null);
        $this->add_related_files('mod_sbgallery', 'gallery_index', null);
        $this->add_related_files('mod_sbgallery', 'intro', null);
    }
}