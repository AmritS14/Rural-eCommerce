<?php
include("includes/config.php");

$pid = $_GET['id'];
$sql = "DELETE FROM products WHERE id = $pid";
$result = mysqli_query($conn, $sql);
header("location: sellerDashboard.php");
?>
