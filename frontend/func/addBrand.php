<?php
function addBrand($brand)
{
    $addBrandPayload =  array(
        "name" => $brand,
    );
    $res = callAPI('POST', 'http://68.183.14.165:3000/brands/', json_encode($addBrandPayload));
    if ($res['error']) {
        echo $res['error'];
    }
}
