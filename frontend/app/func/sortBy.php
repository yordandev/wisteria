<?php
function sortNewest($gender, $category)
{
    if ($_SESSION['filters']['brand'] && !$_SESSION['filters']['size']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    } else if ($_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size=" . $_SESSION['filters']['size'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    } else if ($_SESSION['filters']['size'] && $_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size=" . $_SESSION['filters']['size'] . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    } else if (!$_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "DESC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Newest </a>";
    };
};

function sortOldest($gender, $category)
{
    if ($_SESSION['filters']['brand'] && !$_SESSION['filters']['size']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    } else if ($_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size=" . $_SESSION['filters']['size'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    } else if ($_SESSION['filters']['size'] && $_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&size=" . $_SESSION['filters']['size'] . "&brand="  . $_SESSION['filters']['brand'] . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    } else if (!$_SESSION['filters']['size'] && !$_SESSION['filters']['brand']) {
        $_SESSION['filters']['sortBy'] = "ASC";
        echo "<a href=" . "/?page=products&gender=" . $gender . "&category=" . $category . "&sortBy="  . $_SESSION['filters']['sortBy'] . "> Oldest </a>";
    };
};
