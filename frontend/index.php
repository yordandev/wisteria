<?php
include('./app/functions.php');
include('./app/router.php');
include('./app/session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="./public/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./public/css/layout.css">
    <link rel="stylesheet" type="text/css" href="./public/components/header/header.css">
    <link rel="stylesheet" type="text/css" href="./public/components/menu/menu.css">
    <link rel="stylesheet" type="text/css" href="./public/components/footer/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo './public/css/' . $pageName . '.css'; ?>">
    <script src='./public/js/main.js'></script>
    <title>Wisteria || <?php echo ucfirst($pageName); ?> </title>
</head>

<body>
    <div class="<?php $pageName == 'home' ? print('grid-container-home') : print('grid-container') ?>">
        <div class="<?php switch ($pageName) {
                        case 'home':
                            print('grid-container-home');
                            break;
                        case 'cart':
                            print('grid-container-cart');
                            break;
                        default:
                            print('grid-container');
                    } ?>"></div>
        <?php
        include('./public/components/header/header.php');
        ?>
        <div class=" <?php $menuVisible ? print('content-container') : print('content-container-no-menu') ?>">
            <?php
            if ($menuVisible) {
                include('./public/components/menu/menu.php');
            }
            ?>
            <div class="content">
                <?php
                if (file_exists($desiredPage)) {
                    include($desiredPage);
                } else {
                    include("./public/pages/404.php");
                }
                ?>
            </div>
        </div>
        <?php
        include('./public/components/footer/footer.php')
        ?>
    </div>
</body>


</html>