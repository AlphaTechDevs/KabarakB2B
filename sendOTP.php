<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once "../vendor/autoload.php";

use Twilio\Rest\Client;

// Twilio credentials
$accountSid = 'AC0c7f578efe5f35dd947f3ce9b9fa8d94';
$authToken  = '90166988ed525de01a3074b92102df23';
$twilioNumber = '+16502296921';

// Recipient's phone number and the message
$toPhoneNumber = $_SESSION['user']; // recipient's phone number
$otp = rand(100000, 999999);
$message = 'Your KabarakB2B verification code is:'. $otp;

$_SESSION['otp'] = $otp;

// Create a Twilio client
$client = new Client($accountSid, $authToken);

try {
    // Send the SMS
    $client->messages->create(
        $toPhoneNumber,//to
        ['from' => $twilioNumber, 'body' => $message]
    );
    echo 'Verification code sent successfully!';
    header('Location: verifyAccount.php');
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>



