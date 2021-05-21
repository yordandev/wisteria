<?php
session_unset();
session_destroy();
setcookie("PHPSESSID", "", time() - 1, '/');

echo "<script>window.location.href = '/'</script>";
exit;
