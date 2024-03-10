<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start(); //buffering - stores the details on temporary memories

session_start();

include_once 'connect.php';

$passphrase = $telephone = '';

// Declare arrays that will store all the user's telephone numbers from the database
$existingAdminsTelephones = $existingSellersTelephones = [];

if (isset($_POST['login'])) {
    //Pick the data from HTML
    $passphrase = $_POST['Passphrase'];
    $telephone = $_POST['telephone'];

    $telephone = (substr($telephone, 0, 1) == "0") ? preg_replace("/^0/", "+254", $telephone) : $telephone;
    $telephone = (substr($telephone, 0, 1) == "7") ? "+254{$telephone}" : $telephone;
    
    //select all users from the database
    $query = "SELECT Telephone FROM MySecurity;";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $existingSellersTelephones[] = $row['Telephone'];
    }

    //select all admins from the database
    $query = "SELECT Telephone FROM Admin;";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        $existingAdminsTelephones[] = $row['Telephone'];
    }

    // Check if the user already exists
    if (in_array($telephone, $existingSellersTelephones)) {

        //write a query to Select the data From the Database
        $query = "SELECT Passphrase FROM MySecurity WHERE Telephone = '$telephone';";

        //Run the Query
        $sql = mysqli_query($conn, $query);

        //Pick Data From Database

        if ($row = mysqli_fetch_array($sql)) {

            $hashed_password = $row['Passphrase'];

            if (password_verify($passphrase, $hashed_password)) {
                $user = $telephone;

                $_SESSION['user'] = $user; //save for future use

                // Check if the "Remember me" checkbox is checked
                if (isset($_POST["remember"]) && $_POST["remember"] == "1") {

                    // Set a cookie to remember the user for a certain period (e.g., 30 days)
                    setcookie("user", $user, time() + 30 * 24 * 3600);
                    setcookie("password", $user_password, time() + 30 * 24 * 3600);
                }

                // Redirect to the sellers dashboard

                header('Location: sellerDashboard.php');
                exit();

            } else {
                // Redirect to the  login page to retry the password
                header('Location: login.html');
                exit();
            }
        } 
    }
    //if the user is not in the sellers table check in the admins table
    elseif (in_array($telephone, $existingAdminsTelephones)) {

        //write a query to Select the data From the Database
        $query = "SELECT Passphrase FROM Admin WHERE Telephone = '$telephone';";

        //Run the Query
        $sql = mysqli_query($conn, $query);

        //Pick Data From Database

        if ($row = mysqli_fetch_array($sql)) {
            $hashed_password = $row['Passphrase'];

            if (password_verify($passphrase, $hashed_password)) {
                $user = $telephone;

                $_SESSION['user'] = $user; //save for future use

                // Check if the "Remember me" checkbox is checked
                if (isset($_POST["remember"]) && $_POST["remember"] == "1") {

                    // Set a cookie to remember the user for a certain period (e.g., 30 days)
                    setcookie("user", $user, time() + 30 * 24 * 3600);
                    setcookie("password", $user_password, time() + 30 * 24 * 3600);
                }
                header('Location: adminDashboard.php');// Redirect to the admin dashboard
                exit();
            } else {
                header('Location: login.html');// Redirect to the  login page to retry the password
                exit();
            }
        } 
    }
    //If the user is not in all tables take him/her to sign up page
    else {
        header('Location: signup.php');// Redirect to the  signup page to register
        exit();
    }
}
ob_end_flush();
?>
