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
            <li>
                <div>
                    <figure>
                        <img src="https://picsum.photos/100/200" alt="Item 1">
                    </figure>
                    <div>
                        <h3>Brand name</h3>
                        <h4>Product title</h4>
                        <h4>Fit and condition</h4>
                        <h4>Size</h4>
                        <h4>Price</h4>
                    </div>
                    <a href="#">Remove</a>
                </div>
            </li>
            <li>
                <div>
                    <figure>
                        <img src="https://picsum.photos/100/200" alt="Item 1">
                    </figure>
                    <div>
                        <h3>Brand name</h3>
                        <h4>Product title</h4>
                        <h4>Fit and condition</h4>
                        <h4>Size</h4>
                        <h4>Price</h4>
                    </div>
                    <a href="#">Remove</a>
                </div>
            </li>
            <li>
                <div>
                    <figure>
                        <img src="https://picsum.photos/100/200" alt="Item 1">
                    </figure>
                    <div>
                        <h3>Brand name</h3>
                        <h4>Product title</h4>
                        <h4>Fit and condition</h4>
                        <h4>Size</h4>
                        <h4>Price</h4>
                    </div>
                    <a href="#">Remove</a>
                </div>
            </li>
        </ul>
        <div class="total">
            <p>Total</p>
            <p>2400kr</p>
        </div>
    </div>
</div>