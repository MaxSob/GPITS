<?php
// This file is part of Moodle - http://vidyamantra.com/
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
 * mitschat module upgrade code
 *
 * @package    local
 * @subpackage mitschat
 * @copyright  2017 Mario Campos
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * mitschat module upgrade task
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool always true
 */
function xmldb_local_mitschat_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    // Moodle v1.0.1 release upgrade line
    // Put any upgrade step following this.
    if ($oldversion < 2014063000) {
        set_config('additionalhtmlhead', '');
        set_config('additionalhtmlfooter', '');
        unset_config('enablemitschat', 'local_mitschat');
        // mitschat savepoint reached.
        upgrade_plugin_savepoint(true, 2014063000, 'local', 'mitschat');
    }

    // mitschat v1.1.2 release upgrade line
    if ($oldversion < 2014092300) {
        // Remove header part.
        $additionalhtmlhead = preg_replace("/<!-- fcStart -->.*<!-- fcEnd -->/", "", $CFG->additionalhtmlhead);
        set_config('additionalhtmlhead', $additionalhtmlhead);

        // Update header part.
        $fstring = '<!-- fcStart --><script language = "JavaScript"> var wwwroot="'.
        $CFG->wwwroot.'/";</script><script type="text/javascript" src = "'.
        $CFG->wwwroot.'/local/mitschat/include.js"></script><!-- fcEnd -->';
        $DB->execute('UPDATE {config} set value = concat(value, :fstring) WHERE  name = :hname',
                array( 'fstring' => $fstring, 'hname' => 'additionalhtmlhead'));

        // mitschat savepoint reached.
        upgrade_plugin_savepoint(true, 2014092300, 'local', 'mitschat');
    }

    // mitschat v1.2.1 release upgrade line
    if ($oldversion < 2014111300) {
    	if(get_config('local_mitschat', 'enablemitschat')){
        	// Remove header part.
        	$additionalhtmlhead = preg_replace("/<!-- fcStart -->.*<!-- fcEnd -->/", "", $CFG->additionalhtmlhead);
        	set_config('additionalhtmlhead', $additionalhtmlhead);

        	// Update header part.
        	$fstring = '<!-- fcStart --><script language = "JavaScript"> var wwwroot="'.$CFG->wwwroot.'/";</script><script type="text/javascript" src = "'.$CFG->wwwroot.'/localmitschat/bundle/chat/bundle/jquery/jquery-1.11.0.min.js"></script><script type="text/javascript">$=jQuery.noConflict( );</script><script type="text/javascript" src = "'.$CFG->wwwroot.'/local/mitschat/bundle/chat/bundle/jquery/jquery-ui.min.js"></script><script type="text/javascript" src = "'.$CFG->wwwroot.'/local/mitschat/auth.php"></script><script type="text/javascript" src = "'.$CFG->wwwroot.'/local/mitschat/bundle/chat/bundle/io/build/iolib.min.js"></script><script type="text/javascript" src = "'.$CFG->wwwroot.'/local/mitschat/bundle/chat/build/chat.min.js"></script><script type="text/javascript" src = "'.$CFG->wwwroot.'/local/mitschat/index.js"></script><!-- fcEnd -->';

        	$DB->execute('UPDATE {config} set value = concat(value, :fstring) WHERE  name = :hname',
                array( 'fstring' => $fstring, 'hname' => 'additionalhtmlhead'));
		}
        // mitschat savepoint reached.
        upgrade_plugin_savepoint(true, 2014111300, 'local', 'mitschat');
    }
    // mitschat v 2.0 release upgrade line
    if ($oldversion < 2016082900) {
    	if(get_config('local_mitschat', 'enablemitschat')){
        	$additionalhtmlhead = preg_replace("/<!-- fcStart -->.*<!-- fcEnd -->/", "", $CFG->additionalhtmlhead);
        	set_config('additionalhtmlhead', $additionalhtmlhead);
        	set_config('jqhandle', 0, 'local_mitschat');
        }
        //hidden because of problem - lost section
        //upgrade_plugin_savepoint(true, 2016082900, 'local', 'mitschat');
    }
    
    return true;

}
