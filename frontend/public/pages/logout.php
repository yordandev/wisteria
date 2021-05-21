<?php
$params = session_get_cookie_params();
setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
session_unset();
session_destroy();

echo "<script>window.location.href = '/'</script>";
exit;
