<?php
$getData = callAPI('GET', 'http://68.183.14.165:3000/products?limit=8&sortBy=DESC', false);
$response = json_decode($getData, true);

if (!$response[0]['id']) {
    echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>No products are available at the moment.</p>";
    exit;
}

$_SESSION['filters'] = array(
    "gender" => '',
    "category" => '',
    "size" => '',
    "brand" => '',
    "sortBy" => ''
);
?>

<div>
    <figure id="inspoImg1" class="inspoImg">
        <a href="/?page=products&gender=women">
            <div class="container">
                <img src="../productImg/women.jpg" />
                <div class="overlay">
                    <div class="text">SHOP WOMEN</div>
                </div>
            </div>
        </a>
    </figure>
    <figure id="inspoImg2" class="inspoImg">
        <a href="/?page=products&gender=men">
            <div class="container">
                <img src="../productImg/men.jpg" />
                <div class="overlay">
                    <div class="text">SHOP MEN</div>
                </div>
            </div>
        </a>
    </figure>
    <figure id="inspoImg3" class="inspoImg">
        <a href="/?page=products&gender=unisex">
            <div class="container">
                <img src="../productImg/unisex.jpg" />
                <div class="overlay">
                    <div class="text">SHOP UNISEX</div>
                </div>
            </div>
        </a>
    </figure>
</div>
<h2>New Arrivals</h2>
<?php echo echoGrid($response); ?>