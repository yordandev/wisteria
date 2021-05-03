<div id="cartPage">
    <h1>Cart (<?php print(count($cartItems)) ?>)</h1>
    <ul>
        <?php echoCard();
        echoCard(); ?>
    </ul>
    <div class="total">
        <p>Total</p>
        <p>2400kr</p>
    </div>
    <button type="submit" onclick="location.href='/?page=checkout';">Checkout</button>
</div>