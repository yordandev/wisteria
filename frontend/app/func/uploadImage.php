<?php
function uploadImage($image)
{
    $target_dir = "productImg/";
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image or fake image
    $check = getimagesize($image["tmp_name"]);
    if ($check == false) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>File is not an image</p>";
        return;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, file already exists.</p>";
        return;
    }

    // Check file size
    if ($image["size"] > 2500000) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, your file is too large.</p>";
        return;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, only JPG, JPEG & PNG files are allowed.</p>";
        return;
    }

    if (!move_uploaded_file($image["tmp_name"], $target_file)) {
        echo "<p style='color: red; margin-bottom: 48px; text-align: center;'>Sorry, there was an error uploading your file.</p>";
        return;
    }
}
