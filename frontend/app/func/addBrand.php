<?php
function addBrand($brand)
{
    $addBrandPayload =  array(
        "name" => htmlspecialchars($brand, ENT_QUOTES),
    );
    $addBrandRes = callAPI('POST', 'http://68.183.14.165:3000/brands/', json_encode($addBrandPayload));
    $addBrandRes = json_decode($addBrandRes, true);

    if ($addBrandRes['error']) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>{$addBrandRes['error']}</p>";
    }
}
