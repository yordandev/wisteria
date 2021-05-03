<?php
$id = htmlspecialchars($_GET["id"]);
$get_data = callAPI('GET', 'http://68.183.14.165:3000/products?limit=8' . $id, false);
$response = json_decode($get_data, true);
$image =  $response[0]['image'];
$brand = $response[0]['brand'];
$title = $response[0]['title'];
$fit = $response[0]['fit'];
$condition = $response[0]['condition'];
$size = $response[0]['size'];
$price = $response[0]['price'];
?>

<div>
    <a href="/?page=products&gender=women">
        <figure id="inspoImg1" class="inspoImg">
            <div class="container">
                <img src="https://picsum.photos/800/500" />
                <div class="overlay">
                    <div class="text">SHOP WOMEN</div>
                </div>
            </div>
        </figure>
    </a>
    <a href="/?page=products&gender=men">
        <figure id="inspoImg2" class="inspoImg">
            <div class="container">
                <img src="https://picsum.photos/600/500" />
                <div class="overlay">
                    <div class="text">SHOP MEN</div>
                </div>
            </div>
        </figure>
    </a>
    <a href="/?page=products&gender=unisex">
        <figure id="inspoImg3" class="inspoImg">
            <div class="container">
                <img src="https://picsum.photos/1000/400" />
                <div class="overlay">
                    <div class="text">SHOP UNISEX</div>
                </div>
            </div>
        </figure>
    </a>
</div>
<h2>New Arrivals</h2>
<?php echo echoGrid(8) ?>