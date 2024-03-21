<?php
session_start();
include_once 'connect.php';

if (isset($_POST['subscribe'])) {

    $email = $_POST['email'];
    $page = $_POST['page'];

    $query = "INSERT INTO Subscribers(Email) VALUES ('$email');";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        $message = "Successfully subscribed";
        echo "<script>alert($message);</script>";
        if ($page == 'contactSeller.php') {
            header('Location: contactSeller.php');
            exit();
        }
        elseif ($page == 'post.php') {
            header('Location: post.php');
            exit();
        }
        elseif ($page == 'sellerDashboard.php') {
            header('Location: sellerDashboard.php');
            exit();
        }
        else {
            header('Location: index.html');
            exit();
        }
    }else{
        $message = "Error occured while subscribing";
        echo "<script>alert($message);</script>";
        if ($page == 'contactSeller.php') {
            header('Location: contactSeller.php');
            exit();
        }
        elseif ($page == 'post.php') {
            header('Location: post.php');
            exit();
        }
        elseif ($page == 'sellerDashboard.php') {
            header('Location: sellerDashboard.php');
            exit();
        }
        else {
            header('Location: index.html');
            exit();
        }
    }
}
?>