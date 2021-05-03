<?php $gender = htmlspecialchars($_GET["gender"]);
$category = htmlspecialchars($_GET["category"]);
function brands()
{
    $query  = explode('&', $_SERVER['QUERY_STRING']);
    $params = array();
    if (isset($_GET['brand'])) {
        foreach ($query as $param) {
            // prevent notice on explode() if $param has no '='
            if (strpos($param, '=') === false) $param += '=';

            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }
        for ($i = 0; $i < count($params['brand']); $i++) {
            echo ucfirst($params['brand'][$i] . ", ");
        };
    }
};
function sizes()
{
    $query  = explode('&', $_SERVER['QUERY_STRING']);
    $params = array();
    if (isset($_GET['size'])) {
        foreach ($query as $param) {
            // prevent notice on explode() if $param has no '='
            if (strpos($param, '=') === false) $param += '=';

            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }
        for ($i = 0; $i < count($params['size']); $i++) {
            echo ucfirst($params['size'][$i] . ", ");
        };
    }
};


if ($category) {
    echo "<h1>" . ucwords($gender)  . " " . ucwords($category) . "</h1>";
} else {
    echo "<h1>" . ucwords($gender)  . " All </h1>";
}

?>
<h3>Filtered by: <?php brands() . sizes() ?> </h3>

<div id="filter">
    <div class="dropdown" id="size">
        <button onclick="myFunction('myDropdown','sizeButton')" class="dropbtn" id="sizeButton">Size</button>
        <div id="myDropdown" class="dropdown-content">
            <?php
            // $get_data = callAPI('GET', 'http://68.183.14.165:3000/sizes', false);
            // $response = json_decode($get_data, true);
            // for ($i = 0; $i < count($response); $i++) {
            //     $lower = strtolower($response[$i]['name']);
            //     $value = $response[$i]['name'];
            //     $currentUrl = $_SERVER['REQUEST_URI'];
            //     $sizeName = <<<"EOT"
            //     <a href="$currentUrl&size=$lower">$value</a>
            //     EOT;
            //     echo $sizeName;
            // }

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
                $currentUrl = $_SERVER['REQUEST_URI'];
                echo "<a href=" . $currentUrl . "&brand="  . $lower . " onclick='clickAndDisable(this)'>" . $value . "</a>";
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
// echo echoGrid(12);

?>

<script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    function myFunction(myDropdown, buttonId) {
        document.getElementById(buttonId).classList.toggle("active");
        document.getElementById(myDropdown).classList.toggle("show");
    };

    function test(element) {
        console.log(element.value);
        window.location.href = "/?page=products&gender=women&category=pants/shorts";
        document.getElementById(element.id).checked = true;
    };

    function clickAndDisable(link) {
        // disable subsequent clicks
        link.onclick = function(event) {
            event.preventDefault();
        }
    }
</script>