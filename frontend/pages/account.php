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
            <?php
            $getPurchaseData = callAPI('GET', 'http://68.183.14.165:3000/purchases', false);
            $purchaseResponse = json_decode($getPurchaseData, true);
            // echo json_encode($purchaseResponse);
            $newPurchaseArr = array();

            for ($i = 0; $i < count($purchaseResponse); $i++) {
                $key = array_search($purchaseResponse[$i]['purchaseId'], array_column($purchaseResponse, 'purchaseId'));
                if ($key > 1) {
                    // echo $purchaseResponse[$i]['purchaseId'];
                    $product = array(
                        "purchaseId" => $purchaseResponse[$i]['purchaseId'],
                        "brand" => $purchaseResponse[$i]['name'],
                    );
                    echo json_encode($product);
                }
            }

            echo json_encode($newPurchaseArr);


            // $newPurchaseArr = array();
            // array_map('mapPurchaseArray', $purchaseResponse);
            // echo $key;

            //     for ($i = 0; $i < count($purchaseResponse); $i++) {
            //         $number = $i + 1;
            //         $html =  <<<"EOT"
            //         <li>
            //         <button type="button" class="collapsible"> #$number 23-03-2021</button>
            //         <div class="content">
            //         <ul>
            //         EOT;
            //         echo $html;
            //         $html2 = <<<"EOT"
            //         </ul>
            //         </div>
            //         <figure><img src="http://$currentUrl/productImg/$img" style="height: 300px; width: 200px; object-fit: cover;" alt=""></figure>
            //         <div class="cardText"><h3>$brand</h3>
            //         <h4>$title</h4>
            //         <h4>Size: $size</h4>
            //         <h4>$price SEK</h4></div>
            //         </a>
            //         </li>
            //   EOT;
            //     }
            // echo $purchaseResponse[0]['purchaseId'];
            ?>
            <li>
                <!-- <button type="button" class="collapsible">#3 23-03-2021</button> -->
                <div class="content">
                    <ul>
                        <!-- <?php echoCard();
                                echoCard(); ?> -->
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