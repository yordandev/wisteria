<div class="header-container">
    <nav class="<?php $minimalNav ? print('main-nav-minimal') : print('main-nav') ?>">
        <a href="../../">
            <figure id="logo">
                <img src="../../public/img/WisteriaLogo.png" alt="Wisteria's Logo">
            </figure>
        </a>
        <ul id="menu">
            <?php
            if ($_SESSION['userType'] == 'Admin') {
                echo <<<HTMLSTRING
                    <li>
                        <a href="/?page=admin">Admin</a>
                    </li>
               HTMLSTRING;
            }
            ?>
            <li>
                <a href="/?page=account">Account</a>
            </li>
            <li>
                <a href="/?page=cart">Cart <?php count($_SESSION['cartItems']) == 0 ? '' : print('(' . count($_SESSION['cartItems']) . ')') ?></a>
            </li>
            <?php
            if ($_SESSION['userType']) {
                echo <<<HTMLSTRING
                    <li>
                        <a href="/?page=logout">Logout</a>
                    </li>
               HTMLSTRING;
            }
            ?>

        </ul>
    </nav>
</div>