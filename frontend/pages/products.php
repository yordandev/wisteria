<?php
$gender = htmlspecialchars($_GET["gender"]);
$category = htmlspecialchars($_GET["category"]);
$size = htmlspecialchars($_GET["size"]);
$brand = htmlspecialchars($_GET["brand"]);
$sortBy = htmlspecialchars($_GET["sortBy"]);


$_SESSION['filters'] = array(
    "gender" => $gender,
    "category" => $category,
    "size" => $size,
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

$get_data = callAPI('GET', $newUrl, false);
$productsResponse = json_decode($get_data, true);

echo "<h1>" . ucwords($gender)  . " " . ucwords($category) . "</h1>";

?>
<div id="filter">
    <div class="dropdown" id="size">
        <button onclick="myFunction('myDropdown','sizeButton')" class="dropbtn" id="sizeButton">Size</button>
        <div id="myDropdown" class="dropdown-content">
            <?php
            $get_data = callAPI('GET', 'http://68.183.14.165:3000/sizes', false);
            $response = json_decode($get_data, true);
            for ($i = 0; $i < count($response); $i++) {
                $lower = strtolower($response[$i]['name']);
                $value = $response[$i]['name'];
                // echo "<a href=" . $currentUrl . "&size="  . $lower . " onclick='clickAndDisable(this)'>" . $value . "</a>";
                $sessionBrand = $_SESSION['filters']['brand'];
                if ($_SESSION['filters']['brand']) {
                    echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size=" . $lower . "&brand="  . $sessionBrand . "&sortBy="  . $sortBy . ">" . $value . "</a>";
                } else {
                    echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size="  . $lower . "&sortBy="  . $sortBy . ">" . $value . "</a>";
                }
            }
            ?>
        </div>
    </div>
    <div class="dropdown" id="brand">
        <button onclick="myFunction('myDropdown2','brandButton')" class="dropbtn" id="brandButton">Brand</button>
        <div id="myDropdown2" class="dropdown-content">
            <?php
            $get_data = callAPI('GET', 'http://68.183.14.165:3000/brands', false);
            $response = json_decode($get_data, true);
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
        <button onclick="myFunction('myDropdown3', 'sortingButton')" class="dropbtn" id="sortingButton">Sort By</button>
        <div id="myDropdown3" class="dropdown-content">
            <a href="#">Newest</a>
            <a href="#">Oldest</a>
        </div>
    </div>
</div>

<?php
echoGrid($productsResponse);
?>

<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction(myDropdown, buttonId) {
    document.getElementById(buttonId).classList.toggle("active");
    document.getElementById(myDropdown).classList.toggle("show");
}
</script>