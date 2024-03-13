<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include_once 'connect.php';

$existingAdminsTelephones = $existingSellersTelephones = [];

if (isset($_POST['confirm'])) {
    //Pick the data from HTML
    $telephone = $_POST['telephone'];

    $telephone = (substr($telephone, 0, 1) == "0") ? preg_replace("/^0/", "+254", $telephone) : $telephone;
    $telephone = (substr($telephone, 0, 1) == "7") ? "+254{$telephone}" : $telephone;
    
    //select all users from the database
    $query = "SELECT Telephone FROM Sellers;";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $existingSellers[] = $row['Telephone'];
    }

    //select all admins from the database
    $query = "SELECT Telephone FROM Admin;";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        $existingAdmins[] = $row['Telephone'];
    }

    if (in_array($telephone, $existingSellers)) {

        $message =  "Seller verification successfull !";
        $popupClass = "success-popup";
        $_SESSION['user'] = $telephone;
        header('Location: setPassword.php');
        exit();
    }
    else if(in_array($telephone, $existingAdmins)){
        $message =  "Admin verification successfull !";
        $popupClass = "success-popup";

        $_SESSION['user'] = $telephone ;

        header('Location: setPassword.php');
        exit();
    }
    else {
        $message =  "Verification failed !";
        $popupClass = "error-popup";
        header('Location: resetPassword.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Reset Password</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        /*upload form*/
        .verify-form-container {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark-color);
        }
        .form{
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .form-input {
            outline: none;
            color: var(--dark-color);
            width: 50%;
            border: 2px solid var(--dark-color);
            padding-block: .5rem;
            padding-left: .5rem;
            font-size: var(--font-size-sm);
            border-radius: .5rem;
            font-weight: 500;
            align-self: center;
            background: transparent;
            transition: transform border .4s;
        }

        .form-input:hover {
            border: 2px solid cyan;
        }

        legend {
            text-align: center;
            font-size: var(--font-size-md);
            font-weight: 500;
            text-transform: capitalize;
            margin: 1rem auto;
        }
        .inputs {
            margin: 1rem 3rem;
        }
        .btn{
            padding: .5rem 2rem;
            color: var(--light-color);
            background-color: #b94343;
            border: 2px solid #b94343;
        }
        .link {
            color: var(--dark-color);
            font-weight: 600;
            font-size: var(--font-size-sm);
            margin: auto;
            text-align: center;
        }
        .success-popup {
            background-color: #4DA3FF;
            color: var(--light-color);
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
    </style>
</head>

<body>
    <!-- Display the popup based on the success or error message -->
    <div class="popup <?php echo $popupClass; ?>" id="popup">
            <div class="popup-message">
                <p><?php echo $message; ?></p>
                <button class="pop-btn" onclick="closePopup()">Close</button>
            </div>
        </div>
    <!--verification form-->
    <div class="verify-form-container container" id="verify-form-container">
        <div class="container-inner place-item-center">
            <legend>Enter your phone number, registered in the system</legend>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="form">
                    <input type="tel" name="telephone" required class="form-input" autocomplete="tel" autofocus minlength="10" maxlength="15" >
                <div class="inputs">
                    <button type="submit" name="confirm" class="btn">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the form and all input elements
        const form = document.getElementsByClassName('form');
        const inputs = form.querySelectorAll('input');

        // Add 'keydown' event listener to the form
        form.addEventListener('keydown', function (event) {
            // Check if the pressed key is Enter (key code 13)
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default behavior (e.g., form submission)

                // Find the currently focused input
                const focusedInput = document.activeElement;

                // If the focused input is the last one, submit the form
                if (focusedInput === inputs[inputs.length - 1]) {
                    form.submit();
                } else {
                    // If not the last input, find the next input and focus on it
                    const nextIndex = Array.from(inputs).indexOf(focusedInput) + 1;
                    inputs[nextIndex].focus();
                }
            }
        });
    });
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    // Display the popup on page load if it's not empty
    window.onload = function() {
        var popupMessage = "<?php echo $message; ?>";
        if (popupMessage !== "") {
            document.getElementById('popup').style.display = 'flex';
        }
    };
</script>
</html>