<?php
if ($_POST['payload']) {
    shell_exec('cd /root/wisteria && git pull origin master');
}
?>hi