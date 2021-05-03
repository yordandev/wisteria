<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('./functions.php');
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

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <!-- <link rel="icon" type="image/png" href="./img/favicon.ico" /> -->
    <link rel="stylesheet" type="text/css" href="./css/layout.css">
    <link rel="stylesheet" type="text/css" href="./components/header/header.css">
    <link rel="stylesheet" type="text/css" href="./components/menu/menu.css">
    <link rel="stylesheet" type="text/css" href="./components/footer/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo './css/' . $pageName . '.css'; ?>">
    <script src='./js/main.js'></script>
    <title>Wisteria || <?php echo ucfirst($pageName); ?> </title>

</head>

<body>
    <div class="<?php $pageName == 'home' ? print('grid-container-home') : print('grid-container') ?>">
        <?php
        include('./components/header/header.php')
        ?>
        <div class="<?php $menuVisible ? print('content-container') : print('content-container-no-menu') ?>">
            <?php
            if ($menuVisible) {
                include('./components/menu/menu.php');
            }
            ?>
            <div class="content">
                <?php
                if (file_exists($desiredPage)) {
                    include($desiredPage);
                } else {
                    include("pages/404.php");
                }
                ?>
            </div>
        </div>
        <?php
        include('./components/footer/footer.php')
        ?>
    </div>
</body>


</html>