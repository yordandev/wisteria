<?php
function addProduct($product, $image)
{
    $addProductRes = callAPI('POST', 'http://68.183.14.165:3000/products/', json_encode($product));
    $addProductRes = json_decode($addProductRes, true);

    if ($addProductRes['error']) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>{$addProductRes['error']}</p>";
    }

    if ($addProductRes['message']) {
        echo $addProductRes['message'];
    }

    uploadImage($image);
}
