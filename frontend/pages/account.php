<?php
if ($_SESSION['userType'] == 'Guest') {
    echo "<script>window.location.href = '?page=login'</script>";
}
?>

<div id="accountPage">
    <div id="accountDetails">
        <h1>Personal details</h1>
        <p>Email: </p>
        <button>Update account</button>
        <button>Delete account</button>
    </div>
    <div id="orderDetails">
        <h1>Orders</h1>
        <ul>
            <li>
                <button type="button" class="collapsible">#3 23-03-2021</button>
                <div class="content">
                    <ul>
                        <?php echoCard();
                        echoCard(); ?>
                    </ul>
                    <div class="total">
                        <p>Total</p>
                        <p>2400kr</p>
                    </div>
                </div>
            </li>
            <li>
                <button type="button" class="collapsible">#2 23-03-2021</button>
                <div class="content">
                    <ul>
                        <?php echoCard();
                        echoCard(); ?>
                    </ul>
                    <div class="total">
                        <p>Total</p>
                        <p>2400kr</p>
                    </div>
                </div>
            </li>
            <li>
                <button type="button" class="collapsible">#1 23-03-2021</button>
                <div class="content">
                    <ul>
                        <?php echoCard();
                        echoCard(); ?>
                    </ul>
                    <div class="total">
                        <p>Total</p>
                        <p>2400kr</p>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</div>