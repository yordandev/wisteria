<?php
if (isset($_REQUEST['page']) && strstr($_REQUEST['page'], '../') !== false) {
    echo "Directory traversal attempt";
} else if (isset($_REQUEST['page']) && strstr($_REQUEST['page'], 'file://') !== false) {
    echo "Remote file inclusion attempt";
} else {
    $pageName = (isset($_REQUEST['page'])) ?
        $_REQUEST['page'] : 'home';
    $desiredPage = "./public/pages/" . $pageName . ".php";
    $menuVisible = true;
    $minimalNav = false;

    if ($pageName == 'signup' || $pageName == 'login' || $pageName == 'cart' || $pageName == 'checkout' || $pageName == 'confirmation' || $pageName == 'admin' || $pageName == 'account') {
        $menuVisible = false;
    }

    if ($pageName == 'checkout' || $pageName == 'confirmation') {
        $minimalNav = true;
    }
}
