<?php
session_start();
$_SESSION['userType'] = 'Guest';

// if ($_SERVER['REMOTE_ADDR'] != $_SESSION['ip']) {
//     session_unset();
//     session_destroy();
// }

// if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION['useragent']) {
//     session_unset();
//     session_destroy();
// }

// if (time() > ($_SESSION['lastaccess'] + 3600)) {
//     session_unset();
//     session_destroy();
// } else {
//     $_SESSION['lastaccess'] = time();
// }
