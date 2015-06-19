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
 * Filename : mod_form
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 17 Jun 2015
 */

require_once($CFG->dirroot . '/course/moodleform_mod.php');
require_once($CFG->dirroot . '/mod/sbgallery/locallib.php');

class mod_sbgallery_mod_form extends moodleform_mod
{
    public function definition()
    {
        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('name'), array('size' => 48, 'maxlength' => 255));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $this->standard_intro_elements();

        $mform->addElement('header', 'galleryoptions', get_string('advanced'));

        $perpage = array(0   => get_string('showall', 'sbgallery'),
                         10  => get_string('show10', 'sbgallery'),
                         25  => get_string('show25', 'sbgallery'),
                         50  => get_string('show50', 'sbgallery'),
                         100 => get_string('show100', 'sbgallery'),
                         200 => get_string('show200', 'sbgallery'));
        $mform->addElement('select', 'perpage', get_string('showperpage', 'sbgallery'), $perpage);
        $mform->setType('perpage', PARAM_INT);

        $yesno = array(0 => get_string('no'),
                       1 => get_string('yes'));

        $mform->addElement('select', 'captionfull', get_string('captionfull', 'sbgallery'), $yesno);
        $mform->setType('captionfull', PARAM_INT);

        $captionpos = array(0 => get_string('positionbottom', 'sbgallery'),
                            1 => get_string('positiontop', 'sbgallery'),
                            2 => get_string('positionhide', 'sbgallery'));
        $mform->addElement('select', 'captionpos', get_string('captionpos', 'sbgallery'), $captionpos);
        $mform->setType('captionpos', PARAM_INT);

        $autoresize = array(AUTO_RESIZE_SCREEN => get_string('autoresizescreen', 'sbgallery'),
                            AUTO_RESIZE_UPLOAD => get_string('upload'),
                            AUTO_RESIZE_BOTH   => get_string('autoresizeboth', 'sbgallery'),);
        $resizegrp = array($mform->createElement('select', 'autoresize',
                                                 get_string('autoresize', 'sbgallery'),
                                                 $autoresize),
                           $mform->createElement('checkbox', 'autoresizedisable', null,
                                                 get_string('disable')));
        $mform->addGroup($resizegrp, 'autoresizegroup', get_string('autoresize', 'sbgallery'), ' ', false);
        $mform->setType('autoresize', PARAM_INT);
        $mform->disabledIf('autoresizegroup', 'autoresizedisable', 'checked');
        $mform->addHelpButton('autoresizegroup', 'autoresize', 'sbgallery');

        $resizeopts = array(1 => '1280x1024',
                            2 => '1024x768',
                            3 => '800x600',
                            4 => '640x480');
        $mform->addElement('select', 'resize',
                           sprintf('%s (%s)', get_string('resize', 'sbgallery'),
                                              get_string('upload')),
                           $resizeopts);
        $mform->setType('resize', PARAM_INT);
        $mform->disabledIf('resize', 'autoresize', 'eq', 1);
        $mform->disabledIf('resize', 'autoresizedisabled', 'checked');

        $mform->addElement('select', 'comments', get_string('comments', 'sbgallery'), $yesno);
        $mform->setType('comments', PARAM_INT);

        $mform->addElement('select', 'ispublic', get_string('ispublic', 'sbgallery'), $yesno);
        $mform->setType('ispublic', PARAM_INT);

        if (sbgallery_rss_enabled()) {
            $mform->addElement('select', 'rss', get_string('allowrss', 'sbgallery'), $yesno);
            $mform->setType('rss', PARAM_INT);
        } else {
            $mform->addElement('static', 'rssdisabled', get_string('allowrss', 'sbgallery'),
                               get_string('rssglobaldisabled', 'admin'));
        }

        $mform->addElement('select', 'extinfo', get_string('extinfo', 'sbgallery'), $yesno);
        $mform->setType('extinfo', PARAM_INT);

        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }

    public function data_preprocessing(&$defaults)
    {
        $defaults['autoresizedisable'] = ((isset($defaults['autoresize']) && $defaults['autoresize']) ? 0 : 1);
    }
}