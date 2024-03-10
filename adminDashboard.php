<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start(); //buffering - stores the details on temporary memories

session_start();

include_once 'connect.php';

$telephone = $_SESSION['user'];

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

        .tables-container{
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
        #sellers{
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
                <a href="./adminDashboard.php#" class="link"><i class="#"></i>Site Home</a>
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
            </div>

            <div class="tables-container container">

                <!--Sellers in our system--->
                <table border="1" cellpadding="10" cellspacing="0" align="center" id="sellers">
                    <thead>
                        <tr>
                            <th colspan="7">KabarakB2B Sellers</th>
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
                        $query = "SELECT * FROM Sellers;";

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
                            <th colspan="5">Products Uploaded</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.Category AS Category, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID;";

                        $sql = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td> <?php echo $row['ProductName']; ?> </td>
                                <td> <?php echo $row['Price']; ?> </td>
                                <td> <?php echo $row['Brand']; ?> </td>
                                <td> <?php echo $row['Category']; ?> </td>
                                <td> <?php echo $row['Seller']; ?> </td>
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
                            <th colspan="3">Services Uploaded</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID;";

                        $sql = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td> <?php echo $row['ServiceType']; ?> </td>
                                <td> <?php echo $row['Price']; ?> </td>
                                <td> <?php echo $row['Seller']; ?> </td>
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
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        // Toggle the 'collapsed' class on the sidebar
        sidebar.classList.toggle('collapsed');

        // Toggle the 'expanded' class on the content
        content.classList.toggle('expanded');
    }
</script>

</html>