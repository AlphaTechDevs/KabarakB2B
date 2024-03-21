<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
// Set cache headers for 1 week
header("Cache-Control: max-age=604800, public");

if (isset($_GET['operator'])) {
    $operator = $_GET['operator'];
} else {
    $operator = urldecode($_GET['operator']);
}

$_SESSION['operator'] = $operator ?? 'buyer'; #if the variable operator is null the session variable will be given the value buyer

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
        .featured-items {
            background-color: var(--primary-background);
        }

        .item-data-container {
            background-color: var(--transparent-dark-color);
            color: var(--light-color);
        }

        .item-title {
            color: var(--light-color);
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
                <?php
                if ($operator === "seller") {
                ?>
                    <a href="sellerDashboard.php" class="link">
                        <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                    </a>
                <?php
                } else {
                ?>
                    <a href="./index.html" class="link">
                        <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
        <nav class="navbar" id="navbar1">
            <div class="menu">

                <ul class="list">
                    <?php
                    if ($operator === "seller") {
                    ?>
                        <li class="menu-item"><a href="./sellerDashboard.php" class="link">Home</a></li>
                        <li class="menu-item"><a href="./index.html#contact-us" class="link">Contact us</a></li>
                        <li class="menu-item"><a href="./index.html#about-us" class="link">About us</a></li>
                        <li class="menu-item"><a href="./logout.php" class="link">Logout</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="menu-item"><a href="./index.html#" class="link">Home</a></li>
                        <li class="menu-item"><a href="./index.html#contact-us" class="link">Contact us</a></li>
                        <li class="menu-item"><a href="./index.html#about-us" class="link">About us</a></li>
                        <li class="menu-item"><a href="./login.html" class="link">Login</a></li>
                        <li class="menu-item"><a href="./signup.php" class="link">Register</a></li>
                    <?php
                    }
                    ?>
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
                    <?php
                    if ($operator === "seller") {
                    ?>
                        <li class="menu-item"><a href="./sellerDashboard.php" class="link">Home</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="menu-item"><a href="./index.html#" class="link">Home</a></li>
                    <?php
                    }
                    ?>
                    <li class="menu-item"><a href="./index.html#contact-us" class="link item-hidden">Contact us</a></li>
                    <li class="menu-item"><a href="./index.html#about-us" class="link item-hidden">About us</a></li>
                    <li class="menu-item"><a href="./post.php#clothing&apparels" class="link">Clothing & Apparels</a>
                    </li>
                    <li class="menu-item"><a href="./post.php#furniture" class="link">Furniture</a></li>
                    <li class="menu-item"><a href="./post.php#gas-services" class="link">Gas Services</a></li>
                    <li class="menu-item"><a href="./post.php#health" class="link">Health Services</a></li>
                    <li class="menu-item"><a href="./post.php#beauty&cosmetics" class="link">Beauty & Cosmetics</a></li>
                    <li class="menu-item"><a href="./post.php#bookshop&stationary" class="link">BookShops &
                            Stationaries</a></li>
                    <li class="menu-item"><a href="./post.php#general-stores" class="link">General Stores</a></li>
                    <li class="menu-item"><a href="./post.php#households" class="link">HouseHolds</a></li>
                    <li class="menu-item"><a href="./post.php#hardware" class="link">Hardware</a></li>
                    <li class="menu-item"><a href="./post.php#electronics" class="link">Electronics</a></li>
                    <li class="menu-item"><a href="./post.php#beddings" class="link">Beddings</a></li>
                    <li class="menu-item"><a href="./post.php#hairdressing" class="link">Hairdressing</a></li>
                    <li class="menu-item"><a href="./post.php#haircut" class="link">Haircut</a></li>
                    <?php
                    if ($operator === "seller") {
                    ?>
                        <li class="menu-item">
                            <a href="./my_profile.php" class="link"><i class="#"></i>My Profile</a>
                        </li>
                        <li class="menu-item">
                            <a href="./setPassword.php" class="link"><i class="#"></i>Update Password</a>
                        </li>
                        <li class="menu-item"><a href="./logout.php" class="link item-hidden">Logout</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="menu-item"><a href="./login.html" class="link item-hidden">Login</a></li>
                        <li class="menu-item"><a href="./signup.php" class="link item-hidden">Register</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    <!--Search form-->
    <div class="search-form-container container" id="search-form-container">
        <div class="container-inner">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form">
                <input type="hidden" name="operator" value="<?php echo htmlspecialchars($operator); ?>">
                <input type="search" name="keyword" id="keyword" class="form-input" placeholder="What are you looking for?">
                <button class="btn form-btn" type="submit">
                    <i class="ri-search-line"></i>
                </button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_GET['keyword'])) {

        $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
        $operator = $_GET['operator'];
        // Product search query
        $productQuery = "SELECT * FROM sellersProducts WHERE (Category LIKE '%$keyword%' OR ProductName LIKE '%$keyword%' OR Seller LIKE '%$keyword%');";


        // Service search query
        $serviceQuery = "SELECT * FROM sellersServices WHERE (ServiceType LIKE '%$keyword%' OR Seller LIKE '%$keyword%');";

        $productSql = mysqli_query($conn, $productQuery);
        $serviceSql = mysqli_query($conn, $serviceQuery);

        if (mysqli_num_rows($productSql) >= 1 && mysqli_num_rows($serviceSql) == 0) {
    ?>
            <section class="featured-items section">
                <div class="container">
                    <h2 class="title section-title" data-name="<?php echo $keyword . ' products' ?>">
                        <?php echo $keyword . ' products' ?>
                    </h2>
                    <div class="featured-items-container d-grid">
                        <?php
                        // Display products
                        while ($row = mysqli_fetch_assoc($productSql)) {
                        ?>
                            <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">

                                <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image ">
                                <div class="item-data-container">
                                    <div class="item-data">
                                        <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                        <span><?php echo $row['ProductDescription']; ?></span>
                                        <span> <?php echo $row['Seller']; ?></span>

                                    </div>
                                </div>
                            </a>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>

        <?php
        } elseif (mysqli_num_rows($productSql) == 0 && mysqli_num_rows($serviceSql) >= 1) {
        ?>
            <section class="featured-items section">
                <div class="container">
                    <h2 class="title section-title" data-name="<?php echo $keyword . ' services' ?>">
                        <?php echo $keyword . ' services' ?></h2>
                    <div class="featured-items-container d-grid">

                        <?php
                        // Display services
                        while ($row = mysqli_fetch_assoc($serviceSql)) {
                        ?>
                            <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                                <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                                <div class="item-data-container">
                                    <div class="item-data">
                                        <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                        <span><?php echo $row['ServiceDescription']; ?></span>
                                        <span> <?php echo $row['Seller']; ?></span>
                                    </div>
                                </div>
                            </a>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php
        } elseif (mysqli_num_rows($productSql) == 0 && mysqli_num_rows($serviceSql) == 0) {
            $message = "No such product or service found.";

        ?>
            <section class="featured-items section">
                <div class="container">
                    <h2 class="title section-title" data-name="<?php echo $message ?>">
                        <?php echo $message ?></h2>
                    <div class="featured-items-container d-grid">
                    </div>
                </div>
            </section>
        <?php
        } else {
        ?>
            <section class="featured-items section">
                <div class="container">
                    <h2 class="title section-title" data-name="<?php echo $keyword . ' products' ?>">
                        <?php echo $keyword . ' products' ?>
                    </h2>
                    <div class="featured-items-container d-grid">
                        <?php
                        // Display products
                        while ($row = mysqli_fetch_assoc($productSql)) {
                        ?>
                            <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">

                                <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image ">
                                <div class="item-data-container">
                                    <div class="item-data">
                                        <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                        <span><?php echo $row['ProductDescription']; ?></span>
                                        <span> <?php echo $row['Seller']; ?></span>

                                    </div>
                                </div>
                            </a>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <section class="featured-items section">
                <div class="container">
                    <h2 class="title section-title" data-name="<?php echo $keyword . ' services' ?>">
                        <?php echo $keyword . ' services' ?></h2>
                    <div class="featured-items-container d-grid">

                        <?php
                        // Display services
                        while ($row = mysqli_fetch_assoc($serviceSql)) {
                        ?>
                            <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                                <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                                <div class="item-data-container">
                                    <div class="item-data">
                                        <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                        <span><?php echo $row['ServiceDescription']; ?></span>
                                        <span> <?php echo $row['Seller']; ?></span>
                                    </div>
                                </div>
                            </a>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php
        }
    } else {

        ?>
        <!--Gas Services-->

        <section class="featured-items section" id="gas-services">
            <div class="container">
                <h2 class="title section-title" data-name="Gas Services">Gas services</h2>
                <div class="featured-items-container d-grid">
                    <?php

                    $category = 'Gas Services';

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $category = 'Clothing & Aparels';

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersProducts WHERE Category = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                    <span><?php echo $row['ProductDescription']; ?></span>
                                    <span> <?php echo $row['Seller']; ?></span>

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

                    $query = "SELECT * FROM sellersServices WHERE ServiceType = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                    <span> <?php echo $row['Seller']; ?></span>
                                    <span> <?php echo $row['ServiceDescription']; ?></span>
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

                    $query = "SELECT * FROM sellersServices WHERE ServiceType = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                    <span> <?php echo $row['Seller']; ?></span>
                                    <span> <?php echo $row['ServiceDescription']; ?></span>
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

                    $query = "SELECT * FROM sellersServices WHERE ServiceType = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                    <span> <?php echo $row['Seller']; ?></span>
                                    <span> <?php echo $row['ServiceDescription']; ?></span>
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

                    $query = "SELECT * FROM sellersServices WHERE ServiceType = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                    <span> <?php echo $row['Seller']; ?></span>
                                    <span> <?php echo $row['ServiceDescription']; ?></span>
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

                    $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Sellers.BusinessName AS Seller ,Services.ServiceDescription AS ServiceDescription,Services.image_path AS image_path FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                    <span> <?php echo $row['Seller']; ?></span>
                                    <span> <?php echo $row['ServiceDescription']; ?></span>
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

                    $query = "SELECT * FROM sellersServices WHERE ServiceType = '$category';";

                    $sql = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                        <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']); ?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item lazy">
                            <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                            <div class="item-data-container">
                                <div class="item-data">
                                    <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                    <span> <?php echo $row['Seller']; ?></span>
                                    <span> <?php echo $row['ServiceDescription']; ?></span>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php
    }
    ?>


    <!--NewsLetter-->
    <section class="newsletter section">
        <div class="container">
            <h2 class="title section-title" data-name="Newsletter">Newsletter</h2>
            <div class="form-container-inner">
                <h6 class="title newsletter-title">Subscribe to Kabarak<span class="tm">B2B</span></h6>
                <p class="newsletter-description">
                    Get our latest updates as soon as they are released.
                </p>
                <form action="./subscribe.php" class="form" method="post">
                    <input type="email" name="email" class="form-input" placeholder="Enter your email address">
                    <input type="hidden" name="page" value="post.php">
                    <button class="btn form-btn" type="submit" name="subscribe">
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
                    <?php
                    if ($operator === "seller") {
                    ?>
                        <a href="./sellerDashboard.php" class="link">
                            <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                        </a>
                    <?php
                    } else {
                    ?>
                        <a href="./index.html" class="link">
                            <h3 class="logo-name">Kabarak<span class="tm">B2B</span></h3>
                        </a>
                    <?php
                    }
                    ?>
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
                        <li class="list-item"> Email : <a
                                href="mailto:sangera@kabarak.ac.ke?bcc=lukelasharon02@gmail.com,maxwellwafula884@gmail.com,sharif@kabarak.ac.ke"
                                class="link" target="_blank">info@kabub2b.com</a>
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
                    <li class="list-item"><a href="./post.php#clothing&apparels" class="link">Clothing & Apparels</a></li>
                    <li class="list-item"><a href="./post.php#furniture" class="link">Furniture</a></li>
                    <li class="list-item"><a href="./post.php#gas-services" class="link">Gas Cylinders</a></li>
                    <li class="list-item"><a href="./post.php#health" class="link">Health Services</a></li>
                    <li class="list-item"><a href="./post.php#beauty&cosmetic" class="link">Beauty & Cosmetics</a></li>
                    <li class="list-item"><a href="./post.php#bookshop&stationary" class="link">BookShops & Stationaries</a></li>
                    <li class="list-item"><a href="./post.php#general-stores" class="link">General Stores</a></li>
                    <li class="list-item"><a href="./post.php#households" class="link">HouseHolds</a></li>
                    <li class="list-item"><a href="./post.php#hardware" class="link">Hardware</a></li>
                    <li class="list-item"><a href="./post.php#beddings" class="link">Beddings</a></li>
                    <li class="list-item"><a href="./post.php#electronics" class="link">Electronics</a></li>
                </ul>
            </div>

            <div>
                <h6 class="title footer-title">Services</h6>
                <ul class="list footer-list">
                    <li class="list-item"><a href="./post.php#health" class="link">Health</a></li>
                    <li class="list-item"><a href="./post.php#haircut" class="link">Haircut</a></li>
                    <li class="list-item"><a href="./post.php#hairdressing" class="link">Hairdressing</a></li>
                    <li class="list-item"><a href="./post.php#gas-services" class="link">Gas Refill</a></li>
                    <li class="list-item"><a href="./post.php#haircut" class="link">Beddings</a></li>
                    <li class="list-item"><a href="./post.php#electronics-repair" class="link">Electronics Repair</a></li>
                    <li class="list-item"><a href="./post.php#shoe-repair" class="link">Shoe Repair</a></li>
                    <li class="list-item"><a href="./post.php#carrier-services" class="link">Carrier Services</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
<script>
    function showSideBar() {
        document.querySelector('.hidden').style.display = 'block';
        document.querySelector('.sidebar-open-btn').style.display = 'none';
    }

    function hideSideBar() {
        document.querySelector('.hidden').style.display = 'none';
        document.querySelector('.sidebar-open-btn').style.display = 'block';
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Get all elements with the "lazy" class
        var lazyImages = document.querySelectorAll('.lazy');

        // Create an Intersection Observer
        var observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    // Load the image by setting the "src" attribute
                    entry.target.src = entry.target.dataset.src;

                    // Unobserve the element to stop observing once loaded
                    observer.unobserve(entry.target);
                }
            });
        });

        // Start observing lazy images
        lazyImages.forEach(function(image) {
            observer.observe(image);
        });
    });
</script>

</html>