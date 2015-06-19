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
 * Filename : access
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 18 Jun 2015
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'mod/sbgallery:addinstance' => array(
        'riskbitmask'  => RISK_XSS,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes'   => array(
            'editingteacher' => CAP_ALLOW,
            'manager'        => CAP_ALLOW
        ),
        'clonepermissionsfrom' => 'moodle/course:manageactivities'
    ),

    'mod/sbgallery:view' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'legacy'       => array(
            'student'        => CAP_ALLOW,
            'teacher'        => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'coursecreator'  => CAP_ALLOW,
            'guest'          => CAP_ALLOW,
            'manager'        => CAP_ALLOW
        )
    ),

    'mod/sbgallery:submit' => array(
        'riskbitmask'  => RISK_SPAM,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'legacy'       => array(
            'student'        => CAP_ALLOW,
            'teacher'        => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'coursecreator'  => CAP_ALLOW,
            'manager'        => CAP_ALLOW
        )
    ),

    'mod/sbgallery:addimage' => array(
        'riskbitmask'  => RISK_SPAM | RISK_XSS,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'legacy'       => array(
            'editingteacher'  => CAP_ALLOW,
            'coursecreator'   => CAP_ALLOW,
            'manager'         => CAP_ALLOW
        )
    ),

    'mod/sbgallery:addcomment' => array(
        'riskbitmask'  => RISK_SPAM,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'legacy'       => array(
            'guest'           => CAP_ALLOW,
            'student'         => CAP_ALLOW,
            'teacher'         => CAP_ALLOW,
            'editingteacher'  => CAP_ALLOW,
            'manager'         => CAP_ALLOW
        )
    )
);