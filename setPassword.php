<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start(); //buffering - stores the details on temporary memories

include_once 'connect.php';

$telephone = $_SESSION['user'];

if (isset($_POST['save'])) {
    $passphrase = $_POST['passphrase-2'];

    $hashed_password = password_hash($passphrase, PASSWORD_DEFAULT);

    $existingSellersTelephones = []; //sellers that completed the registration process
    $existingSellers = []; //sellers registering for the first time.

    #check for sellers who have already set thier security
    $query = "SELECT Telephone FROM MySecurity;";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $existingSellersTelephones[] = $row['Telephone'];
    }

    //check for sellers that are registered but not fully
    $query = "SELECT Telephone FROM Sellers;";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $existingSellers[] = $row['Telephone'];
    }

    //check if the current user has a password set, if yes update the password
    if (in_array($telephone, $existingSellersTelephones)) {

        $query = "UPDATE MySecurity SET Passphrase = '$hashed_password' WHERE Telephone = '$telephone';";
        $sql = mysqli_query($conn, $query);

        if ($sql) {

            $message = "User Password updated successfully!";
            $popupClass = "success-popup";

            header('Location: sellerDashboard.php');
            exit();
        } else {
            $message = "Failed to update user Password";
            $popupClass = "error-popup";
        }
    } elseif (in_array($telephone, $existingSellers)) {
        //setting password for new users
        $query = "INSERT INTO MySecurity(Telephone, Passphrase) VALUES ('$telephone','$hashed_password');";
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            $message = "Password updated successfully!";
            $popupClass = "success-popup";

            header('Location: sellerDashboard.php');
            exit();
        } else {
            $message = "Failed to update Password";
            $popupClass = "error-popup";
        }
    } else { // if the user does not appear in the sellers databases then he/she must be an admin
        $query = "UPDATE Admin SET Passphrase = '$hashed_password' WHERE Telephone = '$telephone';";
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            $message = "Admin Password updated successfully!";
            $popupClass = "error-popup";
            header('Location: adminDashboard.php');
            exit();
        } else {
            $message = "Failed to update admin Password";
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
    <title>KabarakB2B | Set Password</title>

    <link rel="stylesheet" href="./style.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.min.css" rel="stylesheet">
    <style>
        .password-form-container {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            color: var(--dark-color);
        }

        fieldset {
            width: 30rem;
            background: var(--secondary-background);
            text-align: center;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            backdrop-filter: blur(50px);
        }

        .form {
            flex-direction: column;
        }

        legend {
            color: var(--dark-color);
            font-size: var(--font-size-md);
            font-weight: bolder;
            text-transform: capitalize;
        }

        .password-form-container form {
            padding-block: 2rem;
            background-color: transparent;
            padding-bottom: 3rem;
            width: 100%;
        }

        .inputs {
            display: flex;
            flex-direction: column;
            margin: 1rem 3rem;
        }

        .inputs label {
            text-align: start;
            font-weight: 500;
            text-transform: capitalize;
        }

        #password-warning,
        #password-match-warning,
        #otp-warning {
            margin: 0 0 0 10%;
            text-align: start;
            color: red;
            font-size: var(--font-size-sm);
        }

        .input-box {
            display: inline-flex;
            border: 1px solid var(--dark-color);
            height: auto;
            transition: transform border all ease .5s;
        }

        .input-box:hover {
            border: 2px solid cyan;
        }

        .input-box input {
            padding: 2% 0 2% 2%;
            font-size: var(--font-size-sm);
            width: 90%;
            letter-spacing: .5rem;
            border: none;
            outline: none;
        }

        .password-toggle-btn {
            border: none;
            outline: none;
            right: 2%;
            width: 10%;
        }

        .password-toggle-btn i {
            font-size: var(--font-size-sm);
        }

        .show-password-icon {
            display: none;
        }

        .show-password .hide-password-icon {
            display: none;
        }

        .show-password .hide-password-icon {
            display: block;
        }

        .save-btn {
            margin-top: 1rem;
            padding: .5rem 2rem;
            color: var(--light-color);
            background-color: #b94343;
            border: 2px solid #b94343;
        }


        .success-popup {
            background-color: #4DA3FF;
            color: var(--light-color);
        }

        .success-popup.pop-btn {
            background-color: green;
            color: var(--light-color);
        }

        .error-popup {
            background-color: #FF4D4D;
            color: var(--dark-color);
        }

        .error-popup.pop-btn {
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
            fieldset {
                top: 5%;
                width: 100%;
                height: 95%;
            }

            .inputs {
                margin: .5rem 1rem;
            }

            .form {
                margin-top: 4rem;
            }

            #password-warning,
            #password-match-warning {
                margin: auto 1rem;
                text-align: start;
                font-size: var(--font-size-small);
            }

            .input-box input {
                width: 85%;
            }

            .password-toggle-btn {
                width: 15%;
            }
        }
    </style>

