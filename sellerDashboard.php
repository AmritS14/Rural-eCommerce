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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Welcome to Your Dashboard</h1>
        <a href="addProduct.php" class="btn btn-primary mb-3">Add New Product</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['type'] === 'handicrafts' ? 'Handicrafts' : ($row['type'] === 'fresh-produce' ? 'Fresh Produce' : ($row['type'] === 'livestock' ? 'Livestock' : ($row['type'] === 'tools' ? 'Tools' : ($row['type'] === 'clothing' ? 'Clothing' : $row['type']))))); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                        <td>
                            <a href="editProduct.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="deleteProduct.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
