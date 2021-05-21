<?php
if ($_SESSION['userType'] != 'Admin') {
    echo "<script>window.location.href = '/?page=account'</script>";
}

if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
        if (isset($_GET["action"]) && $_GET["action"] == 'addBrand' && isset($_POST["brandName"])) {
            addBrand($_POST["brandName"]);
        }

        if (isset($_GET["action"]) && $_GET["action"] == 'addSize' && isset($_POST["sizeName"])) {
            addSize($_POST["sizeName"]);
        }

        if (isset($_GET["action"]) && $_GET["action"] == 'addProduct') {
            $product = $_POST;
            $product['image'] = $_FILES["productImage"]['name'];
            $image = $_FILES["productImage"];
            addProduct($product, $image);
        }
    }
}

?>

<div id="adminPage">
    <ul id="addForms">
        <li>
            <button type="button" class="collapsible">Add brand</button>
            <div class="content-form">
                <form action="/?page=admin&action=addBrand" method="POST">
                    <input type="text" name="brandName" id="brandName" required placeholder="Name">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <button type="submit">Add</button>
                </form>
            </div>
        </li>
        <li>
            <button type="button" class="collapsible">Add size</button>
            <div class="content-form">
                <form action="/?page=admin&action=addSize" method="POST">
                    <input type="text" name="sizeName" id="sizeName" required placeholder="Name">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <button type="submit">Add</button>
                </form>
            </div>
        </li>
        <li>
            <button type="button" class="collapsible">Add product</button>
            <div class="content-form">
                <form action="/?page=admin&action=addProduct" method="POST" enctype="multipart/form-data">
                    <input type="text" name="name" id="productName" required placeholder="Name">
                    <input type="number" name="price" id="productPrice" required placeholder="Price">
                    <input type="text" name="fit" id="productFit" required placeholder="Fit">
                    <input type="text" name="condition" id="productCondition" required placeholder="Condition">
                    <select name="genderId" id="productGender" required onchange="genderFilter()">
                        <option value="" disabled selected>Gender</option>
                        <?php
                        $get_data = callAPI('GET', 'http://68.183.14.165:3000/genders', false);
                        $response = json_decode($get_data, true);
                        for ($i = 0; $i < count($response); $i++) {
                            $id = $response[$i]['id'];
                            $value = $response[$i]['name'];
                            echo "<option value='$id'>$value</option>";
                        }
                        ?>
                    </select>
                    <select name="typeId" id="productType" required>
                        <option value="" disabled selected>Type</option>
                        <?php
                        $get_data = callAPI('GET', 'http://68.183.14.165:3000/types', false);
                        $response = json_decode($get_data, true);
                        for ($i = 0; $i < count($response); $i++) {
                            $id = $response[$i]['id'];
                            $value = $response[$i]['name'];
                            echo "<option value='$id' id=$value>$value</option>";
                        }
                        ?>
                    </select>
                    <select name="brandId" id="productBrand" required>
                        <option value="" disabled selected>Brand</option>
                        <?php
                        $get_data = callAPI('GET', 'http://68.183.14.165:3000/brands', false);
                        $response = json_decode($get_data, true);
                        for ($i = 0; $i < count($response); $i++) {
                            $id = $response[$i]['id'];
                            $value = $response[$i]['name'];
                            echo "<option value='$id'>$value</option>";
                        }
                        ?>
                    </select>
                    <select name="sizeId" id="productSize" required>
                        <option value="" disabled selected>Size</option>
                        <?php
                        $get_data = callAPI('GET', 'http://68.183.14.165:3000/sizes', false);
                        $response = json_decode($get_data, true);
                        for ($i = 0; $i < count($response); $i++) {
                            $id = $response[$i]['id'];
                            $value = $response[$i]['name'];
                            echo "<option value='$id'>$value</option>";
                        }
                        ?>
                    </select>
                    <input type="file" id="productImage" name="productImage" required accept="image/x-png,image/jpeg">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <button type="submit">Add</button>
                </form>
            </div>
        </li>
</div>

<script>
    function genderFilter() {
        const gender = document.getElementById("productGender").value;

        if (gender == 1) {
            document.getElementById("productType")[3].disabled = true;
        } else {
            document.getElementById("productType")[3].disabled = false;
        }
    }
</script>