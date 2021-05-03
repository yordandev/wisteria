<?php
if ($_SESSION['userType'] != 'Admin') {
    echo "<script>window.location.href = '/?page=account'</script>";
}
?>
<div id="adminPage">
    <ul id="addForms">
        <li>
            <button type="button" class="collapsible">Add brand</button>
            <div class="content-form">
                <form action="">
                    <input type="text" name="brandName" id="brandName" required placeholder="Name">
                    <button type="submit">Add</button>
                </form>
            </div>
        </li>
        <li>
            <button type="button" class="collapsible">Add size</button>
            <div class="content-form">
                <form action="">
                    <input type="text" name="sizeName" id="sizeName" required placeholder="Name">
                    <button type="submit">Add</button>
                </form>
            </div>
        </li>
        <li>
            <button type="button" class="collapsible">Add product</button>
            <div class="content-form">
                <form action="">
                    <input type="text" name="productName" id="productName" required placeholder="Name">
                    <input type="text" name="productPrice" id="productPrice" required placeholder="Price">
                    <input type="text" name="productFit" id="productFit" required placeholder="Fit">
                    <input type="text" name="productCondition" id="productCondition" required placeholder="Condition">
                    <select name="productSize" id="productSize" required>
                        <option value="" disabled selected>Size</option>
                        <option value="S">S</option>
                    </select>
                    <select name="productGender" id="productGender" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="Men">Men</option>
                    </select>
                    <select name="productType" id="productType" required>
                        <option value="" disabled selected>Type</option>
                        <option value="Tops">Tops</option>
                    </select>
                    <select name="productBrand" id="productBrand" required>
                        <option value="" disabled selected>Brand</option>
                        <option value="FilippaK">FilippaK</option>
                    </select>
                    <input type="file" id="productImage" name="productImage" required>
                    <button type="submit">Add</button>
                </form>
            </div>
        </li>
</div>