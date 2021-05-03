<?php
function echoGrid($a = 8, $data=[]){
    echo "<ul class = 'productGrid'>";
    for($i = 0; $i<$a; $i++){
        echo echoCard($data[$i]->img, $data[$i]->brand, $data[$i]->title, $data[$i]->size, $data[$i]->price);
    }
    echo "</ul>";
}
?>