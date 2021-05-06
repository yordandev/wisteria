<?php
if ($_POST['payload']) {
    shell_exec('cd /root/wisteria && git reset --hard HEAD && git pull origin master');
}
?>hi