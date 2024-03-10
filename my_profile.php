<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
session_start();

include_once 'connect.php';

$telephone = $_SESSION['user'];

//select all users from the database
$query = "SELECT Telephone FROM MySecurity;";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $existingSellersTelephones[] = $row['Telephone'];
}

$query = "SELECT Telephone FROM Admin;";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {

    $existingAdminsTelephones[] = $row['Telephone'];
}

if(isset($_POST['save-admin'])){
    $adminID = $_POST['admin-id'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $passphrase = $_POST['passphrase-2'];

    $passphrase = password_hash($passphrase, PASSWORD_DEFAULT);

    $telephone = (substr($telephone, 0, 1) == "0") ? preg_replace("/^0/", "+254", $telephone) : $telephone;
    $telephone = (substr($telephone, 0, 1) == "7") ? "+254{$telephone}" : $telephone;


    $query = "UPDATE Admin SET Telephone = '$telephone', Email = '$email', Passphrase = '$passphrase' WHERE AdminID = '$adminID'";

    $sql = mysqli_query($conn, $query);
    if ($sql) {

        $message = " Information Successfully Updated";
        $popupClass = "success-popup";
        
    } else {
        $message = "Error updating Information" . mysqli_error($conn);
        $popupClass = "error-popup";
    }

}
if(isset($_POST['save-seller'])){
    
    $sellerID = $_POST['seller-id'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $whatsapp_number = $_POST['whatsapp'];
    $business_type = $_POST['business-type'];
    $business_name = $_POST['business-name'];

    $telephone = (substr($telephone, 0, 1) == "0") ? preg_replace("/^0/", "+254", $telephone) : $telephone;
    $telephone = (substr($telephone, 0, 1) == "7") ? "+254{$telephone}" : $telephone;


    $whatsapp_number = (substr($whatsapp_number, 0, 1) == "0") ? preg_replace("/^0/", "+254", $whatsapp_number) : $whatsapp_number;
    $whatsapp_number = (substr($whatsapp_number, 0, 1) == "7") ? "+254{$whatsapp_number}" : $whatsapp_number;

    $query = "UPDATE Sellers SET Telephone = '$telephone', Email = '$email',WhatsAppNumber = '$whatsapp_number',BusinessName = '$business_name' WHERE SellerID = '$sellerID'";

    $sql = mysqli_query($conn, $query);
    if ($sql) {
        $message = " Information Successfully Updated";
        $popupClass = "success-popup";
        
    } else {

        $message = "Error updating Information" . mysqli_error($conn);
        $popupClass = "error-popup";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Upload Products & Services</title>

    <!--Global Styles of the page-->
    <link rel="stylesheet" href="style.css">

    <!--==Icons on the page==-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY1TAhP5u1bZLrB2JTXQqjE1t1S5PBLmiBbfaD" crossorigin="anonymous">
    <style>
        :root {
            /* ===== Colors ===== */
            --box1-color: #4DA3FF;
            --box2-color: #FFE6AC;
            --box3-color: #E7D1FC;

            /* ====== Transition ====== */
            --tran-05: all 0.5s ease;
            --tran-03: all 0.3s ease;
            --tran-02: all 0.2s ease;
        }

        .header {
            height: 60px;
        }

        .sidebar-open-btn {
            color: var(--dark-color);
        }

        .sidebar {
            top: 5%;
            width: 15%;
            height: 90vh;
            background: var(--secondary-background-color);
            position: fixed;
            left: 0;
            overflow-x: hidden;
            padding-top: 20px;
            overflow-y: scroll;
        }

        .content {
            margin-top: 0;
            margin-left: 15%;
            width: calc(100% - 15%);
            padding: 1.6rem;
            transition: margin-left 0.3s;
        }

        .sidebar-list {
            display: flex;
            flex-direction: column;
        }

        .sidebar-list .menu-item {
            padding-block: .1rem;
            padding-left: .3rem;
            gap: 1rem;
            margin: .3rem auto;
            border-top: 1px solid var(--dark-color);
            width: 100%;
        }

        .sidebar-list .first-item {
            border-top: none;
        }

        .sidebar-list .last-item {
            margin-bottom: 2rem;
        }

        .sidebar.collapsed {
            width: 0%;
            /* Adjust the width as needed */
        }

        .content.expanded {
            margin-left: 0%;
            /* Adjust the margin-left as needed */
            width: calc(100% - 0%);
        }

        .sidebar,
        .content {
            transition: all 0.3s ease;
        }

        .link {
            font-weight: 500;
        }


        button {
            padding: .5rem 1rem;
            background: red;
            color: var(--light-color);
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

        .section {
            padding-block: 3rem;
        }

        .section-title {
            margin-bottom: 3rem;
            padding-block: .5rem;
        }

        .basic-info,
        .contacts-info,
        .business-info {
            margin: auto;
        }

        .dashboard .section-title {
            background-color: #b94343;
            text-align: center;
        }

        .inputs {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 100%;
            padding: 15px 20px;
        }

        .inputs label {
            font-size: var(--font-size-large);
            font-weight: 600;
        }

        .inputs input {
            border: none;
            outline: none;
            font-size: var(--font-size-m);
            background: transparent;
            text-align: center;
            margin-top: 1.5rem;
        }

        .basic-info-container {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--gap);
        }

        .basic-info-container .inputs {
            transition: var(--tran-05);
            background-color: var(--box1-color);
            border-radius: 12px;
        }

        .contact-info-container {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--gap);

        }

        .contact-info-container .inputs {
            transition: var(--tran-05);
            background-color: var(--box2-color);
            border-radius: 12px;
        }

        .business-info-container {
            grid-template-columns: repeat(2, 1fr);
            gap: var(--gap);
        }

        .business-info-container .inputs {
            background-color: var(--box3-color);
            transition: var(--tran-05);
            border-radius: 12px;
        }

        .sellers .basic-info-container {
            grid-template-columns: repeat(3, 1fr);
            gap: var(--gap);
        }

        .sellers .contact-info-container {
            grid-template-columns: repeat(3, 1fr);
            gap: var(--gap);

        }

        .security-info-container .inputs label {
            font-size: var(--font-size-sm);
            font-weight: 500;
        }

        .security-info-container .inputs input {
            background-color: transparent;
            color: var(--dark-color);
            border: 2px solid var(--dark-color);
            padding-block: .5rem ;
            text-align: start;
            padding-left: 1rem;
            letter-spacing: .75rem;
            max-width: 100%;
            width: 35%;
        }

        #password-warning,
        #password-match-warning,
        #otp-warning {
            margin: 0 0 0 10%;
            text-align: start;
            color: red;
            font-size: var(--font-size-sm);
        }
        .save-btn {
            margin-top: 1rem;
            padding: .5rem 2rem;
            color: var(--light-color);
            background-color: #b94343;
            border: 2px solid #b94343;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header class="header" id="header">
        <div class="logo-items">
            <button class="sidebar-open-btn" onclick="toggleSidebar()">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="logo">
                <a href="./adminDashboard.php" class="link">
                    <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                </a>
            </div>
        </div>
    </header>

    <div id="sidebar" class="sidebar">
        <ul class="list sidebar-list">
            <li class="menu-item first-item">
                <a href="./adminDashboard.php" class="link"><i class="#"></i>Site Home</a>
            </li>
            <li class="menu-item">
                <a href="./my_profile.php" class="link"><i class="#"></i>My Profile</a>
            </li>
            <li class="menu-item">
                <a href="./updateProduct.php" class="link"><i class="#"></i>Update Item Info</a>
            </li>
            <li class="menu-item">
                <a href="./updateProfile.php" class="link"><i class="#"></i>Update User's Info</a>
            </li>
            <li class="menu-item">
                <a href="./uploadProduct.php" class="link"><i class="#"></i>Upload Product</a>
            </li>
            <li class="menu-item">
                <a href="./uploadService.php" class="link"><i class="#"></i>Upload Service</a>
            </li>
            <li class="menu-item">
                <a href="./deleteProduct.php" class="link"><i class="#"></i>Delete Items</a>
            </li>
            <li class="menu-item">
                <a href="./deleteUser.php" class="link"><i class="#"></i>Delete User</a>
            </li>
            <li class="menu-item last-item">
                <a href="./logout.php" class="link"><i class="#"></i>Logout</a>
            </li>
        </ul>
    </div>

    <div id="content" class="content">
        <!-- Display the popup based on the success or error message -->
        <div class="popup <?php echo $popupClass; ?>" id="popup">
            <div class="popup-message">
                <p><?php echo $message; ?></p>
                <button class="pop-btn" onclick="closePopup()">Close</button>
            </div>
        </div>
        <section class="section dashboard">
            <?php
            if (in_array($telephone, $existingSellersTelephones)) {

                $query = "SELECT * FROM Sellers WHERE Telephone = '$telephone';";
                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
            ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="myform sellers">
                    <input type="hidden" name="seller-id" id="seller-id" value="<?php echo $row['SellerID']; ?>" >
                        <section class="section basic-info">
                            <div class="section-title">
                                <h4 class="title">Basic Details</h4>
                            </div>
                            <div class="basic-info-container container d-grid">
                                <div class="inputs">
                                    <label for="f-name">First Name</label>
                                    <input type="text" name="f-name" id="f-name" value="<?php echo $row['SellerFirstName']; ?>" readonly>
                                </div>
                                <div class="inputs">
                                    <label for="l-name">Last Name</label>
                                    <input type="text" name="l-name" id="l-name" value="<?php echo $row['SellerLastName']; ?>" readonly>
                                </div>
                                <div class="inputs">
                                    <label for="f-name">Gender</label>
                                    <input type="text" name="gender" id="gender" value="<?php echo $row['Gender']; ?>" readonly>
                                </div>
                                <div class="inputs">
                                    <label for="id-no">National ID NO.</label>
                                    <input type="text" name="id-no" id="id-no" value="<?php echo $row['ID_NO']; ?>" readonly>
                                </div>
                            </div>
                        </section>


                        <section class="section contacts-info">
                            <div class="section-title">
                                <h4 class="title">Contacts</h4>
                            </div>
                            <div class="contact-info-container container d-grid">
                                <div class="inputs">
                                    <label for="telephone">Telephone</label>
                                    <input type="tel" name="telephone" id="telephone" value="<?php echo $row['Telephone']; ?>">
                                </div>
                                <div class="inputs">
                                    <label for="whatsapp">WhatsApp Number</label>
                                    <input type="tel" name="whatsapp" id="whatsapp" value="<?php echo $row['WhatsAppNumber']; ?>">
                                </div>
                                <div class="inputs">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" value="<?php echo $row['Email']; ?>">
                                </div>
                            </div>
                        </section>

                        <section class="section business-info">
                            <div class="section-title">
                                <h4 class="title">Business</h4>
                            </div>
                            <div class="business-info-container container d-grid">
                                <div class="inputs">
                                    <label for="business-type">Business Type</label>
                                    <input type="text" name="business-type" id="business-type" value="<?php echo $row['BusinessType']; ?>" readonly>
                                </div>
                                <div class="inputs">
                                    <label for="business-name">Business Name</label>
                                    <input type="text" name="business-name" id="business-name" value="<?php echo $row['BusinessName']; ?>">
                                </div>
                                <div class="btn submit-btn inputs">
                                    <button type="submit" name="save-seller" id="finish" class="save-btn" onclick="processForm()">Save</button>
                                </div>
                            </div>
                        </section>

                    </form>

                <?php
                }
            } elseif (in_array($telephone, $existingAdminsTelephones)) {

                $query = "SELECT * FROM Admin WHERE Telephone = '$telephone';";
                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="myform">
                    <input type="hidden" name="admin-id" id="admin-id" value="<?php echo $row['AdminID']; ?>" >
                        <section class="section basic-info">
                            <div class="section-title">
                                <h4 class="title">Basic Details</h4>
                            </div>
                            <div class="basic-info-container container d-grid">
                                <div class="inputs">
                                    <label for="f-name">First Name</label>
                                    <input type="text" name="f-name" id="f-name" value="<?php echo $row['AdminFirstName']; ?>" readonly>
                                </div>
                                <div class="inputs">
                                    <label for="l-name">Last Name</label>
                                    <input type="text" name="l-name" id="l-name" value="<?php echo $row['AdminLastName']; ?>" readonly>
                                </div>
                            </div>
                        </section>


                        <section class="section contacts-info">
                            <div class="section-title">
                                <h4 class="title">Contacts</h4>
                            </div>
                            <div class="contact-info-container container d-grid">
                                <div class="inputs">
                                    <label for="telephone">Telephone</label>
                                    <input type="tel" name="telephone" id="telephone" value="<?php echo $row['Telephone']; ?>">
                                </div>
                                <div class="inputs">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" value="<?php echo $row['Email']; ?>">
                                </div>
                            </div>
                        </section>

                        <section class="section security-info">
                            <div class="section-title">
                                <h4 class="title">Privacy & Security</h4>
                            </div>
                            <div class="security-info-container container d-grid">
                                <div class="inputs">
                                    <label for="passphrase-1">Set New Password:</label>
                                        <input type="password" name="passphrase-1" id="passphrase-1" minlength="8" maxlength="16">
                                </div>

                                <div class="inputs">
                                    <label for="passphrase-2">Confirm Password:</label>
                                    <input type="password" name="passphrase-2" id="passphrase-2" minlength="8" maxlength="16">
                                </div>


                                <div id="password-match-warning"></div>

                                <div class="warnings" id="password-warning">
                                    <!-- Display password strength warnings here -->
                                </div>
                                <div class="btn submit-btn inputs">
                                    <button type="submit" name="save-admin" id="finish" class="save-btn" onclick="processForm()">Save</button>
                                </div>
                            </div>
                        </section>
                    </form>
            <?php
                }
            } else {
                $message = "User does not exists";
            }
            ?>
        </section>
        <!--Footer-->
        <footer class="footer section" id="about-us">
            <div class="about-info">
                <h6 class="about-title section-title" data-name="About-us">About us</h6>
            </div>
            <div class="footer-container container d-grid">
                <div class="org-data">
                    <div class="logo">
                        <a href="./adminDashboard.php" class="link">
                            <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                        </a>
                    </div>
                    <div class="org-description">
                        <p>The top leading Affiliates located at Kabarak University Main Campus.</p>
                        <p>We deal with marketing businesses at a commission paid per month.</p>
                        <ul class="list social-media">
                            <li class="list-item">
                                <a href="" class="link"><i class="ri-facebook-line"></i></a>
                            </li>
                            <li class="list-item">
                                <a href="" class="link"><i class="ri-instagram-line"></i></a>
                            </li>
                            <li class="list-item">
                                <a href="" class="link"><i class="ri-telegram-line"></i></a>
                            </li>
                        </ul>
                        <span class="copyright-notice">&copy;2024 KabarakB2B. All rights reserved. Made by AlphaTech Solutions</span>
                    </div>
                </div>

                <div>
                    <h6 class="title footer-title">Categories</h6>
                    <ul class="list footer-list">
                        <li class="list-item"><a href="#" class="link">Clothing & Apparels</a></li>
                        <li class="list-item"><a href="#" class="link">Furniture</a></li>
                        <li class="list-item"><a href="#" class="link">Gas Services</a></li>
                        <li class="list-item"><a href="#" class="link">Health Services</a></li>
                        <li class="list-item"><a href="#" class="link">Beauty & Cosmetics</a></li>
                        <li class="list-item"><a href="#" class="link">BookShops & Stationaries</a></li>
                        <li class="list-item"><a href="#" class="link">General Stores</a></li>
                        <li class="list-item"><a href="#" class="link">HouseHolds</a></li>
                        <li class="list-item"><a href="#" class="link">Hardware</a></li>
                        <li class="list-item"><a href="#" class="link">Beddings</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="title footer-title">Our Contacts</h6>
                    <ul class="list footer-list">
                        <li class="list-item">Call: <a href="https://tel: +254797630228" class="link">0797630228</a></li>
                        <li class="list-item">WhatsApp: <a href="https://wa.me/+254797630228" class="link">AlphaTech Solutions</a></li>
                        <li class="list-item"> Email : <a href="mailto:sangera@kabarak.ac.ke?bcc=lukelasharon02@gmail.com,maxwellwafula@gmail.com,sharif@kabarak.ac.ke" class="link">info@kabub2b.com</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</body>
<script src="./index.js"></script>
<script>
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


    function processForm() {
        // After processing, show a message and redirect to the dashboard
        document.title.innerText = 'Updating User Info...';
        setTimeout(function() {
            // Redirect to the dashboard or another page as needed
            document.title.innerText = '';
        }, 3000);
    }
</script>

</html>


<?php
ob_end_flush();
?>