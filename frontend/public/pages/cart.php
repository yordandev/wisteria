<?php

if (isset($_GET["action"]) && $_GET["action"] == 'removeItem' && isset($_GET["itemId"])) {
    $itemId = $_GET["itemId"];
    $itemIndexInArray = array_search($itemId, array_column($_SESSION['cartItems'], 'id'));
    $_SESSION['cartTotal'] = $_SESSION['cartTotal'] - $_SESSION['cartItems'][$itemIndexInArray]['price'];
    unset($_SESSION['cartItems'][$itemIndexInArray]);
    $_SESSION['cartItems'] = array_values($_SESSION['cartItems']);
    echo "<script>window.location.href = '?page=cart'</script>";
};

$total = $_SESSION['cartTotal'];

?>

<div id="cartPage">
    <h1>Cart <?php count($_SESSION['cartItems']) == 0 ? '' : print('(' . count($_SESSION['cartItems']) . ')') ?></h1>
    <ul>
        <?php echoGrid($_SESSION['cartItems']) ?>
    </ul>
    <?php
    if ($_SESSION['cartItems']) {
        echo <<<HTMLSTRING
            <div class="total">
            <p>Total</p>
            <p>$total SEK</p>
            </div>
            <a id="checkoutBtn" href="/?page=checkout">Checkout</a>
            HTMLSTRING;
    } else {
        echo <<<HTMLSTRING
        <div id="emptyCart">
        <p>You have no products in your cart.</p>
        <a href='/?page=products&gender=unisex&category=all&sortBy=DESC'>Go shopping!</a>
        </div>
        HTMLSTRING;
    }
    ?>
</div>