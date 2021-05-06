<?php
$pageName = (isset($_REQUEST['page'])) ?
    $_REQUEST['page'] : 'home';
$desiredPage = "pages/" . $pageName . ".php";
$menuVisible = true;
$minimalNav = false;
$isLoggedIn = false;
$cartItems = [1, 2, 3];

if ($pageName == 'signup' || $pageName == 'login' || $pageName == 'cart' || $pageName == 'checkout' || $pageName == 'confirmation' || $pageName == 'admin' || $pageName == 'account') {
    $menuVisible = false;
}

if ($pageName == 'checkout' || $pageName == 'confirmation') {
    $minimalNav = true;
}
