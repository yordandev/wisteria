<?php
$id = htmlspecialchars($_GET["id"]);
$getData = callAPI('GET', 'http://68.183.14.165:3000/products/' . $id, false);
$response = json_decode($getData, true);

if (!$response[0]['id']) {
    echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Product doesn't exist.</p>";
    exit;
}

$image =  $response[0]['image'];
$brand = $response[0]['brand'];
$title = $response[0]['name'];
$fit = $response[0]['fit'];
$condition = $response[0]['condition'];
$size = $response[0]['size'];
$price = $response[0]['price'];
$currentUrl = $_SERVER['HTTP_HOST'];
?>

<div id="singleProductPage">
    <div id="product">
        <figure>
            <img src=<?php echo "http://$currentUrl/productImg/$image" ?> . alt=<?php echo $title; ?>>
        </figure>
        <div class="productInfo">
            <h3><?php echo $brand; ?></h3>
            <h4><?php echo $title; ?></h4>
            <h4 style="font-size: 16px;">Fit: <?php echo $fit; ?></h4>
            <h4 style="font-size: 16px;">Condition: <?php echo $condition; ?></h4>
            <h4 style="font-size: 16px;">Size: <?php echo $size; ?></h4>
            <h4 style="font-size: 16px;">Price: <?php echo $price . 'kr'; ?></h4>
            <button>Add to cart</button>
        </div>
    </div>
</div>