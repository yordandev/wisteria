<?php $gender = htmlspecialchars($_GET["gender"]);
$category = htmlspecialchars($_GET["category"]);
if ($category) {
    echo "<h1>" . ucwords($gender)  . " " . ucwords($category) . "</h1>";
} else {
    echo "<h1>" . ucwords($gender)  . " All </h1>";
}
?>
<div id="filter">
    <div class="dropdown" id="size">
        <button onclick="myFunction('myDropdown','sizeButton')" class="dropbtn" id="sizeButton">Size</button>
        <div id="myDropdown" class="dropdown-content">
            <div>
                <input type="checkbox" id="small" name="small" value="small" onclick="test(this)">
                <label for="small">Small</label>
            </div>
            <div>
                <input type="checkbox" id="medium" name="medium" value="medium" onclick="test(this)">
                <label for="medium">Medium</label>
            </div>
            <div>
                <input type="checkbox" id="large" name="large" value="large" onclick="test(this)">
                <label for="large">Large</label>
            </div>
        </div>
    </div>
    <div class="dropdown" id="brand">
        <button onclick="myFunction('myDropdown2','brandButton')" class="dropbtn" id="brandButton">Brand</button>
        <div id="myDropdown2" class="dropdown-content">
            <?php

            ?>
            <div>
                <input type="checkbox" id="filippaK" name="filippaK">
                <label for="filippaK">Filippa K</label>
            </div>
            <div>
                <input type="checkbox" id="gant" name="gant">
                <label for="gant">Gant</label>
            </div>
            <div>
                <input type="checkbox" id="hope" name="hope">
                <label for="hope">Hope</label>
            </div>
        </div>
    </div>
    <div class="dropdown" id="sorting">
        <button onclick="myFunction('myDropdown3', 'sortingButton')" class="dropbtn" id="sortingButton">Sort By</button>
        <div id="myDropdown3" class="dropdown-content">
            <a href="#">Newest</a>
            <a href="#">Oldest</a>
        </div>
    </div>
</div>

<?php
// echo echoGrid(12);

?>

<script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    function myFunction(myDropdown, buttonId) {
        document.getElementById(buttonId).classList.toggle("active");
        document.getElementById(myDropdown).classList.toggle("show");
    }

    function test(t) {
        console.log(t.value)
    }
</script>