<?php
$gender = htmlspecialchars($_GET["gender"]);
$category = htmlspecialchars($_GET["category"]);
$size = htmlspecialchars($_GET["size"]);
$brand = htmlspecialchars($_GET["brand"]);
$sortBy = htmlspecialchars($_GET["sortBy"]);


$_SESSION['filters'] = array(
    "gender" => $gender,
    "category" => $category,
    "size" => urlencode($size),
    "brand" => urlencode($brand),
    "sortBy" => $sortBy
);

$newUrl = "http://68.183.14.165:3000/products?limit=16";

if ($_SESSION['filters']['gender']) {
    $newUrl = $newUrl . "&gender=" . $_SESSION['filters']['gender'];
}

if ($_SESSION['filters']['category']) {
    $newUrl = $newUrl . "&category=" . $_SESSION['filters']['category'];
}

if ($_SESSION['filters']['size']) {
    $newUrl = $newUrl . "&size=" . $_SESSION['filters']['size'];
}

if ($_SESSION['filters']['brand']) {
    $newUrl = $newUrl . "&brand=" . $_SESSION['filters']['brand'];
}

if ($_SESSION['filters']['sortBy']) {
    $newUrl = $newUrl . "&sortBy=" . $_SESSION['filters']['sortBy'];
}

$getData = callAPI('GET', $newUrl, false);
$productsResponse = json_decode($getData, true);

echo "<h1>" . ucwords($gender)  . " " . ucwords($category) . "</h1>";

if ($_SESSION['filters']['brand'] || $_SESSION['filters']['size']) {
    echo " <a id='filterLink' href=/?page=products&gender=" . $gender . "&category=" . $category . "&sortBy=DESC>Clear all filters</a>";
}
?>

<div id="filter">
    <div class="dropdown" id="size">
        <button onclick="dropdownToggle('myDropdown','sizeButton')" class="dropbtn" id="sizeButton">Size</button>
        <div id="myDropdown" class="dropdown-content">
            <?php
            $getData = callAPI('GET', 'http://68.183.14.165:3000/sizes', false);
            $response = json_decode($getData, true);
            for ($i = 0; $i < count($response); $i++) {
                $lower = strtolower($response[$i]['name']);
                $value = $response[$i]['name'];
                if ($_SESSION['filters']['brand']) {
                    echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size=" . urlencode($lower) . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $sortBy . ">" . $value . "</a>";
                } else {
                    echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size="  . urlencode($lower) . "&sortBy="  . $sortBy . ">" . $value . "</a>";
                }
            }
            ?>
        </div>
    </div>
    <div class="dropdown" id="brand">
        <button onclick="dropdownToggle('myDropdown2','brandButton')" class="dropbtn" id="brandButton">Brand</button>
        <div id="myDropdown2" class="dropdown-content">
            <?php
            $getData = callAPI('GET', 'http://68.183.14.165:3000/brands', false);
            $response = json_decode($getData, true);
            for ($i = 0; $i < count($response); $i++) {
                $lower = strtolower($response[$i]['name']);
                $value = $response[$i]['name'];
                if ($_SESSION['filters']['size']) {
                    echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size=" . $_SESSION['filters']['size'] . "&brand="  . urlencode($lower) . "&sortBy="  . $sortBy . ">" . $value . "</a>";
                } else {
                    echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&brand="  . urlencode($lower) . "&sortBy="  . $sortBy . ">" . $value . "</a>";
                }
            }
            ?>
        </div>
    </div>
    <div class="dropdown" id="sorting">
        <button onclick="dropdownToggle('myDropdown3', 'sortingButton')" class="dropbtn" id="sortingButton">Sort By</button>
        <div id="myDropdown3" class="dropdown-content">
            <?php
            //newest links
            sortNewest($gender, $category);
            // oldest links
            sortOldest($gender, $category);
            ?>
        </div>
    </div>
</div>
<div>
    <?php
    if (count($productsResponse) == 0) {
        echo "No products are currently available.";
    } else {
        echoGrid($productsResponse);
    }
    ?>
</div>