<?php
session_unset();
session_destroy();
session_regenerate_id();
$params = session_get_cookie_params();
setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));


echo "<script>window.location.href = '/'</script>";
exit;
