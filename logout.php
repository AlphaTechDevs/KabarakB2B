<?php
session_start();

$operator = $_SESSION['operator'];

if ($operator == "admin") {
    session_destroy();
    header('Location: login.html');
    exit();
} else {
    session_destroy();
    header('Location: index.html');
    exit();
}

?>