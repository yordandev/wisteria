<?php
$id = htmlspecialchars($_GET["id"]);
$get_data = callAPI('GET', 'http://68.183.14.165:3000/products/' . $id, false);
$response = json_decode($get_data, true);
$image =  $response[0]['image'];
$brand = $response[0]['brand'];
$title = $response[0]['title'];
$fit = $response[0]['fit'];
$condition = $response[0]['condition'];
$size = $response[0]['size'];
$price = $response[0]['price'];
?>

<div id="singleProductPage">
    <div id="product">
        <figure>
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
        </figure>
        <div class="productInfo">
            <h3><?php echo $brand; ?></h3>
            <h4><?php echo $title; ?></h4>
            <h4><?php echo $fit; ?></h4>
            <h4><?php echo $condition; ?></h4>
            <h4><?php echo $size; ?></h4>
            <h4><?php echo $price . 'kr'; ?></h4>
            <button>Add to cart</button>
        </div>
    </div>
</div>