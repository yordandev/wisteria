<?php
function sanitizeProduct($p)
{
    return htmlspecialchars($p, ENT_QUOTES);
}

function addProduct($product)
{
    $checkedProduct = array_map('sanitizeProduct', $product);
    echo $_FILES["productImage"]["tmp_name"];
    $imageUploaded = uploadImage($_FILES["productImage"]);

    if ($imageUploaded) {
        $addProductRes = callAPI('POST', 'http://68.183.14.165:3000/products/', json_encode($checkedProduct));
        $addProductRes = json_decode($addProductRes, true);

        if ($addProductRes['error']) {
            echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>{$addProductRes['error']}</p>";
        }

        if ($addProductRes['message']) {
            echo $addProductRes['message'];
        }
    }
}
