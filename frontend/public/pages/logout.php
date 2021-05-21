<?php
setcookie("PHPSESSID", "", time() - 1, '/');
session_unset();
session_destroy();

echo "<script>window.location.href = '/'</script>";
exit;
