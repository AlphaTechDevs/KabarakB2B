<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once 'connect.php';

$popupClass = "";
$message = "";

if (isset($_POST['save-product'])) {
    $productID = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $seller = $_POST['seller'];

    // Handle image upload only if the user wants to update the image
    if (isset($_POST['update_image']) && $_POST['update_image'] == 1) {
        $image = $_FILES['image'];

        if ($image !== null && $image['error'] == UPLOAD_ERR_OK) {
            $image_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            $target_dir = 'uploads/';
            $target_file = $target_dir . uniqid('product_') . '.' . $image_extension;

            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                // Update the image_path in the database
                $image_path = $target_file;
            } else {
                // Handle the error if file move fails
                $message = "Error moving uploaded file.";
                $popupClass = "error-popup";
            }
        }
    } else {
        // If the user doesn't want to update the image, use the existing image path
        $image_path = $_POST['existing_image'];
    }

    $updateProductQuery = "UPDATE Products SET ProductName = '$product_name', Price = '$price', Brand = '$brand', Category = '$category', image_path = '$image_path' WHERE ProductID = '$productID'";
    $sql = mysqli_query($conn, $updateProductQuery);

    // Check if the query was successful
    if ($sql) {
        $message = $product_name . " Updated Successfully";
        $popupClass = "success-popup";
    } else {
        $message = "Error updating Product: " . mysqli_error($conn);
        $popupClass = "error-popup";
    }
}

if (isset($_POST['save-service'])) {
    $ServiceID = $_POST['service-id'];
    $service_name = $_POST['service-type'];
    $price = $_POST['price'];
    $seller = $_POST['seller'];

    // Handle image upload only if the user wants to update the image
    if (isset($_POST['update_image']) && $_POST['update_image'] == 1) {
        $image = $_FILES['image'];

        if ($image !== null && $image['error'] == UPLOAD_ERR_OK) {
            $image_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            $target_dir = 'uploads/';
            $target_file = $target_dir . uniqid('service_') . '.' . $image_extension;

            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                // Update the image_path in the database
                $image_path = $target_file;
            } else {
                // Handle the error if file move fails
                $message = "Error moving uploaded file.";
                $popupClass = "error-popup";
            }
        }
    } else {
        // If the user doesn't want to update the image, use the existing image path
        $image_path = $_POST['existing_image'];
    }

    $updateServiceQuery = "UPDATE Services SET ServiceType = '$service_name', Price = '$price', image_path = '$image_path' WHERE ServiceID = '$ServiceID'";

    $sql = mysqli_query($conn, $updateServiceQuery);

    if ($sql) {
        $message = $service_name . " Updated Successfully";
        $popupClass = "success-popup";
    } else {
        $message = "Error updating Service: " . mysqli_error($conn);
        $popupClass = "error-popup";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Update Products & Services</title>

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
        .buttons{
                top: 0;
                font-size: 1em;
                left: 0;
                border: none;
                width: 2rem;
                height: 2rem;
                background: transparent;
                margin-right: 1rem;
            }
        .menu-open-btn{
                display: none;
            }
            .sidebar-close-btn{
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
            color: var(--dark-color);
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

        #products input,#services input{
            outline: none;
            border: none;
            padding: 0;
            width: 100%;
        }
        #products .images .check,#services .images .check{
            width: 10%;
            margin-top: .5rem;
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
        @media screen and (max-width: 1100px) {
            body {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            .logo-items{
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
            margin: 25% 10% ;
            width: 80%;
        }
        }

        @media screen and (max-width: 615px) {
            .header {
                height: 3rem;
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
                <a href="./updateProduct.php" class="link"><i class="#"></i>Update Items Info</a>
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
                                Image Path
                            </th>
                            <th>
                                Seller
                            </th>
                            <th>
                                Update
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT Products.ProductID AS ProductID, Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.Category AS Category, Products.image_path AS image_path, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID;";

                        $sql = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($sql)) {

                        ?>
                            <tr>
                                <form method="post" action="updateProduct.php" enctype="multipart/form-data" class="form">
                                    <input type="hidden" name="product_id" value="<?php echo $row['ProductID']; ?>">
                                    <td> <input type="text" name="product_name" value="<?php echo $row['ProductName']; ?>"></td>
                                    <td> <input type="text" name="price" value="<?php echo $row['Price']; ?> "> </td>
                                    <td> <input type="text" name="brand" value="<?php echo $row['Brand']; ?>"> </td>
                                    <td> <input type="text" name="category" value="<?php echo $row['Category']; ?>"> </td>
                                    <td class="images"> <input type="file" name="image" accept="*/image">
                                        <input type="hidden" name="existing_image" value="<?php echo $row['image_path']; ?>">
                                        <input type="checkbox" name="update_image" value="1" class="check">Update Image
                                    </td>

                                    <td> <input type="text" name="seller" value="<?php echo $row['Seller']; ?>"> </td>
                                    <td>
                                        <button type="submit" style="background-color: red; color: var(--dark-color); padding: .25rem .5rem;" name="save-product">Update</button>
                                    </td>
                                </form>
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
                                Service Type
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Image Path
                            </th>
                            <th>
                                Seller
                            </th>
                            <th>
                                Update
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT Services.ServiceID AS ServiceID, Services.ServiceType AS ServiceType, Services.Price AS Price, Services.image_path AS image_path, CONCAT(Sellers.SellerFirstName,' ',Sellers.SellerLastName) AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID;";

                        $sql = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <form method="post" action="updateProduct.php" enctype="multipart/form-data" class="form">
                                <input type="hidden" name="service-id" value="<?php echo $row['ServiceID']; ?>">

                                    <td> <input type="text" name="service-type" value="<?php echo $row['ServiceType']; ?>"> </td>

                                    <td> <input type="text" name="price" value="<?php echo $row['Price']; ?> "> </td>

                                    <td class="images"> <input type="file" name="image" accept="*/image">
                                        <input type="hidden" name="existing_image" value="<?php echo $row['image_path']; ?>">
                                        <input type="checkbox" name="update_image" value="1" class="check"> Update Image
                                    </td>

                                    <td> <input type="text" name="seller" value="<?php echo $row['Seller']; ?>"> </td>
                                    <td>
                                        <button type="submit" style="background-color: red; color: var(--dark-color); padding: .5rem 1rem;" name="save-service">Update</button>
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