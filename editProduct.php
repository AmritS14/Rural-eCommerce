<?php
include 'includes/config.php';

if (!isset($_SESSION['seller_id'])) {
    header('Location: login.php');
    exit();
}

$product_id = $_GET['id'] ?? null;
if (!$product_id) {
    echo "<script>alert('Invalid product ID.'); window.location='sellerDashboard.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    if ($name && $category && $price > 0 && $stock >= 0) {
        $query = "UPDATE products SET name = ?, type = ?, price = ?, stock = ? WHERE id = ? AND seller_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssdiii', $name, $category, $price, $stock, $product_id, $_SESSION['seller_id']);

        if ($stmt->execute()) {
            echo "<script>alert('Product updated successfully!'); window.location='sellerDashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to update product. Please try again.'); window.location='editProduct.php?id=$product_id';</script>";
        }
    } else {
        echo "<script>alert('All fields are required and must be valid.'); window.location='editProduct.php?id=$product_id';</script>";
    }
} else {
    $query = "SELECT * FROM products WHERE id = ? AND seller_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $product_id, $_SESSION['seller_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "<script>alert('Product not found or you do not have permission to edit this product.'); window.location='sellerDashboard.php';</script>";
        exit();
    }
}

// Ensure $product is not null before accessing its properties
$name = htmlspecialchars($product['name'] ?? '');
$type = htmlspecialchars($product['type'] ?? '');
$price = htmlspecialchars($product['price'] ?? 0);
$stock = htmlspecialchars($product['stock'] ?? 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Edit Product</h1>
        <form method="POST" action="editProduct.php?id=<?php echo $product_id; ?>">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="handicrafts" <?php echo $type === 'handicrafts' ? 'selected' : ''; ?>>Handicrafts</option>
                    <option value="fresh-produce" <?php echo $type === 'fresh-produce' ? 'selected' : ''; ?>>Fresh Produce</option>
                    <option value="livestock" <?php echo $type === 'livestock' ? 'selected' : ''; ?>>Livestock</option>
                    <option value="tools" <?php echo $type === 'tools' ? 'selected' : ''; ?>>Tools</option>
                    <option value="clothing" <?php echo $type === 'clothing' ? 'selected' : ''; ?>>Clothing</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $price; ?>" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>
</html>
