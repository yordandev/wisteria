<?php
function echoCard($img = "https://picsum.photos/200/300", $brand = "Default Brand", $title = "Product title", $size = "M", $price = "100")
{
    $html = <<<"EOT"
       <li class="echoCard" style="list-style-type: none">
       <a href="/?page=single" style="text-decoration: none;">
       <figure><img src="$img" alt=""></figure>
       <div class="cardText"><h3>$brand</h3>
       <h4>$title</h4>
       <h4>Size: $size</h4>
       <h4>$price SEK</h4></div>
       </a>
       </li>
 EOT;

    echo $html;
};
