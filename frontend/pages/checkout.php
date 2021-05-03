<div id="checkoutPage">
    <form action="" class="orderInfo">
        <div class="shippingInfo">
            <h1>Shipping Information</h2>
                <input type="text" required name="firstName" placeholder="First name" maxlength="15">
                <input type="text" required name="lastName" placeholder="Last name" maxlength="20">
                <input type="text" required name="address" placeholder="Address" minlength="5" maxlength="60">
                <input type="text" required name="postalCode" placeholder="Postal code" minlength="5" maxlength="5">
                <input type="text" required name="city" placeholder="City" maxlength="20">
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
        <button type="submit" onclick="location.href='/?page=confirmation';">Purchase</button>
    </form>
    <div class="cart">
        <h1>Cart (<?php print(count($cartItems)) ?>)</h1>
        <ul>
            <?php echoCard();
            echoCard();
            echoCard(); ?>
        </ul>
        <div class="total">
            <p>Total</p>
            <p>2400kr</p>
        </div>
    </div>
</div>