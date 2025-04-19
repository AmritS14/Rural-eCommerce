<?php
include 'includes/config.php';

if (!isset($_SESSION['seller_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $seller_id = $_SESSION['seller_id'];

    if ($name && $category && $price > 0 && $stock >= 0) {
        $query = "INSERT INTO products (name, type, price, stock, seller_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssdii', $name, $category, $price, $stock, $seller_id);

        if ($stmt->execute()) {
            echo "<script>alert('Product added successfully!'); window.location='sellerDashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to add product. Please try again.'); window.location='addProduct.php';</script>";
        }
    } else {
        echo "<script>alert('All fields are required and must be valid.'); window.location='addProduct.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Add New Product</h1>
        <form method="POST" action="addProduct.php">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="handicrafts">Handicrafts</option>
                    <option value="fresh-produce">Fresh Produce</option>
                    <option value="livestock">Livestock</option>
                    <option value="tools">Tools</option>
                    <option value="clothing">Clothing</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</body>
</html>
