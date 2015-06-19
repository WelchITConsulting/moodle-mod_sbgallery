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
 * Filename : view
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 17 Jun 2015
 */

require_once('../../../config.php');
require_once($CFG->dirroot . '/mod/sbgallery/locallib.php');

$id = optional_param('id', 0, PARAM_INT);    // Course module id;
$a  = optional_param('a', 0, PARAM_INT);     // Instance id;

if ($id) {
    if (!$cm = get_coursemodule_from_id('sbgallery', $id)) {
        print_error('invalidcoursemodule');
    }
    if (!$course = $DB->get_record('course', array('id' => $cm->course))) {
        print_error('coursemisconf');
    }
    if (!$sbgallery = $DB->get_record('registration', array('id' => $cm->instance))) {
        print_error('invalidcoursemodule');
    }
} else {
    if (!$sbgallery = $DB->get_record('registration', array('id' => $a))) {
        print_error('invalidcoursemodule');
    }
    if (!$course = $DB->get_record('course', array('id' => $sbgallery->course))) {
        print_error('coursemisconf');
    }
    if (!$cm = get_coursemodule_from_instance('sbgallery', $sbgallery->id, $course->id)) {
        print_error('invalidcoursemodule');
    }
}
require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);

$url = new moodle_url($CFG->wwwroot . '/mod/sbgallery/view.php');
if (!empty($id)) {
    $url->param('id', $id);
} else {
    $url->param('a', $a);
}
$PAGE->set_url($url);
$PAGE->set_context($context);

$PAGE->set_title(format_string($sbgallery->name));
$PAGE->set_heading(format_string($course->fullname));

echo $OUTPUT->header()
   . $OUTPUT->heading(format_text($sbgallery->name))
   . ($sbgallery->intro ? $OUTPUT->box(format_module_intro('sbgallery', $sbgallery, $cm->id)) : '');

$options = array();
if (has_capability('mod/sbgallery:addimage', $context)) {
    $options[] = html_writer::link(new moodle_url('/mod/sbgallery/image_form.php', array('id' => $cm->id)),
                                   get_string('addimage', 'sbgallery'));
}
if (has_capability('mod/sbgallery:addcomment', $context)) {
    $options[] = html_writer::link(new moodle_url('/mod/sbgallery/comment_form.php', array('id' => $cm->id)),
                                   get_string('addcomment', 'sbgallery'));
}
if (count($options) > 0) {
    echo $OUTPUT->box(implode(' | ', $options), 'center');
}

echo $OUPTPUT->box_start('generalbox sbgallery clearfix');

echo $OUTPUT->box_end()
   . $OUTPUT->footer();
