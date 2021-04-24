<h1>Women All</h1>
<div id="filter">
    <div class="dropdown" id="size">
        <button onclick="myFunction('myDropdown')" class="dropbtn">Size</button>
        <div id="myDropdown" class="dropdown-content">
            <div>
                <input type="checkbox" id="small" name="small">
                <label for="small">Small</label>
            </div>
            <div>
                <input type="checkbox" id="medium" name="medium">
                <label for="medium">Medium</label>
            </div>
            <div>
                <input type="checkbox" id="large" name="large">
                <label for="large">Large</label>
            </div>
        </div>
    </div>
    <div class="dropdown" id="brand">
        <button onclick="myFunction('myDropdown2')" class="dropbtn">Brand</button>
        <div id="myDropdown2" class="dropdown-content">
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
        <button onclick="myFunction('myDropdown3')" class="dropbtn">Sort By</button>
        <div id="myDropdown3" class="dropdown-content">
            <a href="#">Newest</a>
            <a href="#">Oldest</a>
        </div>
    </div>
</div>

<?php 
echo echoGrid(12);

?>

<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction(myDropdown) {
    document.getElementById(myDropdown).classList.toggle("show");
}
</script>