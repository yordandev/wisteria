<?php
function echo_card($title = "Default Title", $desc = "Default Description", $img = "/images/fallback.jpg")
{
    $html = <<<"EOT"
       <div class="echoCard">
       <div><img src="$img" alt=""></div>
       <div><h2>$title</h2>
       <p>$desc</p></div>
       </div>
 EOT;

    echo $html;
}
