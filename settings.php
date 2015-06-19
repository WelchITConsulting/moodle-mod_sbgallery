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
 * Filename : settings
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 17 Jun 2015
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    // Enable RSS feeds for the galleries
    $str = get_string('configenablerssfeedsdesc', 'sbgallery')
         . (empty($CFG->enablerssfeeds) ? '(' . get_string('configenablerssfeedsdisabled2', 'admin') . ')'
                                        : '');
    $settings->add(new admin_setting_configcheckbox('sbgallery_enablerssfeeds',
                                                    get_string('configenablerssfeeds', 'sbgallery'),
                                                    $str, 0));
}
