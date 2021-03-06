<?php

function echoCard($id = 0, $img = "https://picsum.photos/200/300", $brand = "Default Brand", $title = "Product title", $size = "M", $price = "100")
{
    $currentUrl = $_SERVER['HTTP_HOST'];
    $pageName = ($_REQUEST['page']);
    $removeLink = '';
    if ($pageName == 'cart') {
        $removeLink = "<div id='removeLink'><a href='/?page=cart&action=removeItem&itemId=$id'>Remove</a></div>";
    }

    $html = <<<"HTMLSTRING"
       <li class="echoCard" style="list-style-type: none;">
       <a href="/?page=single&id=$id" style="text-decoration: none;">
       <figure><img src="http://$currentUrl/productImg/$img" style="height: 300px; width: 200px; object-fit: cover;" alt=""></figure>
       <div class="cardText">
       <h3>$brand</h3>
       <h4>$title</h4>
       <h4>Size: $size</h4>
       <h4>$price SEK</h4>
       </div>
       </a>
       $removeLink
       </li>
 HTMLSTRING;

    echo $html;
};
