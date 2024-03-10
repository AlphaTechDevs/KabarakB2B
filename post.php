<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Products & Services</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.min.css" rel="stylesheet">

    <style>
        .featured-items{
            background-color: var(--primary-background);
        }
    </style>
</head>

<body>
    <header class="header" id="header">
        <div class="logo-items">
            <button class="sidebar-open-btn" onclick="showSideBar()">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="logo">
                <a href="./index.html" class="link">
                    <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                </a>
            </div>
        </div>
        <nav class="navbar" id="navbar1">
            <div class="menu">
                <ul class="list">
                    <li class="menu-item"><a href="#" class="link">Home</a></li>
                    <li class="menu-item"><a href="#" class="link">Contact us</a></li>
                    <li class="menu-item"><a href="./index.html#about-us" class="link">About us</a></li>
                    <li class="menu-item"><a href="./login.html" class="link">Login</a></li>
                    <li class="menu-item"><a href="./signup.php" class="link">Register</a></li>
                </ul>
            </div>
        </nav>
        <nav class="sidebar hidden" id="sidebar">
            <button class="sidebar-close-btn" id="menu-close-btn" onclick="hideSideBar()">
                <i class="ri-close-line"></i>
            </button>
            <div class="menu">
                <ul class="sidebar-items">
                    <!--Hidden on large screens-->
                    <li class="menu-item"><a href="#" class="link item-hidden">Home</a></li>
                    <li class="menu-item"><a href="#" class="link item-hidden">Contact us</a></li>
                    <li class="menu-item"><a href="#about-us" class="link item-hidden">About us</a></li>
                    <li class="menu-item"><a href="./login.html" class="link item-hidden">Login</a></li>
                    <li class="menu-item"><a href="./signup.php" class="link item-hidden">Register</a></li>

                    <li class="menu-item"><a href="#" class="link">Clothing & Apparels</a></li>
                    <li class="menu-item"><a href="#" class="link">Furniture</a></li>
                    <li class="menu-item"><a href="#" class="link">Gas Services</a></li>
                    <li class="menu-item"><a href="#" class="link">Health Services</a></li>
                    <li class="menu-item"><a href="#" class="link">Beauty & Cosmetics</a></li>
                    <li class="menu-item"><a href="#" class="link">BookShops & Stationaries</a></li>
                    <li class="menu-item"><a href="#" class="link">General Stores</a></li>
                    <li class="menu-item"><a href="#" class="link">HouseHolds</a></li>
                    <li class="menu-item"><a href="#" class="link">Hardware</a></li>
                    <li class="menu-item"><a href="#" class="link">Beddings</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!--Search form-->
    <div class="search-form-container container" id="search-form-container">
        <div class="container-inner">
            <form action="" class="form">
                <input type="search" name="keyword" id="keyword" class="form-input" placeholder="What are you looking for?">
                <button class="btn form-btn" type="submit">
                    <i class="ri-search-line"></i>
                </button>
            </form>
        </div>
    </div>

    <!--Gas Services-->

    <section class="featured-items section" id="gas-services">
        <div class="container">
            <h2 class="title section-title" data-name="Gas Services">Gas services</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Gas Services';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Clothings-->
    <section class="featured-items section" id="clothing&apparels">
        <div class="container">
            <h2 class="title section-title" data-name="Clothing & Aparel">Clothings & Aparels</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Clothes';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--Furnitures-->
    <section class="featured-items section" id="furniture">
        <div class="container">
            <h2 class="title section-title" data-name="furnitures">Furnitures</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Furniture';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Beddings-->
    <section class="featured-items section" id="beddings">
        <div class="container">
            <h2 class="title section-title" data-name="beddings">Beddings</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Beddings';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Beauty & Cosmetics-->
    <section class="featured-items section" id="beauty&cosmetics">
        <div class="container">
            <h2 class="title section-title" data-name="Beauty & Cosmetics">Beauty & Cosmetics</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Beauty & Cosmetics';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Hardware-->
    <section class="featured-items section" id="hardware">
        <div class="container">
            <h2 class="title section-title" data-name="Hardware">Hardware</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Hardware';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--Households-->

    <section class="featured-items section" id="households">
        <div class="container">
            <h2 class="title section-title" data-name="Households">HouseHolds</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Households';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Bookshop & Stationary-->
    <section class="featured-items section" id="bookshop&stationary">
        <div class="container">
            <h2 class="title section-title" data-name="Bookshop & Stationary">Bookshop & Stationary</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Bookshop & Stationary';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--General Stores-->
    <section class="featured-items section" id="general-stores">
        <div class="container">
            <h2 class="title section-title" data-name="General Stores">General Stores</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'General Stores';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Electronics-->
    <section class="featured-items section" id="electronics">
        <div class="container">
            <h2 class="title section-title" data-name="Electronics">Electronics</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Electronics';

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['price'] = $row['Price'];
                                $_SESSION['service-type'] = $row['ProductName'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--Health Services-->
    <section class="featured-items section" id="health">
        <div class="container">
            <h2 class="title section-title" data-name="Health Services">Health Services</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Health Services';

                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Services.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['service-type'] = $row['ServiceType'];
                                $_SESSION['price'] = $row['Price'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Hairdressing-->
    <section class="featured-items section" id="hairdressing">
        <div class="container">
            <h2 class="title section-title" data-name="Hairdressing">Hairdressing</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Hairdressing';

                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Services.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['service-type'] = $row['ServiceType'];
                                $_SESSION['price'] = $row['Price'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--Haircut-->
    <section class="featured-items section" id="haircut">
        <div class="container">
            <h2 class="title section-title" data-name="Haircut">Haircut</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Haircut';

                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Services.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['service-type'] = $row['ServiceType'];
                                $_SESSION['price'] = $row['Price'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!--Electronics Repair-->
    <section class="featured-items section" id="electronics-repair">
        <div class="container">
            <h2 class="title section-title" data-name="Electronics Repair">Electronics Repair</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Electronics Repair';

                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Services.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['service-type'] = $row['ServiceType'];
                                $_SESSION['price'] = $row['Price'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--Shoe Repair-->
    <section class="featured-items section" id="shoe-repair">
        <div class="container">
            <h2 class="title section-title" data-name="Shoe Repair">Shoe Repair</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Shoe Repair';

                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Sellers.BusinessName AS Seller ,Services.image_path AS image_path FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['service-type'] = $row['ServiceType'];
                                $_SESSION['price'] = $row['Price'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--Carrier Services-->
    <section class="featured-items section" id="carrier-services">
        <div class="container">
            <h2 class="title section-title" data-name="Carrier Services">Carrier Services</h2>
            <div class="featured-items-container d-grid">
                <?php

                $category = 'Carrier Services';

                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Services.image_path AS image_path, Sellers.BusinessName AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php" class="item">
                        <img src="<?php echo './'. $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                                <?php
                                $_SESSION['seller'] = $row['Seller'];
                                $_SESSION['service-type'] = $row['ServiceType'];
                                $_SESSION['price'] = $row['Price'];
                                ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>



    <!--NewsLetter-->
    <section class="newsletter section">
        <div class="container">
            <h2 class="title section-title" data-name="Newsletter">Newsletter</h2>
            <div class="form-container-inner">
                <h6 class="title newsletter-title">Subscribe to Kabarak<span class="tm">B2B</span></h6>
                <p class="newsletter-description">
                    Get our latest updates as soon as they are released.
                </p>
                <form action="" class="form">
                    <input type="text" class="form-input" placeholder="Enter your email address">
                    <button class="btn form-btn" type="submit">
                        <i class="ri-mail-send-line"></i>
                    </button>
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
                    <li class="list-item">Call: <a href="https://tel: +254797630228" class="link">0797630228</a></li>
                    <li class="list-item">WhatsApp: <a href="https://wa.me/+254797630228" class="link">AlphaTech Solutions</a></li>
                    <li class="list-item"> Email : <a href="mailto:sangera@kabarak.ac.ke?bcc=lukelasharon02@gmail.com,maxwellwafula@gmail.com,sharif@kabarak.ac.ke" class="link">info@kabub2b.com</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
<script src="./index.js"></script>

</html>