<?php
if (!$_SESSION['userType']) {
    echo "<script>window.location.href = '?page=login'</script>";
}

if (!$_SESSION['cartItems']) {
    echo "<script>window.location.href = '?page=cart'</script>";
}

if (isset($_POST['firstName'])) {
    $purchaseError = '';
    $products = array_column($_SESSION['cartItems'], 'id');
    $productData = array(
        "products" => $products
    );

    $getPurchaseData = callAPI('POST', 'http://68.183.14.165:3000/purchases', json_encode($productData));
    $purchaseResponse = json_decode($getPurchaseData, true);


    if ($purchaseResponse['error']) {
        $purchaseError = $purchaseResponse['error'];
        echo $purchaseError;
    }

    if ($purchaseResponse['purchaseId'] && $purchaseResponse['message']) {
        $purchaseId = $purchaseResponse['purchaseId'];
        $purchaseMessage = $purchaseResponse['message'];
        $_SESSION['cartItems'] = array();
        $_SESSION['cartTotal'] = 0;
        echo "<script>window.location.href = '?page=confirmation&purchaseId=$purchaseId&purchaseMessage=$purchaseMessage'</script>";
    }
}

?>

<div id="checkoutPage">
    <form action="" method="POST" class="orderInfo">
        <div class="shippingInfo">
            <h1>Shipping Information</h2>
                <input type="text" required name="firstName" placeholder="First name" maxlength="15" pattern="[A-Za-z]+">
                <input type="text" required name="lastName" placeholder="Last name" maxlength="20" pattern="[A-Za-z]+">
                <input type="text" required name="address" placeholder="Address" minlength="5" maxlength="60" pattern="[A-Za-z0-9]+">
                <input type="text" required name="postalCode" placeholder="Postal code" minlength="5" maxlength="5" pattern="[0-9]+">
                <input type=" text" required name="city" placeholder="City" maxlength="20" pattern="[A-Za-z]+">
        </div>
        <div class="paymentInfo">
            <h2>Payment Option</h2>
            <label>
                <input type="radio" name="payment" value="paypal" checked required>
                <img src="../img/paypal-logo.png">
            </label>
            <label>
                <input type="radio" name="payment" value="klarna" required>
                <img src="../img/klarna-logo.png">
            </label>
        </div>
        <button type="submit">Purchase</button>
    </form>
    <div class="cart">
        <h1>Cart (<?php print(count($_SESSION['cartItems'])) ?>)</h1>
        <ul>
            <?php echoGrid($_SESSION['cartItems']) ?>
        </ul>
        <div class="total">
            <p>Total</p>
            <p><?php echo $_SESSION['cartTotal']; ?> SEK</p>
        </div>
    </div>
</div>