<?php
if (!$_SESSION['userType']) {
    echo "<script>window.location.href = '?page=login'</script>";
}

if (isset($_GET["action"]) && $_GET["action"] == 'updatePs' && isset($_POST["updatedPs"])) {
    $passwordData =  array(
        "password" => $_POST['updatedPs'],
    );

    $updateError = '';

    $getPasswordData = callAPI('PATCH', 'http://68.183.14.165:3000/users/:id', json_encode($passwordData));
    $passwordResponse = json_decode($getPasswordData, true);

    if ($passwordResponse['error']) {
        $updateError = $passwordResponse['error'];
    }
    if ($passwordResponse['message']) {
        echo $passwordResponse['message'];
    }
}

if (isset($_GET["action"]) && $_GET["action"] == 'deleteUser') {

    $deleteError = '';
    $getDeletedData = callAPI('DELETE', 'http://68.183.14.165:3000/users/:id', false);
    $deleteResponse = json_decode($getDeletedData, true);

    if ($deleteResponse['error']) {
        $deleteError = $deleteResponse['error'];
    }
    if ($deleteResponse['message']) {
        //echo $passwordResponse['message'];
        session_unset();
        session_destroy();
        echo "<script>window.location.href = '/'</script>";

        exit;
    }
}

?>

<div id="accountPage">
    <div id="accountDetails">
        <h1>Personal details</h1>
        <p>Email: <?php echo $_SESSION['userEmail']; ?></p>
        <button type="button" class="collapsible">Update account</button>
        <div class="content">
            <?php $updateError ? print("<p style='color: red; margin-bottom: 48px;'>{$updateError}</p>") : '' ?>
            <form action="/?page=account&action=updatePs" method="POST">
                <input type="password" name="updatedPs" id="signUpPassword" required minlength="8" maxlength="32" placeholder="New password">
                <input type="password" id="signUpConfirmPassword" required minlength="8" maxlength="32" placeholder="Repeat new password">
                <button type="submit">Update</button>
            </form>
        </div>
        <form action="/?page=account&action=deleteUser" method="POST">
            <button>Delete account</button>
        </form>
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