<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$operator = $_SESSION['operator'];
if ($operator != 'admin') {

    header('Location: index.html');
    exit();
} else {
    ob_start();
    include_once 'connect.php';
    // Process form submission
    if (isset($_POST['submit_item'])) {
        $service_name = $_POST["service-name"];
        $price = $_POST["price"];
        $image = $_FILES["service-image"];
        $telephone = $_POST['seller'];
        $description = $_POST['description'];

        $telephone = (substr($telephone, 0, 1) == "0") ? preg_replace("/^0/", "+254", $telephone) : $telephone;
        $telephone = (substr($telephone, 0, 1) == "7") ? "+254{$telephone}" : $telephone;

        // Handle image upload for each item
        if ($image !== null && $image["error"] == UPLOAD_ERR_OK) {

            $image_extension = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));

            $target_dir = "uploads/";

            $target_file = $target_dir . uniqid('service_') . '.' . $image_extension;

            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                $image_path = $target_file;

                $sql = "INSERT INTO Services (ServiceType, Price,ServiceDescription, image_path) VALUES ('$service_name', '$price', '$description' ,'$image_path')";

                if ($conn->query($sql) === true) {
                    // Retrieve the ServiceID for the inserted service
                    $query = "SELECT ServiceID FROM Services WHERE ServiceType = '$service_name' AND Price = '$price' AND image_path = '$image_path';";
                    $result = mysqli_query($conn, $query);

                    if ($row = mysqli_fetch_array($result)) {
                        $serviceID = $row['ServiceID'];
                    }

                    // Retrieve the SellerID for the given telephone number
                    $query = "SELECT SellerID FROM Sellers WHERE Telephone = '$telephone';";
                    $result = mysqli_query($conn, $query);

                    if ($row = mysqli_fetch_array($result)) {
                        $SellerID = $row['SellerID'];
                    }

                    // Insert the relation between seller and service into the sellerServices table
                    $SQL = "INSERT INTO sellerServices(SellerID, ServiceID) VALUES ('$SellerID','$serviceID')";
                    if (mysqli_query($conn, $SQL)) {
                        $message = "Service added successfully";
                        $popupClass = "success-popup";
                        header('Location: ' . $_SERVER['PHP_SELF'] . '?update_success=true');
                        exit();
                    } else {
                        $message = "Error inserting into sellerServices: " . mysqli_error($conn);
                        $popupClass = "error-popup";
                    }
                } else {
                    $message = "Error inserting into Services: " . $conn->error;
                    $popupClass = "error-popup";
                }
            } else {
                $lastError = error_get_last();
                $message =  "Error moving uploaded file: " . print_r($lastError, true);

                $popupClass = "error-popup";
            }
        } else {
            $message = "Error: Invalid image for Service";
            $popupClass = "error-popup";
        }
    }

    ob_end_flush();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KabarakB2B | Upload Products & Services</title>

        <!--Global Styles of the page-->
        <link rel="stylesheet" href="style.css">

        <!--Responsiveness of the page-->
        <link rel="stylesheet" href="responsiveness.css">

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

            .buttons {
                top: 0;
                font-size: 1em;
                left: 0;
                border: none;
                width: 2rem;
                height: 2rem;
                background: transparent;
                margin-right: 1rem;
            }

            .menu-open-btn {
                display: none;
            }

            .sidebar-close-btn {
                display: none;
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

            /*upload form*/
            .upload-form-container {
                margin-top: 8%;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .myform {
                padding-block: 2rem;
                background-color: var(--secondary-background);
                border-radius: 20px;
                padding-bottom: 3rem;
                width: 30rem;
            }

            .inputs {
                margin: 1rem 3rem;
                display: flex;
                flex-direction: column;
            }

            .myform-input {
                outline: none;
                border: 2px solid black;
                width: 90%;
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
                width: 70%;
            }

            .mychoices {
                display: none;
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

            .form-btn {
                padding: 1rem 2rem;
                background-color: #b94343;
                cursor: pointer;
                font-size: var(--font-size-m);
                align-self: center;
                width: 60%;
                margin: auto 20%;
                font-weight: 600;
            }

            @media screen and (max-width: 1100px) {
                body {
                    padding: 0;
                    margin: 0;
                    box-sizing: border-box;
                }

                .logo-items {
                    display: flex;
                    flex-direction: row;
                    gap: var(--gap);
                }

                .sidebar {
                    top: 10%;
                    width: 40%;
                    height: 90vh;
                    background: var(--secondary-background);
                    position: fixed;
                    left: 0;
                    display: none;
                    overflow-x: hidden;
                    padding-top: 1rem;
                    overflow-y: scroll;
                    z-index: 1000;
                }

                .content {
                    margin-top: 0;
                    margin-left: 0;
                    width: 100%;
                    padding: 0;
                    transition: none;
                }


                .sidebar-open-btn {
                    display: none;
                }

                .menu-open-btn {
                    display: block;
                }

                .sidebar-close-btn {
                    display: block;
                    right: 0;
                    top: 0;
                }

                .sidebar-list .menu-item {
                    gap: .5rem;
                    font-size: var(--font-size-sm);
                }
            }

            @media screen and (max-width: 950px) {
                .dashboard {
                    margin: auto;

                }
            }

            @media screen and (max-width: 768px) {
                .popup {
                    top: 0;
                    left: 0;
                    margin: 25% 10%;
                    width: 80%;
                }
            }

            @media screen and (max-width: 615px) {
                .header {
                    height: 4rem;
                }


            }

            @media screen and (max-width: 525px) {
                .myform {
                    padding-block: 2rem;
                    border-radius: 20px;
                    padding-bottom: 3rem;
                    width: 100%;
                }
            }
        </style>
    </head>

    <body>
        <header class="header" id="header">
            <div class="logo-items">
                <button class="buttons">
                    <i class="ri-menu-3-line sidebar-open-btn" onclick="toggleSidebar()"></i>
                    <i class="ri-menu-3-line menu-open-btn" onclick="showSideBar()"></i>
                </button>
                <div class="logo">
                    <a href="./adminDashboard.php" class="link">
                        <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                    </a>
                </div>
            </div>
        </header>

        <div id="sidebar" class="sidebar">
            <button class="sidebar-close-btn" id="menu-close-btn" onclick="hideSideBar()">
                <i class="ri-close-line"></i>
            </button>
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
                <!--upload form-->

                <div class="upload-form-container container" id="upload-form-container">
                    <div class="form-container-inner">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" class="myform">
                            <div class="inputs">
                                <label for="service-name">Type of Service:</label> <br>
                                <select name="service-name" class="myform-input select" required autofocus>
                                    <option value="Health Services">Health Services</option>
                                    <option value="Hairdressing">Hairdressing</option>
                                    <option value="Haircut">Haircut</option>
                                    <option value="Electronics Repair">Electronics Repair</option>
                                    <option value="Shoe Repair">Shoe Repair</option>
                                    <option value="Carrier Services">Carrier Services</option>
                                </select>
                            </div>

                            <div class="inputs">
                                <label for="price">Price:</label><br>
                                <input type="number" name="price" class="myform-input" min="1">
                            </div>
                            <div class="inputs">
                                <label for="description">Service Description:</label>
                                <input type="text" name="description" class="myform-input">
                            </div>
                            <div class="inputs">
                                <label for="service-image">Image of Service:</label>
                                <input type="file" name="service-image" accept="image/*" required>
                            </div>
                            <div class="inputs">
                                <label for="seller">Seller's Business Name:</label>
                                <select name="seller" class="myform-input select" required>
                                    <?php
                                    $query = "SELECT BusinessName,Telephone FROM Sellers;";
                                    $sql = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <option value="<?php echo $row['Telephone']; ?>"><?php echo $row['BusinessName']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <button class="form-btn" type="submit" name="submit_item">Upload</button>
                        </form>
                    </div>
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
                            <a href="<?php echo './' . $operator . 'Dashboard.php' ?>" class="link">
                                <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                            </a>
                        </div>
                        <div class="org-description">
                            <p>The top leading Affiliates located at Kabarak University Main Campus.</p>
                            <p>We deal with marketing businesses at a commission paid per month.</p>
                            <h6 class="title footer-title" id="contact-us">Our Contacts</h6>
                            <ul class="list footer-list">
                                <li class="list-item">Call: <a href="tel:+254104945962" class="link">0104945962</a>
                                </li>
                                <li class="list-item">SMS: <a href="sms:+254769320092" class="link">0769320092</a>
                                </li>
                                <li class="list-item">WhatsApp: <a href="https://wa.me/+25479463900" class="link" target="_blank">AlphaTech
                                        Solutions</a></li>
                                <li class="list-item"> Email : <a href="mailto:sangera@kabarak.ac.ke?bcc=lukelasharon02@gmail.com,maxwellwafula884@gmail.com,sharif@kabarak.ac.ke" class="link" target="_blank">info@kabub2b.com</a>
                                </li>
                            </ul>
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
                        <h6 class="title footer-title">Products</h6>
                        <ul class="list footer-list">
                            <li class="list-item"><a href="#" class="link">Clothing & Apparels</a></li>
                            <li class="list-item"><a href="#" class="link">Furniture</a></li>
                            <li class="list-item"><a href="#" class="link">Gas Cylinders</a></li>
                            <li class="list-item"><a href="#" class="link">Health Services</a></li>
                            <li class="list-item"><a href="#" class="link">Beauty & Cosmetics</a></li>
                            <li class="list-item"><a href="#" class="link">BookShops & Stationaries</a></li>
                            <li class="list-item"><a href="#" class="link">General Stores</a></li>
                            <li class="list-item"><a href="#" class="link">HouseHolds</a></li>
                            <li class="list-item"><a href="#" class="link">Hardware</a></li>
                            <li class="list-item"><a href="#" class="link">Beddings</a></li>
                            <li class="list-item"><a href="#" class="link">Electronics</a></li>
                        </ul>
                    </div>

                    <div>
                        <h6 class="title footer-title">Services</h6>
                        <ul class="list footer-list">
                            <li class="list-item"><a href="#" class="link">Health</a></li>
                            <li class="list-item"><a href="#" class="link">Haircut</a></li>
                            <li class="list-item"><a href="#" class="link">Hairdressing</a></li>
                            <li class="list-item"><a href="#" class="link">Gas Refill</a></li>
                            <li class="list-item"><a href="#" class="link">Beddings</a></li>
                            <li class="list-item"><a href="#" class="link">Electronics Repair</a></li>
                            <li class="list-item"><a href="#" class="link">Shoe Repair</a></li>
                            <li class="list-item"><a href="#" class="link">Carrier Services</a></li>
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
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('update_success')) {
                document.getElementById('popup').style.display = 'flex';
            }
        };
    </script>

    </html>

<?php
}
?>