<div class="header-container">
    <nav class="<?php $minimalNav ? print('main-nav-minimal') : print('main-nav') ?>">
        <a href="../../">
            <figure id="logo">
                <img src="../../img/WisteriaLogo.png" alt="Wisteria's Logo">
            </figure>
        </a>
        <ul id="menu">
            <?php
            if ($_SESSION['userType'] == 'Admin') {
                echo <<<EOT
                    <li>
                        <a href="/?page=admin">Admin</a>
                    </li>
               EOT;
            }
            ?>
            <li>
                <a href="/?page=account">Account</a>
            </li>
            <li>
                <a href="/?page=cart">Cart</a>
            </li>
            <!-- <?php
                    if ($_SESSION['userType']) {
                        echo <<<EOT
                    <li>
                        <a href="/?page=logout">Logout</a>
                    </li>
               EOT;
                    }
                    ?> -->
            <li>
                <a href="/?page=logout">Logout</a>
            </li>
        </ul>
    </nav>
</div>