<?php
$id = htmlspecialchars($_GET["id"]);
$get_data = callAPI('GET', 'http://68.183.14.165:3000/products?limit=8', false);
$response = json_decode($get_data, true);
?>

<div>
    <a href="">
        <figure id="inspoImg1" class="inspoImg">
            <div class="container">
                <img src="https://picsum.photos/800/500" />
                <div class="overlay">
                    <div class="text">SHOP WOMEN</div>
                </div>
            </div>
        </figure>
    </a>
    <a href="">
        <figure id="inspoImg2" class="inspoImg">
            <div class="container">
                <img src="https://picsum.photos/600/500" />
                <div class="overlay">
                    <div class="text">SHOP MEN</div>
                </div>
            </div>
        </figure>
    </a>
    <a href="">
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
<?php echo echoGrid($response) ?>