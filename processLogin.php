<?php
include("includes/config.php");

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);

if ($numRows > 0)
{
    for ($i = 0; $i < $numRows; $i++)
    {
        $row = mysqli_fetch_assoc($result);
        if ($row['email'] == $email && $row['password'] == $password) {
            $_SESSION['passLogin'] = 'true';
            $_SESSION['user'] = $row['name'];
            $_SESSION['userId'] = $row['userId'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'seller') {
                $_SESSION['seller_id'] = $row['userId']; // Set seller_id for sellers
                header("Location: sellerDashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        }
    }

    $_SESSION['passLogin'] = 'false';
    echo "<script>alert('Wrong password'); window.location='login.php';</script>";
}
?>