<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <script src="./js/menu.js"></script>
    <title>Wisteria E-Commerce</title>
    <?php
    $url = rawurldecode($_SERVER['REQUEST_URI']);
    $desired_page = (isset($_REQUEST['page'])) ?
        $_REQUEST['page'] : 'home';
    ?>
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
                /*Includes specific page content*/
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