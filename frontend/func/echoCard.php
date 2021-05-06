<?php

function echoCard($id = 0, $img = "https://picsum.photos/200/300", $brand = "Default Brand", $title = "Product title", $size = "M", $price = "100")
{
    $currentUrl = $_SERVER['HTTP_HOST'];
    $html = <<<"EOT"
       <li class="echoCard" style="list-style-type: none">
       <a href="/?page=single&id=$id" style="text-decoration: none;">
       <figure><img src="http://$currentUrl/productImg/$img" style="height: 300px; width: 200px; object-fit: cover;" alt=""></figure>
       <div class="cardText"><h3>$brand</h3>
       <h4>$title</h4>
       <h4>Size: $size</h4>
       <h4>$price SEK</h4></div>
       </a>
       </li>
 EOT;

    echo $html;
};
