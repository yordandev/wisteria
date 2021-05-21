<?php
session_start();

if ($_SESSION['userType'] && $_SERVER['REMOTE_ADDR'] != $_SESSION['ip']) {
    session_unset();
    session_destroy();
    session_regenerate_id();
}

if ($_SESSION['userType'] && $_SERVER['HTTP_USER_AGENT'] != $_SESSION['useragent']) {
    session_unset();
    session_destroy();
    session_regenerate_id();
}

if ($_SESSION['userType'] && time() > ($_SESSION['lastaccess'] + 3600)) {
    session_unset();
    session_destroy();
    session_regenerate_id();
} else {
    $_SESSION['lastaccess'] = time();
}

if (!$_SESSION['cartItems']) {
    $_SESSION['cartItems'] = array();
}

if (!$_SESSION['cartTotal']) {
    $_SESSION['cartTotal'] = 0;
}
