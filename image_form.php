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
 * Filename : image_form
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 18 Jun 2015
 */

require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/mod/sbgallery/locallib.php');
require_once($CFG->dirroot . '/mod/sbgallery/image.class.php');

class mod_sbgallery_image_form extends moodleform
{
    public function definition()
    {
        $mform =& $this->_form;
        $gallery =& $this->_customdata;

        $overwritefiles = get_config('sbgallery', 'sbgallery_overwritefiles');

        $mform->addElement('header', 'general', get_string('addimage', 'sbgallery'));

        $mform->addElement('filepicker', 'image', get_string('file'), 0,
                           array('maxbytes'       => $COURSE->maxbytes,
                                 'accepted_types' => array('web_image', 'archive')));
        $mform->addRule('image', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('image', 'addimage', 'sbgallery');

        if ($this->can_resize()) {
            $resizegrp = array($mform->createElement('select', 'resize',
                                                     get_string('edit_resize', 'sbgallery'),
                                                     sbgallery_resize_options()),
                               $mform->createElement('checkbox', 'resizedisabled',
                                                     get_string('disable')));
            $mform->setType('resize', PARAM_INT);
            $mform->addGroup($resizegrp, 'resizegrp', get_string('editresize', 'sbgallery'),
                             ' ', false);
            $mform->setDefault('resizedisabled', 1);
            $mform->disabledIf('resizegrp', 'resizedisabled', 'checked');
        }

        $mform->addElement('hidden', 'id', $cm->id);
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons(true, get_string('addimage', 'sbgallery'));
    }

    public function validation($data, $files)
    {
        
    }
}