</head>

<body>
    <!--Second form-->
    <div class="password-form-container" id="password-form-container">
        <!-- Display the popup based on the success or error message -->
        <div class="popup <?php echo $popupClass; ?>" id="popup">
            <div class="popup-message">
                <p><?php echo $message; ?></p>
                <button class="pop-btn" onclick="closePopup()">Close</button>
            </div>
        </div>
        <fieldset>
            <legend>Privacy & Security</legend>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" class="form">

                <div class="inputs">
                    <label for="passphrase-1">Set New Password:</label>
                    <div class="input-box">
                        <input type="password" name="passphrase-1" id="passphrase-1" minlength="8" maxlength="15" oninput="validatePassword()" autofocus>
                        <button class="password-toggle-btn" onclick="togglePasswordVisibility('passphrase-1')">
                            <i class="ri-eye-line show-password-icon" id="show-password-icon-passphrase-1"></i>
                            <i class="ri-eye-off-line hide-password-icon" id="hide-password-icon-passphrase-1"></i>
                        </button>
                    </div>
                </div>


                <div class="inputs">
                    <label for="passphrase-2">Confirm Password:</label>

                    <div class="input-box">
                        <input type="password" name="passphrase-2" id="passphrase-2" minlength="8" maxlength="15" oninput="checkPasswordMatch()">
                        <button class="password-toggle-btn" onclick="togglePasswordVisibility('passphrase-2')">
                            <i class="ri-eye-line show-password-icon" id="show-password-icon-passphrase-2"></i>
                            <i class="ri-eye-off-line hide-password-icon" id="hide-password-icon-passphrase-2"></i>
                        </button>
                    </div>
                </div>


                <div id="password-match-warning"></div>

                <div class="warnings" id="password-warning">
                    <!-- Display password strength warnings here -->
                </div>

                <div class="btn submit-btn">
                    <!-- This button takes you to the next form -->
                    <button type="submit" name="save" id="finish" class="save-btn" onclick="processForm()">Save</button>
                </div>
            </form>
        </fieldset>
    </div>
</body>

<!--JavaScript-->

<script src="https://kit.fontawesome.com/0bbb899c9f.js" crossorigin="anonymous"></script>

<script>
    //showing and hiding the password
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var showIcon = document.getElementById('show-password-icon-' + inputId);
        var hideIcon = document.getElementById('hide-password-icon-' + inputId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showIcon.style.display = 'none';
            hideIcon.style.display = 'block';
        } else {
            passwordInput.type = "password";
            showIcon.style.display = 'block';
            hideIcon.style.display = 'none';
        }
    }

    function validatePassword() {
        var password = document.getElementById("passphrase-1").value;

        // Password strength validation
        var uppercaseRegex = /[A-Z]/;
        var lowercaseRegex = /[a-z]/;
        var digitRegex = /\d/;
        var symbolRegex = /[@_#,`*]/;

        var isValid = true;
        var warnings = "";

        if (!uppercaseRegex.test(password)) {
            isValid = false;
            warnings += "* Password must contain at least one uppercase letter.\n";
        }

        if (!lowercaseRegex.test(password)) {
            isValid = false;
            warnings += "* Password must contain at least one lowercase letter.\n";
        }

        if (!digitRegex.test(password)) {
            isValid = false;
            warnings += "* Password must contain at least one digit.\n";
        }

        if (!symbolRegex.test(password)) {
            isValid = false;
            warnings += "* Password must contain at least one special character (@ or _).\n";
        }

        document.getElementById("password-warning").innerText = warnings;

        return isValid;
    }

    function checkPasswordMatch() {
        var password1 = document.getElementById("passphrase-1").value;
        var password2 = document.getElementById("passphrase-2").value;
        var passwordMatchWarning = document.getElementById("password-match-warning");

        if (password1 === password2) {
            // Passwords match, clear any previous warning
            passwordMatchWarning.innerText = "";
            var isMatching = true;
        } else {
            // Passwords do not match, display a warning
            passwordMatchWarning.innerText = "* Your passwords do not match!";
            var isMatching = false;
        }
    }

    function validateForm() {
        // Call other validation functions if needed
        var isValid = validatePassword();
        var isMatching = checkPasswordMatch();

        // If any validation fails, prevent form submission
        if ((!isValid) && (!isMatching)) {
            alert("Please fix the errors on the form before submitting.");
            return false;
        }

        return true; // Allow form submission
    }

    function processForm() {
        // After processing, show a message and redirect to the dashboard
        document.title.innerText = 'Redirecting to user Dashboard...';
        setTimeout(function() {
            // Redirect to the dashboard or another page as needed
            document.title.innerText = '';
        }, 3000);
    }
</script>

</html>