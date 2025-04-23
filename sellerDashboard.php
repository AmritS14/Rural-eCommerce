<?php
// Seller Dashboard
include 'includes/config.php';
if (!isset($_SESSION['seller_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch seller's products
$seller_id = $_SESSION['seller_id'];
$query = "SELECT * FROM products WHERE seller_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $seller_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="css/flexslider.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script src="common.js"></script>
</head>
<body class="tm-gray-bg">
<!-- Header -->
<div class="tm-header">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3 tm-site-name-container">
                <a href="index.php" class="tm-site-name">Simplikart</a>
            </div>
            <div class="col-md-8 col-sm-9">
                <div class="mobile-menu-icon">
                    <i class="fa fa-bars"></i>
                </div>
                <nav class="tm-nav">
                    <ul>
                        <!-- <li><a href="index.php">Home</a></li>
                        <li><a href="products.php">All Products</a></li> -->
                        <li class="dropdown" style="right: 0; position: fixed;">
                            <a href="#" class="dropdown-toggle">
                                Welcome, <?= $_SESSION['user'] ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" style="height: auto;">
                                <li><a href="logout.php" class="tm-logout" style="color: darkred;">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="container tm-home-section-1" id="more" style="top: 60px; margin-bottom: 115px;">
    <div class="row" style="margin-top: 45px">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="tm-home-box-1">
                <div class="tm-white-bg">
                    <div class="tm-search-box effect2">
                        <a href="addProduct.php" class="tm-yellow-btn" style="margin-bottom: 20px; display: inline-block;">Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-margin-top">
        <div class="row">
            <div class="tm-section-header">
                <div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
                <div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Your Products</h2></div>
                <div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
            </div>
        </div>

        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
                    <div class="tm-home-box-2 tm-home-box-2-right">
                        <div class="product-image">
                            <img style="object-fit: cover; height: 100%; width: 100%" src="img/products/<?= htmlspecialchars($row['img']) ?>" alt="image" class="img-responsive">
                        </div>
                        <h3><?= htmlspecialchars($row['name']) ?></h3>
                        <p class="tm-date">Category: <?= htmlspecialchars($row['type']) ?></p>
                        <p class="tm-date">Price: Rs. <?= htmlspecialchars($row['price']) ?></p>
                        <p class="tm-date">Stock: <?= htmlspecialchars($row['stock']) ?></p>
                        <div class="tm-home-box-2-container">
                            <a href="editProduct.php?id=<?= $row['id'] ?>" class="tm-home-box-2-link" style="width: 48%; display: inline-block;">Edit</a>
                            <a href="deleteProduct.php?id=<?= $row['id'] ?>" class="tm-home-box-2-link" style="width: 48%; display: inline-block; color: darkred;">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<footer class="tm-black-bg main-footer">
    <div class="container">
        <div class="row">
            <p class="tm-copyright-text">Copyright &copy; 2024 Digital Enigma</p>
        </div>
    </div>
</footer>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="js/templatemo-script.js"></script>
<script>
    // Adjust the dropdown menu to be less sensitive by adding a delay for hover and ensuring proper padding.
    $(document).ready(function() {
        $('.dropdown').hover(
            function() {
                $(this).addClass('open');
            },
            function() {
                setTimeout(() => {
                    $(this).removeClass('open');
                }, 200); // Add a slight delay before closing
            }
        );

        // Ensure clicking outside the dropdown closes it
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.dropdown').length) {
                $('.dropdown').removeClass('open');
            }
        });
    });
</script>
</body>
</html>
