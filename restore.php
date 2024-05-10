<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$operator = $_SESSION['operator'];

if ($operator != 'admin') {
    header('Location: index.html');
    exit();
} else {
    include_once 'connect.php';

    $user = $_SESSION['user'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Retrieve the item ID from the form
        $itemID = $_POST["item_id"];

        // Determine the type of item (Product or Service or seller)
        $itemType = $_POST["item_type"];
        
        // Determine the original table based on item type
        if ($itemType == "product") {
            $restoreQuery = "INSERT INTO Products SELECT * FROM DeletedProducts WHERE ProductID = '$itemID';";
            $deleteQuery = "DELETE FROM DeletedProducts WHERE ProductID = '$itemID';";
            $successMessage = "Product restored successfully!";
            $errorMessage = "Error restoring product: ";

            $sql = mysqli_query($conn, $restoreQuery);
            if ($sql) {
                $result = mysqli_query($conn, $deleteQuery);
                if ($result) {
                    $message = $successMessage;
                    $popupClass = "success-popup";
                    // Redirect to the same page after successful deletion
                    header('Location: TrashBin.php?success=true');
                    exit();
                } else {
                    $message = $errorMessage . mysqli_error($conn);
                    $popupClass = "error-popup";
                }
            } else {
                $message = $errorMessage . mysqli_error($conn);
                $popupClass = "error-popup";
            }
        } elseif ($itemType == "service") {
            $restoreQuery = "INSERT INTO Services SELECT * FROM Services WHERE ServiceID = '$itemID';";
            $deleteQuery = "DELETE FROM DeletedServices WHERE ServiceID = '$itemID';";
            $successMessage = "Service restored successfully!";
            $errorMessage = "Error restoring service: ";

            $sql = mysqli_query($conn, $restoreQuery);
            if ($sql) {
                $result = mysqli_query($conn, $deleteQuery);
                if ($result) {
                    $message = $successMessage;
                    $popupClass = "success-popup";
                    // Redirect to the same page after successful deletion
                    header('Location: TrashBin.php?success=true');
                    exit();
                } else {
                    $message = $errorMessage . mysqli_error($conn);
                    $popupClass = "error-popup";
                }
            } else {
                $message = $errorMessage . mysqli_error($conn);
                $popupClass = "error-popup";
            }
        } elseif ($itemType == "user") {
            $restoreQuery = "INSERT INTO Sellers SELECT * FROM DeletedUsers WHERE SellerID = '$itemID';";
            $deleteQuery = "DELETE FROM DeletedUsers WHERE SellerID = '$itemID'";
            $successMessage = "User restored successfully!";
            $errorMessage = "Error restoring user: ";
            $sql = mysqli_query($conn, $restoreQuery);
            if ($sql) {
                $result = mysqli_query($conn, $deleteQuery);
                if ($result) {
                    $message = $successMessage;
                    $popupClass = "success-popup";
                    // Redirect to the same page after successful deletion
                    header('Location: TrashBin.php?success=true');
                    exit();
                } else {
                    $message = $errorMessage . mysqli_error($conn);
                    $popupClass = "error-popup";
                }
            } else {
                $message = $errorMessage . mysqli_error($conn);
                $popupClass = "error-popup";
            }
        } else {
            // Invalid item type
            $message = "Invalid item type!";
            $popupClass = "error-popup";
            header('Location: TrashBin.php');
            exit(); // Stop execution
        }
    }
}
