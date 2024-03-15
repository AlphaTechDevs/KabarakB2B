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

    if (isset($_POST['del-product'])) {
        // Retrieve the product ID from the form
        $productID = $_POST["product_id"];

        // Add your SQL query to delete the product from the database
        $deleteQuery = "DELETE FROM Products WHERE ProductID = $productID";

        // Execute the query
        $result = mysqli_query($conn, $deleteQuery);

        // Check if the deletion was successful
        if ($result) {
            $message = "Product deleted successfully!";
            $popupClass = "success-popup";
        } else {
            $message = "Error deleting product: " . mysqli_error($conn);
            $popupClass = "error-popup";
        }
    }
    if (isset($_POST['del-service'])) {
        // Retrieve the product ID from the form
        $serviceID = $_POST["service_id"];

        // Add your SQL query to delete the product from the database
        $deleteQuery = "DELETE FROM Services WHERE ServiceID = $serviceID";

        // Execute the query
        $result = mysqli_query($conn, $deleteQuery);

        // Check if the deletion was successful
        if ($result) {
            $message = "Service deleted successfully!";
            $popupClass = "success-popup";
        } else {
            $message = "Error deleting service: " . mysqli_error($conn);
            $popupClass = "error-popup";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KabarakB2B | Delete Product</title>

        <!--Global Styles of the page-->
        <link rel="stylesheet" href="style.css">

        <!--Responsiveness of the page-->
        <link rel="stylesheet" href="responsiveness.css">

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
                margin-top: 6rem;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
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
                padding: .2rem 1.5rem;
            }

            #products thead {
                background-color: var(--box2-color);
            }

            #services thead {
                background-color: var(--box3-color);
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

                .tables-container {

                    width: 100%;
                }

                table {
                    max-width: 100%;
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

                .dashboard-content-container {
                    gap: var(--gap-md);
                }

                .tables-container {
                    width: 100%;
                    margin: 3rem 0;
                    padding: 0;
                }

                table {
                    width: 100%;
                    table-layout: fixed;
                    /* Fix the table layout */
                }

                th,
                td {
                    word-wrap: break-word;
                    white-space: wrap;
                }

                .popup {
                    top: 0;
                    left: 0;
                    margin: 25% 10%;
                    width: 80%;
                }
            }

            @media screen and (max-width: 768px) {
                .dashboard-content-container {
                    grid-template-columns: repeat(2, 1fr);
                    gap: var(--gap-vxsm);
                }

                th {
                    font-size: var(--font-size-small);
                    padding: .25rem .5rem;
                }

                td {
                    font-size: var(--font-size-xsmall);
                    padding: .1rem .75rem;
                }
            }

            @media screen and (max-width: 615px) {
                .header {
                    height: 4rem;
                }

                .welcome-message {
                    margin: 30px 0 15px 0;
                }

                .welcome-message .title {
                    font-size: var(--font-size-m);
                }

                .box .text {
                    font-size: 16px;
                }

                .box .number {
                    font-size: 30px;
                }

                .tables-container {
                    margin-top: 3rem;
                    max-width: 100%;
                }

                table {
                    margin-top: 1.5rem;
                    width: 100%;
                    max-width: 100%;
                }

            }

            @media screen and (max-width: 525px) {
                .dashboard-content-container {
                    grid-template-columns: repeat(1, 1fr);
                    gap: var(--gap);
                }

                th {
                    font-size: var(--font-size-xsmall);
                    padding: .1rem 0;
                }

                td {
                    font-size: 10px;
                    padding: .05rem 0;
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

                <div class="tables-container container">
                    <!--Products in our system--->
                    <table border="1" cellpadding="10" cellspacing="0" align="center" id="products">
                        <thead>
                            <tr>
                                <th colspan="7">Products Uploaded</th>
                            </tr>
                            <tr>
                                <th>
                                    Product ID
                                </th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Brand
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Seller
                                </th>
                                <th>
                                    Delete
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT Products.ProductID AS ProductID, Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.Category AS Category, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID;";

                            $sql = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($sql)) {

                            ?>
                                <tr>
                                    <td> <?php echo $row['ProductID']; ?> </td>
                                    <td> <?php echo $row['ProductName']; ?> </td>
                                    <td> <?php echo $row['Price']; ?> </td>
                                    <td> <?php echo $row['Brand']; ?> </td>
                                    <td> <?php echo $row['Category']; ?> </td>
                                    <td> <?php echo $row['Seller']; ?> </td>
                                    <td>
                                        <form method="post" action="deleteProduct.php">
                                            <input type="hidden" name="product_id" value="<?php echo $row['ProductID']; ?>">
                                            <button type="submit" name="del-product" style="background-color: red; color: var(--dark-color); padding: .5rem 1rem;">Del</button>
                                        </form>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>


                    <!--Services in our system--->
                    <table border="1" cellpadding="10" cellspacing="0" align="center" id="services">
                        <thead>
                            <tr>
                                <th colspan="5">Services Uploaded</th>
                            </tr>
                            <tr>
                                <th>
                                    ServiceID
                                </th>
                                <th>
                                    Service Type
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Seller
                                </th>
                                <th>
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT Services.ServiceID AS ServiceID, Services.ServiceType AS ServiceType, Services.Price AS Price, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID;";

                            $sql = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['ServiceID']; ?> </td>
                                    <td> <?php echo $row['ServiceType']; ?> </td>
                                    <td> <?php echo $row['Price']; ?> </td>
                                    <td> <?php echo $row['Seller']; ?> </td>
                                    <td>
                                        <form method="post" action="deleteProduct.php">
                                            <input type="hidden" name="service_id" value="<?php echo $row['ServiceID']; ?>">
                                            <button type="submit" name="del-service" style="background-color: red; color: var(--dark-color); padding: .5rem 1rem;">Del</button>
                                        </form>
                                    </td>
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
                            <a href="<?php echo './' . $operator . 'Dashboard.php' ?>" class="link">
                                <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                            </a>
                        </div>
                        <div class="org-description">
                            <p>The top leading Affiliates located at Kabarak University Main Campus.</p>
                            <p>We deal with marketing businesses at a commission paid per month.</p>
                            <h6 class="title footer-title" id="contact-us">Our Contacts</h6>
                            <ul class="list footer-list">
                                <li class="list-item">Call: <a href="https://tel: +254104945962" class="link">0104945962</a>
                                </li>
                                <li class="list-item">SMS: <a href="https://sms: +254769320092" class="link">0769320092</a>
                                </li>
                                <li class="list-item">WhatsApp: <a href="https://wa.me/+25479463900" class="link">AlphaTech
                                        Solutions</a></li>
                                <li class="list-item"> Email : <a href="mailto:sangera@kabarak.ac.ke?bcc=lukelasharon02@gmail.com,maxwellwafula884@gmail.com,sharif@kabarak.ac.ke" class="link">info@kabub2b.com</a></li>
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
        };
    </script>

    </html>
<?php
}
?>