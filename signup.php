<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start(); //buffering - stores the details on temporary memories

include_once 'connect.php';

$first_name = $last_name = $gender = $id_no = $telephone = $email = $whatsapp_number = $business_type = $business_name = '';

// Declare arrays that will store all the user's telephone numbers from the database
$existingSellersIDs = $existingSellersTelephones = [];
// Check if the first form has already been submitted
if (isset($_POST['register'])) {

    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $gender = $_POST['gender'];
    $id_no = $_POST['id-no'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $whatsapp_number = $_POST['whatsapp'];
    $business_type = $_POST['business-type'];
    $business_name = $_POST['business-name'];

    #Make some adjustments so that the data entered may fit our database

    $first_name = strtoupper($first_name);
    $last_name = strtoupper($last_name);

    $telephone = (substr($telephone, 0, 1) == "0") ? preg_replace("/^0/", "+254", $telephone) : $telephone;
    $telephone = (substr($telephone, 0, 1) == "7") ? "+254{$telephone}" : $telephone;

    $whatsapp_number = (substr($whatsapp_number, 0, 1) == "0") ? preg_replace("/^0/", "+254", $whatsapp_number) : $whatsapp_number;
    $whatsapp_number = (substr($whatsapp_number, 0, 1) == "7") ? "+254{$whatsapp_number}" : $whatsapp_number;

    //check if the data has been submitted to the database
    if (!isset($_SESSION['firstFormSubmitted'])) {

        $query = "SELECT ID_NO, Telephone FROM Sellers;";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $existingSellersIDs[] = $row['ID_NO'];
            $existingSellersTelephones[] = $row['Telephone'];
        }
        if (in_array($id_no, $existingSellersIDs) && in_array($telephone, $existingSellersTelephones)) {
            $message = "User exists, kindly login";
        } elseif (in_array($id_no, $existingSellersIDs)) {

            $message =  "The email address entered is already registered. If you already have an account, kindly go to the login page";
            $popupClass = "error-popup";

            $id_no = "";
        } elseif (in_array($telephone, $existingSellersTelephones)) {

            $message =  "The phone number is already registered";
            $popupClass = "error-popup";

            $telephone = "";
        } else {
            $query = "INSERT INTO Sellers(SellerFirstName,SellerLastName,Gender,ID_NO,Telephone,Email, WhatsAppNumber,BusinessType,BusinessName) VALUES ('$first_name','$last_name','$gender','$id_no','$telephone','$email','$whatsapp_number','$business_type','$business_name')";

            $sql = mysqli_query($conn, $query);
            if ($sql) {
                $_SESSION['user'] = $telephone;
                $_SESSION['firstFormSubmitted'] = true;


                $message = "You have successfully been registered as ".$first_name." ".$last_name;
                $popupClass = "success-popup";

                header('Location: setPassword.php');
                exit();
            } else {
                $message = "Error Submitting to the database Contact Admin for Assistance";
                $popupClass = "error-popup";
            }
        }
    } else {

        $query = "SELECT SellerID FROM Sellers WHERE Telephone = '$telephone' AND ID_NO = '$id_no'";
        $sql = mysqli_query($conn, $query);

        if (mysqli_fetch_array($sql)) {
            $sellerID = $row['SellerID'];
        }
        #Update the sellers table and redirect to send OTP
        $query = "UPDATE Sellers SET SellerFirstName = '$first_name', SellerLastName = '$last_name', Gender = '$gender', ID_NO = '$id_no',Telephone = '$telephone', Email = '$email',WhatsAppNumber = '$whatsapp_number',BusinessType = '$business_type',BusinessName = '$business_name' WHERE SellerID = '$sellerID'";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            $_SESSION['firstFormSubmitted'] = true;
            $_SESSION['user'] = $telephone;


            $message = "You have successfully been registered as ".$first_name." ".$last_name;
            $popupClass = "success-popup";


            header('Location: setPassword.php');
            exit();
        } else {
            
            $message = "Error Submitting to the database Contact Admin for Assistance";
            $popupClass = "error-popup";
        }
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Register</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.min.css" rel="stylesheet">
    <style>
        /*upload form*/
        .signup-form-container {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('./images/b2b-banner-1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--light-color);
        }

        .myform {
            padding-block: 2rem;
            background-color: transparent;
            border-radius: 20px;
            backdrop-filter: blur(50px);
            padding-bottom: 3rem;
            width: 100%;
        }

        .inputs {
            margin: 1rem 3rem;
        }

        .myform-input {
            outline: none;
            color: var(--light-color);
            width: 80%;
            border: 2px solid var(--light-color);
            padding-block: .5rem;
            padding-left: .5rem;
            font-size: var(--font-size-small);
            background: transparent;
            transition: transform border .4s;
        }

        .myform-input:hover {
            border: 2px solid cyan;
        }

        .select {
            width: 40%;
        }

        .btn {
            padding: .5rem 2rem;
            float: right;
            margin-right: 3rem;
            color: var(--light-color);
            background-color: #b94343;
            border: 2px solid #b94343;
        }

        .link {
            color: var(--light-color);
            font-weight: 600;
            font-size: var(--font-size-m);
            margin: auto;
            text-align: center;
        }

        legend {
            text-align: center;
            font-size: var(--font-size-md);
            font-weight: 600;
            text-transform: capitalize;
        }


        .success-popup {
            background-color: #4DA3FF;
            color: var(--dark-color);
        }

        .success-popup .pop-btn {
            background-color: green;
            color: var(--light-color);
        }

        .error-popup {
            background-color: #FF4D4D;
            color: var(--dark-color);
        }

        .error-popup .pop-btn {
            background-color: red;
            color: var(--dark-color);
        }

        .popup {
            display: none;
            /* Initially hide the popup */
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 30%;
            left: 40%;
            width: 20rem;
            height: auto;
            background-color: #f1f1f1;
            /* Semi-transparent background */
            z-index: 1000;
        }

        .popup-message {
            background-color: inherit;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .popup button {
            margin-top: 10px;
            padding: 10px;
            cursor: pointer;
        }

        @media screen and (max-width: 525px) {
            .myform {
                margin: 0;
                padding-block: .5rem;
                padding-bottom: 3rem;
                width: 100%;
                height: 100vh;
                font-size: var(--font-size-small);
            }

            .inputs {
                margin: .5rem 1rem;
            }

            .myform-input {
                width: 90%;
                font-size: var(--font-size-xsmall);
            }

            legend {
                font-size: var(--font-size-sm);
            }

            .btn {
                padding: .5rem 2rem;
                float: none;
                align-self: center;
            }
        }
    </style>
</head>

<body>
    <!--signup form-->
    <div class="signup-form-container container" id="signup-form-container">
        <div class="form-container-inner">
            <!-- Display the popup based on the success or error message -->
            <div class="popup <?php echo $popupClass; ?>" id="popup">
                <div class="popup-message">
                    <p><?php echo $message; ?></p>
                    <button class="pop-btn" onclick="closePopup()">Close</button>
                </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="myform">
                <div class="inputs">
                    <legend>Welcome to Kabarak<span class="tm">B2B</span> <br> Create an account Today to put your business Online</legend>
                </div>
                <div class="inputs">
                    <label for="first-name">First Name:</label> <br>
                    <input type="text" name="first-name" required class="myform-input" autocomplete="on" autofocus>
                </div>

                <div class="inputs">
                    <label for="last-name">Last Name:</label> <br>
                    <input type="text" name="last-name" required class="myform-input" autocomplete="on" autofocus>
                </div>

                <div class="inputs">
                    <label for="choice">Gender:</label>
                    <input type="radio" name="gender" value="Male" id="male">Male
                    <input type="radio" name="gender" value="Female" id="female">Female

                    <input type="radio" name="gender" value="other" id="other">Other
                </div>

                <div class="inputs">
                    <label for="id-no">ID_NO:</label>
                    <input type="number" name="id-no" required class="myform-input select" min="1000000" id="id-no">
                </div>

                <div class="inputs">
                    <label for="telephone">Telephone</label><br>
                    <input type="tel" name="telephone" id="telephone" class="myform-input">
                </div>

                <div class="inputs">
                    <label for="email">Email Address:</label><br>
                    <input type="email" name="email" id="email" class="myform-input">
                </div>

                <div class="inputs">
                    <label for="telephone">WhatsApp Number:</label><br>
                    <input type="tel" name="whatsapp" id="whatsapp" class="myform-input">
                </div>
                <div class="inputs">
                    <label for="business-type">Business Type:</label>
                    <select name="business-type" id="category" class="myform-input select" required>
                        <option value="Gas Services">Gas Services</option>
                        <option value="Clothes">Clothes</option>
                        <option value="Beauty & Cosmetics">Beauty & Cosmetics</option>
                        <option value="Beddings">Beddings</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Households">Households</option>
                        <option value="Furniture">Furnitures</option>
                        <option value="Bookshop & Stationary">Bookshops & Stationary</option>
                        <option value="General Stores">General stores</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Health Services">Health Services</option>
                        <option value="Hairdressing">Hairdressing</option>
                        <option value="Haircut">Haircut</option>
                        <option value="Electronics Repair">Electronics Repair</option>
                        <option value="Shoe Repair">Shoe Repair</option>
                        <option value="Carrier Services">Carrier Services</option>
                    </select>
                </div>

                <div class="inputs">
                    <label for="business-name">Business Name:</label><br>
                    <input type="text" name="business-name" id="business-name" class="myform-input">
                </div>
                <div class="inputs">
                    <span>Already registered <a href="./login.html" class="link">Login</a></span>
                </div>
                <div class="inputs">
                    <button type="submit" name="register" class="btn">Register</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>