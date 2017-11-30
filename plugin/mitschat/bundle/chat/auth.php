<?php
/**
 * API key authentication
 *
 * @package    chat
 * @copyright  2017 Mario Campos
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
if (!isset($_COOKIE['user'])) {
    // Send auth detail to server.
    global $USER;
    if (!empty($USER) && $USER->id) 
        setcookie('user', $USER->id, 0, '/');
    else
        setcookie('user', '123', 0, '/');
}
ob_end_flush();
?>
<script type="text/javascript">
    <?php echo "user='".$_COOKIE['user']."';"; ?>
</script>