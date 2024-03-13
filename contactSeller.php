<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Set cache headers for 1 week
header("Cache-Control: max-age=604800, public");

session_start();

include_once 'connect.php';

$seller = urldecode($_GET['seller']);
$price = urldecode($_GET['price']);
$service = urldecode($_GET['service']);
$image = urldecode($_GET['image_path']);
$description = urldecode($_GET['description']);
$category = urldecode($_GET['category']);

$query = "SELECT Telephone, WhatsAppNumber, Email FROM Sellers WHERE BusinessName = '$seller';";
$sql = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($sql)) {
    $telephone = $row['Telephone'];
    $whatsapp = $row['WhatsAppNumber'];
    $email = $row['Email'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KabarakB2B | Sellers Products & Services</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.min.css" rel="stylesheet">


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

        .contact-container {
            margin-top: 10%;
            justify-content: center;
            align-items: center;
            display: flex;
            background: url('<?php echo './' . $image; ?>') no-repeat;
            background-size: cover;
            background-position: center;
            transition: var(--tran-05);
        }

        .contact-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 12px;
            width: 50%;
            padding: 15px 20px;
            backdrop-filter: blur(15px);
            transition: var(--tran-05);

        }

        .contact-box h2 {
            white-space: nowrap;
            font-size: 2.6rem;
            color: var(--dark-color);
        }

        .contact-details {
            margin-top: .5rem;
            font-size: var(--font-size-md);
            line-height: 1.5rem;
            font-weight: 520;
            text-align: center;
            padding: 1.5rem 3rem;
        }

        .contact-details p {
            margin: 1rem auto;
        }

        .contact-options {
            margin-top: .5rem;
            padding: 1rem 3rem;
            gap: var(--gap);
            display: flex;
            flex-direction: row;
        }

        .contact-btn {
            font-size: 3rem;
            margin: auto;
            background: transparent;
            cursor: pointer;
            outline: none;
            border: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .text {
            font-size: .8rem;
        }

        @media screen and (max-width: 615px) {
            .contact-box {
                width: 100%;
            }

            .contact-box h2 {
                font-size: 2.4rem;
            }

            .contact-details {
                margin-top: 3rem;
                font-size: var(--font-size-m);
                line-height: 2rem;
                padding: 2rem 3rem;
            }

            .contact-options {
                margin-top: 1.5rem;
                padding: 1.5rem 2.5rem;
                gap: var(--gap-md);
            }

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
                    <li class="menu-item"><a href="./index.html#" class="link">Home</a></li>
                    <li class="menu-item"><a href="./index.html#contact-us" class="link">Contact us</a></li>
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
                    <li class="menu-item"><a href="./index.html" class="link item-hidden">Home</a></li>
                    <li class="menu-item"><a href="./index.html#contact-us" class="link item-hidden">Contact us</a></li>
                    <li class="menu-item"><a href="./index.html#about-us" class="link item-hidden">About us</a></li>
                    <li class="menu-item"><a href="./login.html" class="link item-hidden">Login</a></li>
                    <li class="menu-item"><a href="./signup.php" class="link item-hidden">Register</a></li>

                    <li class="menu-item"><a href="./post.php#clothing&apparels" class="link">Clothing & Apparels</a></li>
                    <li class="menu-item"><a href="./post.php#furniture" class="link">Furniture</a></li>
                    <li class="menu-item"><a href="./post.php#gas-services" class="link">Gas Services</a></li>
                    <li class="menu-item"><a href="./post.php#health" class="link">Health Services</a></li>
                    <li class="menu-item"><a href="./post.php#beauty&cosmetics" class="link">Beauty & Cosmetics</a></li>
                    <li class="menu-item"><a href="./post.php#bookshop&stationary" class="link">BookShops & Stationaries</a></li>
                    <li class="menu-item"><a href="./post.php#general-stores" class="link">General Stores</a></li>
                    <li class="menu-item"><a href="./post.php#households" class="link">HouseHolds</a></li>
                    <li class="menu-item"><a href="./post.php#hardware" class="link">Hardware</a></li>
                    <li class="menu-item"><a href="./post.php#electronics" class="link">Electronics</a></li>
                    <li class="menu-item"><a href="./post.php#beddings" class="link">Beddings</a></li>
                    <li class="menu-item"><a href="./post.php#hairdressing" class="link">Hairdressing</a></li>
                    <li class="menu-item"><a href="./post.php#haircut" class="link">Haircut</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="contact-container">
        <div class="contact-box">
            <h2>Contact Seller</h2>
            <div class="contact-details">
                <p>Service Type/Product Name:<br> <?php echo $service; ?></p>
                <p>Description: <br> <?php echo $description; ?></p>
                <p>Seller:<br> <?php echo $seller; ?></p>
                <p>Price:<br> <?php echo 'Ksh. ' . $price; ?></p>
            </div>
            <div class="contact-options">
                <button class="contact-btn" onclick="openWhatsApp()">
                    <i style="color: #66CD64;" class="ri-whatsapp-fill"></i>
                    <span class="text">WhatsApp</span>
                </button>
                <button class="contact-btn" onclick="sendEmail()">
                    <i style="color: #EA712E;" class="ri-mail-line"></i>
                    <span class="text">Email</span>
                </button>
                <button class="contact-btn" onclick="makeCall()">
                    <i style="color: #4692DD;" class="ri-phone-fill"></i>
                    <span class="text">Call</span>
                </button>
                <button class="contact-btn" onclick="sendSMS()">
                    <i style="color: #4692DD;" class="ri-message-2-fill"></i>
                    <span class="text">SMS</span>
                </button>
            </div>
        </div>
    </div>

    <!--You may also like--Other Products From the seller-->
    <section class="featured-items section" id="seller-products">
        <div class="container">
            <h2 class="title section-title" data-name="You may also like">You May Also Like</h2>
            <div class="featured-items-container d-grid">
                <?php

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path,Products.ProductDescription AS ProductDescription, Products.Category AS Category, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Sellers.BusinessName = '$seller'";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']);?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item">
                        <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span><?php echo $row['ProductDescription']; ?></span>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>

                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>

            <div class="featured-items-container d-grid">
                <?php

                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Services.image_path AS image_path, Services.ServiceDescription AS ServiceDescription, Sellers.BusinessName AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Sellers.BusinessName = '$seller';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']);?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item">
                        <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['ServiceDescription']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!--You may also like the service or Product From other sellers-->
    <section class="featured-items section" id="seller-products">
        <div class="container">
            <h2 class="title section-title" data-name="<?php echo $category . ' from other sellers'; ?>"><?php echo $category . ' From Other Sellers'; ?></h2>

            <div class="featured-items-container d-grid">
                <?php
                $query = "SELECT Services.ServiceType AS ServiceType, Services.Price AS Price,Services.image_path AS image_path, Services.ServiceDescription AS ServiceDescription, Sellers.BusinessName AS Seller FROM Sellers,Services,sellerServices WHERE Sellers.SellerID = sellerServices.SellerID AND Services.ServiceID = sellerServices.ServiceID AND Services.ServiceType = '$category' AND Sellers.BusinessName <> '$seller';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['ServiceType']);?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ServiceType']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ServiceDescription']); ?>" class="item">
                        <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ServiceType']; ?></h5>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['ServiceDescription']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>

            <div class="featured-items-container d-grid">
                <?php

                $query = "SELECT Products.ProductName AS ProductName, Products.Price AS Price, Products.Brand AS Brand, Products.image_path AS image_path, Products.Category AS Category, Products.ProductDescription AS ProductDescription, Sellers.BusinessName AS Seller FROM Sellers,Products,sellerProducts WHERE Sellers.SellerID = sellerProducts.SellerID AND Products.ProductID = sellerProducts.ProductID AND Products.Category = '$category' AND Sellers.BusinessName <> '$seller';";

                $sql = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($sql)) {
                ?>
                    <a href="./contactSeller.php?seller=<?php echo urlencode($row['Seller']); ?>&category=<?php echo urlencode($row['Category']);?>&price=<?php echo urlencode($row['Price']); ?>&service=<?php echo urlencode($row['ProductName']); ?>&image_path=<?php echo urlencode('./' . $row['image_path']); ?>&description=<?php echo urlencode($row['ProductDescription']); ?>" class="item">
                        <img src="<?php echo './' . $row['image_path']; ?>" alt="<?php echo $row['Seller']; ?>" class="item-image">
                        <div class="item-data-container">
                            <div class="item-data">
                                <h5 class="title item-title"><?php echo $row['ProductName']; ?></h5>
                                <span><?php echo $row['ProductDescription']; ?></span>
                                <span> <?php echo $row['Seller']; ?></span>
                                <span> <?php echo $row['Price']; ?></span>

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
                    <li class="list-item"><a href="./post.php#clothing&apparels" class="link">Clothing & Apparels</a></li>
                    <li class="list-item"><a href="./post.php#furniture" class="link">Furniture</a></li>
                    <li class="list-item"><a href="./post.php#gas-services" class="link">Gas Services</a></li>
                    <li class="list-item"><a href="./post.php#health" class="link">Health Services</a></li>
                    <li class="list-item"><a href="./post.php#beauty&cosmetic" class="link">Beauty & Cosmetics</a></li>
                    <li class="list-item"><a href="./post.php#bookshop&stationary" class="link">BookShops & Stationaries</a></li>
                    <li class="list-item"><a href="./post.php#general-stores" class="link">General Stores</a></li>
                    <li class="list-item"><a href="./post.php#households" class="link">HouseHolds</a></li>
                    <li class="list-item"><a href="./post.php#hardware" class="link">Hardware</a></li>
                    <li class="list-item"><a href="./post.php#beddings" class="link">Beddings</a></li>
                    <li class="list-item"><a href="./post.php#electronics" class="link">Electronics</a></li>
                    <li class="list-item"><a href="./post.php#hairdressing" class="link">Hairdressing</a></li>
                    <li class="list-item"><a href="./post.php#haircut" class="link">Beddings</a></li>
                    <li class="list-item"><a href="./post.php#electronics-repair" class="link">Electronics Repair</a></li>
                    <li class="list-item"><a href="./post.php#shoe-repair" class="link">Shoe Repair</a></li>
                    <li class="list-item"><a href="./post.php#carrier-services" class="link">Carrier Services</a></li>
                </ul>
            </div>

            <div>
                <h6 class="title footer-title" id="contact-us">Our Contacts</h6>
                <ul class="list footer-list">
                    <li class="list-item">Call: <a href="https://tel: +254797630228" class="link">0797630228</a></li>
                    <li class="list-item">WhatsApp: <a href="https://wa.me/+254797630228" class="link">AlphaTech Solutions</a></li>
                    <li class="list-item"> Email : <a href="mailto:sangera@kabarak.ac.ke?bcc=lukelasharon02@gmail.com,maxwellwafula@gmail.com,sharif@kabarak.ac.ke" class="link">info@kabub2b.com</a></li>
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

    function openWhatsApp() {

        window.location.href = 'https://wa.me/<?php echo $whatsapp; ?>';
    }

    function sendEmail() {

        window.location.href = 'mailto:<?php echo $email; ?>';
    }

    function makeCall() {

        window.location.href = 'tel:<?php echo $telephone; ?>';
    }

    function sendSMS() {
        window.location.href = 'sms:<?php echo $telephone; ?>';
    }
</script>

</html>