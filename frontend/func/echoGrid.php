<?php
function echoGrid($a = 8, $img = "https://picsum.photos/200/300", $brand = "Test Brand", $title = "Product title", $size = "M", $price = "100"){
    echo "<ul class = 'productGrid'>";
    for($i = 0; $i<$a; $i++){
        echo echoCard($img, $brand, $title, $size, $price);
    }
    echo "</ul>";
}
?>