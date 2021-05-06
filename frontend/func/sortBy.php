<?php
function sortNewest($gender1, $category1)
{
    if ($_SESSION['filters']['brand'] && !$_SESSION['filters']['size']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender1 . "&category=" . $category1 . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    } else if ($_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender1 . "&category=" . $category1 . "&size=" . $_SESSION['filters']['size'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    } else if ($_SESSION['filters']['size'] && $_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender1 . "&category=" . $category1 . "&size=" . $_SESSION['filters']['size'] . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    } else if (!$_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender1 . "&category=" . $category1 . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    };
};

function sortOldest($gender2, $category2)
{
    if ($_SESSION['filters']['brand'] && !$_SESSION['filters']['size']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender2 . "&category=" . $category2 . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    } else if ($_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender2 . "&category=" . $category2 . "&size=" . $_SESSION['filters']['size'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    } else if ($_SESSION['filters']['size'] && $_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender2 . "&category=" . $category2 . "&size=" . $_SESSION['filters']['size'] . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    } else if (!$_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender2 . "&category=" . $category2 . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    };
};
