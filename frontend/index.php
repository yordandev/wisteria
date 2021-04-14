<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $desired_page = (isset($_REQUEST['page'])) ?
        $_REQUEST['page'] : 'home';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="./img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./css/layout.css">
    <link rel="stylesheet" type="text/css" href="./components/header/header.css">
    <link rel="stylesheet" type="text/css" href="./components/menu/menu.css">
    <link rel="stylesheet" type="text/css" href="./components/footer/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo "/css/" . $desired_page . ".css"; ?>">
    <script src="./js/menu.js" />
    <title>Wisteria || <?php echo ucfirst($desired_page); ?> </title>

</head>

<body>
    <div class="grid-container">
        <?php
        include('./components/header/header.php')
        ?>
        <div class="content-container">
            <?php
            include('./components/menu/menu.php')
            ?>
            <div class="content">
                <?php
                include("pages/" . $desired_page . ".php");
                ?>
            </div>
        </div>
        <?php
        include('./components/footer/footer.php')
        ?>
    </div>
</body>


</html>