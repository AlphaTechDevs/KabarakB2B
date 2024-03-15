<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Set cache headers for 1 week
header("Cache-Control: max-age=604800, public");

session_start();

$telephone = $_SESSION['user'];
$operator = $_SESSION['operator'];
if ($operator != 'admin') {

    header('Location: index.html');
    exit();
} else {

    include_once 'connect.php';


    $query = "SELECT AdminFirstName, AdminLastName, Email FROM Admin WHERE Telephone = '$telephone';";
    $sql = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($sql)) {
        $first_name = $row['AdminFirstName'];
        $last_name = $row['AdminLastName'];
        $Email = $row['Email'];
    }


    //Select Number of Registered Sellers

    $query = "SELECT COUNT(SellerID) AS TotalSellers FROM Sellers;";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_sellers = $row['TotalSellers'];
    }

    //select Number of Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products;";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_products = $row['TotalProducts'];
    }


    //select Number of Services
    $query = "SELECT COUNT(ServiceID) AS TotalServices FROM Services;";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_services = $row['TotalServices'];
    }


    //select Number of Gas Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Gas services';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_gas_products = $row['TotalProducts'];
    }


    //select Number of Furniture Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Furniture';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_furnitures = $row['TotalProducts'];
    }

    //select Number of Households Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Households';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_households = $row['TotalProducts'];
    }

    //select Number of Cosmetic Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Beauty & Cosmetics';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_cosmetics = $row['TotalProducts'];
    }

    //select Number of General Stores Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'General Stores';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_general_stores = $row['TotalProducts'];
    }

    //select Number of Beddings Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Beddings';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_beddings_products = $row['TotalProducts'];
    }

    //select Number of clothes Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Clothing & Aparels';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_clothes = $row['TotalProducts'];
    }

    //select Number of Hardware Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Hardware';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_hardware = $row['TotalProducts'];
    }

    //select Number of Electronics Products
    $query = "SELECT COUNT(ProductID) AS TotalProducts FROM Products WHERE Category = 'Electronics';";
    $sql = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_array($sql)) {
        $number_of_electronics = $row['TotalProducts'];
    }



    $_SESSION['user'] = $telephone;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KabarakB2B | Admin Dashboard</title>

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

            .menu-open-btn {
                display: none;
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

            .content {
                margin-top: 0;
                margin-left: 15%;
                width: calc(100% - 15%);
                padding: 1.6rem;
                transition: margin-left 0.3s;
            }

            .sidebar-close-btn {
                display: none;
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

            .welcome-message {
                display: flex;
                align-items: flex-start;
                margin: 60px 0 30px 0;
            }

            .welcome-message .title {
                font-size: var(--font-size-md);
            }

            .dashboard-content-container {
                grid-template-columns: repeat(3, 1fr);
                gap: var(--gap);
            }

            .box {
                display: flex;
                flex-direction: column;
                align-items: center;
                border-radius: 12px;
                width: 100%;
                padding: 15px 20px;
                background-color: var(--box1-color);
                transition: var(--tran-05);
            }

            .box .text {
                white-space: nowrap;
                font-size: 18px;
                font-weight: 500;
                color: var(--dark-color);
            }

            .box .number {
                font-size: 40px;
                font-weight: 500;
                color: var(--text-color);
            }

            .box.box2 {
                background-color: var(--box2-color);
            }

            .box.box3 {
                background-color: var(--box3-color);
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
                max-width: 100%;
            }

            #sellers {
                margin-top: 0;
            }

            #sellers thead {
                background-color: var(--box1-color);
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

                .popup {
                    top: 0;
                    left: 0;
                    margin: 25% 10%;
                    width: 80%;
                }

                .sidebar {
                    top: 5%;

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
                    <a href="<?php echo './' . $operator . 'Dashboard.php' ?>" class="link">
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
                    <a href="<?php echo './' . $operator . 'Dashboard.php' ?>" class="link"><i class="#"></i>Site Home</a>
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

            <section class="section dashboard">
                <div class="welcome-message">
                    <h4 class="title">Hello <?php echo $first_name; ?>, Welcome to Kabarak<span class="tm">B2B</span> Admin's Dashboard. </h4>
                </div>

                <div class="dashboard-content-container container d-grid" id="dashboard-content-container">
                    <div class="box box1">
                        <span class="text">Total Sellers Registered</span>
                        <span class="number"> <?php echo $number_of_sellers; ?> </span>
                    </div>


                    <div class="box box2">
                        <span class="text">Total Products Uploaded</span>
                        <span class="number"> <?php echo $number_of_products; ?> </span>
                    </div>


                    <div class="box box3">
                        <span class="text">Total Services Uploaded</span>
                        <span class="number"> <?php echo $number_of_services; ?> </span>
                    </div>


                    <div class="box box2">
                        <span class="text">Furnitures Online</span>
                        <span class="number"> <?php echo $number_of_furnitures; ?> </span>
                    </div>

                    <div class="box box3">
                        <span class="text">Household Products Online</span>
                        <span class="number"> <?php echo $number_of_households; ?> </span>
                    </div>

                    <div class="box box1">
                        <span class="text">Gas Products Online</span>
                        <span class="number"> <?php echo $number_of_gas_products; ?> </span>
                    </div>

                    <div class="box box3">
                        <span class="text">Clothes Online</span>
                        <span class="number"> <?php echo $number_of_clothes; ?> </span>
                    </div>

                    <div class="box box1">
                        <span class="text">Cosmetic Products Online </span>
                        <span class="number"> <?php echo $number_of_cosmetics; ?> </span>
                    </div>


                    <div class="box box2">
                        <span class="text">Bedding Products Online </span>
                        <span class="number"> <?php echo $number_of_beddings_products; ?> </span>
                    </div>


                    <div class="box box1">
                        <span class="text">General Stores Online</span>
                        <span class="number"> <?php echo $number_of_general_stores; ?> </span>
                    </div>


                    <div class="box box2">
                        <span class="text">Hardware Products Online</span>
                        <span class="number"> <?php echo $number_of_hardware; ?> </span>
                    </div>


                    <div class="box box3">
                        <span class="text">Electronic Appliances Online</span>
                        <span class="number"> <?php echo $number_of_electronics; ?> </span>
                    </div>
                </div>

                <div class="tables-container container">

                    <!--Sellers in our system--->
                    <table border="1" cellpadding="10" cellspacing="0" align="center" id="sellers">
                        <thead>
                            <tr>
                                <th colspan="7">KabarakB2B Registered Sellers</th>
                            </tr>
                            <tr>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM Sellers ORDER BY SellerID DESC;";

                            $sql = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($sql)) {
                                $seller_id = $row['SellerID'];
                            ?>
                                <tr>
                                    <td> <?php echo $row['SellerFirstName']; ?> </td>
                                    <td> <?php echo $row['SellerLastName']; ?> </td>
                                    <td> <?php echo $row['Telephone']; ?> </td>
                                    <td> <?php echo $row['WhatsAppNumber']; ?> </td>
                                    <td> <?php echo $row['Email']; ?> </td>
                                    <td> <?php echo $row['BusinessType']; ?> </td>
                                    <td> <?php echo $row['BusinessName']; ?> </td>

                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>


                    <!--Products in our system--->
                    <table border="1" cellpadding="10" cellspacing="0" align="center" id="products">
                        <thead>
                            <tr>
                                <th colspan="6">Products Uploaded</th>
                            </tr>
                            <tr>
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
                                    Date uploaded
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.Category AS Category, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller, Products.DayOfUpload AS DOP FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID ORDER BY Products.ProductID DESC;";

                            $sql = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['ProductName']; ?> </td>
                                    <td> <?php echo $row['Price']; ?> </td>
                                    <td> <?php echo $row['Brand']; ?> </td>
                                    <td> <?php echo $row['Category']; ?> </td>
                                    <td> <?php echo $row['Seller']; ?> </td>
                                    <td> <?php echo $row['DOP']; ?> </td>
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
                                <th colspan="4">Services Uploaded</th>
                            </tr>
                            <tr>
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
                                    Date uploaded
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller,Services.DayOfUpload AS DOP FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID ORDER BY Services.ServiceID DESC;";

                            $sql = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['ServiceType']; ?> </td>
                                    <td> <?php echo $row['Price']; ?> </td>
                                    <td> <?php echo $row['Seller']; ?> </td>
                                    <td> <?php echo $row['DOP']; ?> </td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>



                    <!--individua products in our system--->
                    <table border="1" cellpadding="10" cellspacing="0" align="center" id="products">
                        <thead>
                            <tr>
                                <th colspan="2">Individual Seller products</th>
                            </tr>
                            <tr>
                                <th>
                                    Seller
                                </th>
                                <th>
                                    Total Products
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT Sellers.BusinessName AS Seller, COUNT(sellerProducts.ProductID) AS TotalProducts FROM sellerProducts, Sellers WHERE sellerProducts.SellerID = Sellers.SellerID GROUP BY Sellers.BusinessName;";

                            $sql = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['Seller']; ?> </td>
                                    <td> <?php echo $row['TotalProducts']; ?> </td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>




                    <!--individual Services in our system--->
                    <table border="1" cellpadding="10" cellspacing="0" align="center" id="services">
                        <thead>
                            <tr>
                                <th colspan="2">Individual Seller services</th>
                            </tr>
                            <tr>
                                <th>
                                    Seller
                                </th>
                                <th>
                                    Total Services
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT Sellers.BusinessName AS Seller, COUNT(sellerServices.ServiceID) AS TotalServices FROM sellerServices, Sellers WHERE sellerServices.SellerID = Sellers.SellerID GROUP BY Sellers.BusinessName;";

                            $sql = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['Seller']; ?> </td>
                                    <td> <?php echo $row['TotalServices']; ?> </td>
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
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');

            // Toggle the 'collapsed' class on the sidebar
            sidebar.classList.toggle('collapsed');

            // Toggle the 'expanded' class on the content
            content.classList.toggle('expanded');
        }

        function showSideBar() {
            document.querySelector('.sidebar').style.display = 'block';
            document.querySelector('.menu-open-btn').style.display = 'none';
        }

        function hideSideBar() {
            document.querySelector('.sidebar').style.display = 'none';
            document.querySelector('.menu-open-btn').style.display = 'block';
        }
    </script>

    </html>
<?php
}
?>