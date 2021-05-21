<?php
session_start();

if ($_SESSION['userType'] && $_SERVER['REMOTE_ADDR'] != $_SESSION['ip']) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_unset();
    session_destroy();

    echo "<script>window.location.href = '/'</script>";
}

if ($_SESSION['userType'] && $_SERVER['HTTP_USER_AGENT'] != $_SESSION['useragent']) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_unset();
    session_destroy();

    echo "<script>window.location.href = '/'</script>";
}

if ($_SESSION['userType'] && time() > ($_SESSION['lastaccess'] + 3600)) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_unset();
    session_destroy();

    echo "<script>window.location.href = '/'</script>";
} else {
    $_SESSION['lastaccess'] = time();
}

if (!$_SESSION['token']) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $token = $_SESSION['token'];
    echo "token set";
}

if (!$_SESSION['cartItems']) {
    $_SESSION['cartItems'] = array();
}

if (!$_SESSION['cartTotal']) {
    $_SESSION['cartTotal'] = 0;
}
