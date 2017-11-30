<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * mitschat footer chat module
 *
 * @package    local
 * @subpackage mitschat
 * @copyright  2017 Mario Campos
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('form.php');

require_login();
require_capability('moodle/site:config', context_system::instance());
admin_externalpage_setup('mitschat');

$PAGE->set_url(new moodle_url('/local/mitschat/index.php'));

$value = 0;
$value = get_config('local_mitschat', 'enablemitschat');
$jqhandle = get_config('local_mitschat', 'jqhandle');
$mform = new local_mitschat_form(null, array('enablemitschat' => $value));
$statusmsg = '';
$errormsg = '';

if ($fromform = $mform->get_data()) {

    $enablemitschat = isset($fromform->enablemitschat) ? $fromform->enablemitschat : 0;

    if (!set_config('enablemitschat', $enablemitschat, 'local_mitschat')) {
        $errormsg = get_string('changesnotsaved', 'local_mitschat');
    } else {
        $statusmsg = get_string('changessaved');
    }

    if (!empty($fromform->enablemitschat)) {
        // Footer part.
        $sql = "UPDATE {config} SET value = concat(value, "
                . "'<div id=\"stickycontainer\"></div>') WHERE name = 'additionalhtmlfooter'";
        $DB->execute($sql);
    }

    // Disable mitschat.
    if (empty($fromform->enablemitschat)) {
        // Remove footer div.
        $sql = "UPDATE {config} set value = replace(value, '<div id=\"stickycontainer\"></div>','') "
                . "where value LIKE '%<div id=\"stickycontainer\"></div>%' and name='additionalhtmlfooter'";
        $DB->execute($sql);
        setcookie('user', null, -1, '/');
    }
    unset($fromform->enablemitschat);
    purge_all_caches();
}

echo $OUTPUT->header();

if ($errormsg !== '') {
    echo $OUTPUT->notification($errormsg);
} else if ($statusmsg !== '') {
    echo $OUTPUT->notification($statusmsg, 'notifysuccess');
}
$mform->display();
echo $OUTPUT->footer();
