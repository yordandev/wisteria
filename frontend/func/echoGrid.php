<?php
function echoGrid($data = [])
{
    echo "<ul class = 'productGrid'>";
    for ($i = 0; $i < count($data); $i++) {
        echo echoCard($data[$i]['id'], $data[$i]['img'], $data[$i]['brand'], $data[$i]['name'], $data[$i]['size'], $data[$i]['price']);
    }
    echo "</ul>";
}
