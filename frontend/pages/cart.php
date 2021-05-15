<?php
if (isset($_GET["action"]) && $_GET["action"] == 'removeItem' && isset($_GET["itemId"])) {
    $itemId = $_GET["itemId"];
    $itemIndexInArray = array_search($itemId, array_column($_SESSION['cartItems'], 'id'));
    $_SESSION['cartTotal'] = $_SESSION['cartTotal'] - $_SESSION['cartItems'][$itemIndexInArray]['price'];
    unset($_SESSION['cartItems'][$itemIndexInArray]);
    $_SESSION['cartItems'] = array_values($_SESSION['cartItems']);
    echo "<script>window.location.href = '?page=cart'</script>";
};
?>

<div id="cartPage">
    <h1>Cart <?php count($_SESSION['cartItems']) == 0 ? '' : print('(' . count($_SESSION['cartItems']) . ')') ?></h1>
    <ul>
        <?php echoGrid($_SESSION['cartItems']) ?>
    </ul>
    <div class="total">
        <p>Total</p>
        <p><?php echo $_SESSION['cartTotal'] . 'SEK' ?></p>
    </div>
    <button type="submit" onclick="location.href='/?page=checkout';">Checkout</button>
</div>