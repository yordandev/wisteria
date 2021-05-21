<?php
function uploadImage($image)
{
    $targetDir = "/var/www/html/frontend/public/productImg/";
    $targetFile = $targetDir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    echo $image["tmp_name"];

    // Check if file is an actual image or fake image
    $check = getimagesize($image["tmp_name"]);
    if ($check == false) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>File is not an image</p>";
        return false;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, file already exists.</p>";
        return false;
    }

    // Check file size
    if ($image["size"] > 2500000) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, your file is too large.</p>";
        return false;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, only JPG, JPEG & PNG files are allowed.</p>";
        return false;
    }

    if (!move_uploaded_file($image["tmp_name"], $targetFile)) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, there was an error uploading your file.</p>";
        return true;
    }
}
