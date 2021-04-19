<div id="checkoutPage">
    <div class="orderInfo">
        <div class="shippingInfo">
            <h1>Shipping Information</h1>
            <input type="text" required placeholder="First name">
            <input type="text" required placeholder="Last name">
            <input type="text" required placeholder="Address">
            <input type="text" required placeholder="Postal code">
            <input type="text" required placeholder="City">
        </div>
        <div class="paymentInfo">
            <h2>Payment Option</h2>
            <label>
                <input type="radio" name="payment" value="small" checked>
                <img src="http://placehold.it/40x60/0bf/fff&text=A">
            </label>
            <label>
                <input type="radio" name="payment" value="small">
                <img src="http://placehold.it/40x60/0bf/fff&text=A">
            </label>
            <label>
                <input type="radio" name="payment" value="small">
                <img src="http://placehold.it/40x60/0bf/fff&text=A">
            </label>
        </div>
    </div>
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