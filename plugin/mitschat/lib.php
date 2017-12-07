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
 * mitschat module
 *
 * @package    local
 * @subpackage mitschat
 * @copyright  2017 Mario Campos
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Update value in db for enabling/disabling mitschat
 * Delete div from additionalhtmlfooter
 * Unset all relevent cookie
 *
 * @return void
 * @since  Moodle 3.0
 */
function local_mitschat_disable() {
    set_config('enablemitschat', 0, 'local_mitschat');
    $sql = "UPDATE {config} set value = replace(value, '<div id=\"stickycontainer\"></div>','') "
                . "where value LIKE '%<div id=\"stickycontainer\"></div>%' and name='additionalhtmlfooter'";
    $DB->execute($sql);
    setcookie('user', null, -1, '/');
    purge_all_caches();
}

/**
 * Display a error messages during connection.
 *
 * @return void
 * @since  Moodle 3.0
 */
function local_mitschat_js_messages($message) {
    echo '<script type="text/javascript">'."\n//<![CDATA[\n alert('".$message."');\n//]]>\n</script>";
}

function local_mitschat_extend_navigation(global_navigation $nav) {
    global $USER, $CFG, $PAGE;
    if (!$USER->id) {
        setcookie('user', null, -1, '/');
    }
    if (get_config('local_mitschat', 'enablemitschat')) {
        if (!isset($_COOKIE['user'])) {
            if (!empty($USER) && $USER->id) 
                setcookie('user', $USER->id, 0, '/');
            else
                setcookie('user', '123', 0, '/');
        } else {
            if (!empty($USER) && $USER->id) {
                // Moodle user pic url.
                $userpicture = moodle_url::make_pluginfile_url(context_user::instance($USER->id)->id, 'user', 'icon', null, '/', 'f2');
                $src = $userpicture->out(false);
                $PAGE->requires->js('/local/mitschat/module.js');
                $mitsarray = array('wwwroot' =>"$CFG->wwwroot/",
                'sid'=>$USER->sesskey, 'id' => $USER->id, 
                'fname' => $USER->firstname, 'lname' => $USER->lastname, 'imageurl'=>$src);
                $PAGE->requires->js_init_call('set_mitschat_variable', array($mitsarray));
            }
        $PAGE->requires->js_call_amd('local_mitschat/mitschat', 'init',array("$CFG->wwwroot/"));
        }
    }
}

/**
 * user logout event handler
 *
 * @param \core\event\user_loggedout $event The event.
 * @return void
 */
function local_mitschat_user_loggedout($event) {
    setcookie('user', null, -1, '/');
}
