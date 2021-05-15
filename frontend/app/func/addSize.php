<?php
function addSize($size)
{
    $addSizePayload =  array(
        "name" => htmlspecialchars($size, ENT_QUOTES),
    );
    $addSizeRes = callAPI('POST', 'http://68.183.14.165:3000/sizes/', json_encode($addSizePayload));
    $addSizeRes = json_decode($addSizeRes, true);

    if ($addSizeRes['error']) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>{$addSizeRes['error']}</p>";
    }
}
