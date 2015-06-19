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
 * Filename : lib
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 17 Jun 2015
 */

function sbgallery_add_instance($instance)
{
    global $DB;

    $instance->timemodified = time();
    $instance->timecreated  = $instance->timemodified;

    if (!$instance->id = $DB->insert_record('sbgallery', $instance)) {
        return false;
    }

    return $instance->id;
}

function sbgallery_update_instance($instance)
{
    global $DB;

    $instance->timemodified = time();
    $instance->id = $instance->instance;

    return $DB->update_record('sbgallery', $instance);
}

function sbgallery_delete_instance($id)
{
    global $DB;

    if (!($gallery = $DB->get_record('sbgallery', array('id' => $id)))) {
        return false;
    }
    if (!$DB->delete_records('sbgallery_comments', array('gallery' => $gallery->id))) {
        return false;
    }
    if (!$DB->delete_records('sbgallery_images', array('gallery' => $gallery->id))) {
        return false;
    }
    if (!$DB->delete_records('sbgallery', array('id' => $gallery->id))) {
        return false;
    }
    return true;
}

function sbgallery_supports($feature)
{
    switch($feature) {
        case FEATURE_MOD_ARCHETYPE:
            return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_BACKUP_MOODLE2:
        case FEATURE_SHOW_DESCRIPTION:
            return true;
        case FEATURE_COMPLETION_HAS_RULES:
        case FEATURE_COMPLETION_TRACKS_VIEWS:
        case FEATURE_GRADE_HAS_GRADE:
        case FEATURE_GROUPINGS:
        case FEATURE_GROUPS:
        case FEATURE_GROUPMEMBERSONLY:
            return false;
        default:
            return null;
    }
}