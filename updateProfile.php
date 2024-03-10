<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once 'connect.php';

if (isset($_POST['save'])) {

    $sellerID = $_POST['seller_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $id_no = $_POST['id_no'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $whatsapp_number = $_POST['whatsapp'];
    $business_type = $_POST['business_type'];
    $business_name = $_POST['business_name'];

    #Make some adjustments so that the data entered may fit our database

    $first_name = strtoupper($first_name);
    $last_name = strtoupper($last_name);

    $telephone = (substr($telephone, 0, 1) == "0") ? preg_replace("/^0/", "+254", $telephone) : $telephone;
    $telephone = (substr($telephone, 0, 1) == "7") ? "+254{$telephone}" : $telephone;


    $whatsapp_number = (substr($whatsapp_number, 0, 1) == "0") ? preg_replace("/^0/", "+254", $whatsapp_number) : $whatsapp_number;
    $whatsapp_number = (substr($whatsapp_number, 0, 1) == "7") ? "+254{$whatsapp_number}" : $whatsapp_number;

    #Update the sellers table and redirect to send OTP
    $query = "UPDATE Sellers SET SellerFirstName = '$first_name', SellerLastName = '$last_name', Gender = '$gender', ID_NO = '$id_no',Telephone = '$telephone', Email = '$email',WhatsAppNumber = '$whatsapp_number',BusinessType = '$business_type',BusinessName = '$business_name' WHERE SellerID = '$sellerID'";
    $sql = mysqli_query($conn, $query);
    if ($sql) {
        
        $message = $first_name . " " . $last_name . "'S Information Successfully Updated";
        $popupClass = "success-popup";
        
    } else {

        $message = "Error updating " . $first_name . " " . $last_name."'S Information" . mysqli_error($conn);
        $popupClass = "error-popup";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Update User's Information</title>

    <!--Global Styles of the page-->
    <link rel="stylesheet" href="style.css">

    <!--==Icons on the page==-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY1TAhP5u1bZLrB2JTXQqjE1t1S5PBLmiBbfaD" crossorigin="anonymous">

    <!--====Local/ Internal Styling====-->
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

        .logo_items .menu-toggle-btn {
            background-color: #fff;
        }

        .link {
            font-weight: 500;
        }

        .tables-container {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            /* Hide overflow to prevent scrolling */
        }

        #sellers {
            width: 100%;
            max-width: 100%;
            /* Set a maximum width for the table */
        }

        #sellers input {
            width: 100%;
            max-width: 100%;
            outline: none;
            border: none;
        }

        table {
            margin-top: 3rem;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            font-size: var(--font-size-m);
            padding: .5rem 1rem;
        }

        td {
            font-size: var(--font-size-small);
            padding: .2rem auto;
        }

        #sellers thead {
            background-color: var(--box1-color);
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

        .form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .form input {
            outline: none;
            border: none;
            padding: 0;
            width: 100%;
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

            <div class="tables-container container">
                <!--Sellers in our system--->
                <table border="1" cellpadding="10" cellspacing="0" align="center" id="sellers">
                    <thead>
                        <tr>
                            <th colspan="10">KabarakB2B Sellers</th>
                        </tr>
                        <tr>
                            <th>
                                First Name
                            </th>
                            <th>
                                Last Name
                            </th>
                            <th>
                                Gender
                            </th>
                            <th>
                                ID Number
                            </th>
                            <th>
                                Telephone
                            </th>
                            <th>
                                WhatsApp
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Business Type
                            </th>
                            <th>
                                Business Name
                            </th>
                            <th>
                                Update User
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM Sellers;";

                        $sql = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <form method="post" action="updateProfile.php" class="form">
                                    <input type="hidden" name="seller_id" value="<?php echo $row['SellerID']; ?>" readonly>

                                    <td> <input type="text" name="first_name" value="<?php echo $row['SellerFirstName']; ?>"> </td>

                                    <td> <input type="text" name="last_name" value="<?php echo $row['SellerLastName']; ?>"> </td>

                                    <td> <input type="text" name="gender" value="<?php echo $row['Gender']; ?>"> </td>

                                    <td> <input type="number" name="id_no" value="<?php echo $row['ID_NO']; ?>" maxlength="8"> </td>

                                    <td> <input type="tel" name="telephone" value="<?php echo $row['Telephone']; ?> " maxlength="15"></td>

                                    <td> <input type="tel" name="whatsapp" value="<?php echo $row['WhatsAppNumber']; ?>" maxlength="15"> </td>

                                    <td> <input type="email" name="email" value="<?php echo $row['Email']; ?>"> </td>

                                    <td> <input type="text" name="business_type" value="<?php echo $row['BusinessType']; ?>"> </td>

                                    <td> <input type="text" name="business_name" value="<?php echo $row['BusinessName']; ?>"> </td>
                                    <td style="padding: .1rem .5rem;">
                                        <button type="submit" style="background-color: red; color: var(--dark-color); padding: .5rem 1rem;" name="save">Update</button>
                                    </td>
                                </form>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <!--Footer-->
        <footer class="footer section" id="about-us">
            <div class="about-info">
                <h6 class="about-title section-title" data-name="About-us">About us</h6>
            </div>
            <div class="footer-container container d-grid">
                <div class="org-data">
                    <div class="logo">
                        <a href="./index.html" class="link">
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
                        <span class="copyright-notice">&copy;2024 KabarakB2B. All rights reserved. Made by AlphaTech
                            Solutions</span>
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
                        <li class="list-item">Call: <a href="https://tel: +254797630228" class="link">0797630228</a>
                        </li>
                        <li class="list-item">WhatsApp: <a href="https://wa.me/+254797630228" class="link">AlphaTech
                                Solutions</a></li>
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
</script>

</html>