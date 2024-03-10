<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$code_sent = $_SESSION['otp'];
$telephone = $_SESSION['user'];
$code_recieved = '';

if (isset($_POST['confirm'])) {
    $code_recieved = $_POST['code'];
    if ($code_recieved == $code_sent) {
        echo "<script>alert('Verified successfully !');</script>";
        header('Location: setPassword.php');
        exit();
    } else {
        echo "<script>alert('Verification failed !');</script>";
        header('Location: verifyAccount.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Veriffication</title>
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
            width: 30%;
            border: 2px solid var(--dark-color);
            padding-block: .5rem;
            padding-left: .5rem;
            font-size: var(--font-size-sm);
            border-radius: .5rem;
            font-weight: 500;
            align-self: center;
            letter-spacing: 1rem;
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
    </style>
</head>

<body>
    <!--verification form-->
    <div class="verify-form-container container" id="verify-form-container">
        <div class="container-inner place-item-center">
            <legend>Thank you for registering to Kabarak<span class="tm">B2B</span>, kindly enter the code that was sent to <?php $telephone ?></legend>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="form">
                    <input type="number" name="code" required class="form-input" autocomplete="on" autofocus min="100000" max="999999" >
                <div class="inputs">
                    <button type="submit" name="register" class="btn">Confirm</button>
                </div>
                <div class="inputs">
                    <span><a href="./sendOTP.php" class="link">Resend code</a></span>
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
</script>
</html>