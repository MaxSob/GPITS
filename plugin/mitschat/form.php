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
require_once($CFG->dirroot.'/lib/formslib.php');

class local_mitschat_form extends moodleform {
    function definition() {
        $mform =& $this->_form;
        $mform->addElement('checkbox', 'enablemitschat', get_string('enablemitschat', 'local_mitschat'));
        $mform->setDefault('enablemitschat', $this->_customdata['enablemitschat']);
        
        $this->add_action_buttons($cancel = false);
    }
}