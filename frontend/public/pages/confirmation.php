<?php
if (isset($_GET["purchaseId"]) && $_GET["purchaseMessage"]) {
    $purchaseId = $_GET["purchaseId"];
    $purchaseMessage = $_GET["purchaseMessage"];
} else {
    // echo "<script>window.location.href = '/'</script>";
}

?>
<div id="confirmationPage">
    <h1><?php echo $purchaseMessage; ?></h1>
    <p>Thank you for shopping sustainably!</p>
    <p>Estimated delivery time: <span>1-3 working days</span></p>
    <p>Purchase Id: <span><?php echo $purchaseId; ?></span>
    </p>
    <a href="/">Continue shopping</a>
</div>