<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    $sql = "INSERT INTO cart (user_id, book_id, quantity) VALUES ('$user_id', '$book_id', 1)";
    $conn->query($sql);
}

$sql = "SELECT books.id, books.title, books.price, cart.quantity FROM cart JOIN books ON cart.book_id = books.id WHERE cart.user_id = (SELECT id FROM users WHERE username = '".$_SESSION['username']."')";
$result = $conn->query($sql);

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Savat</title>
</head>
<body>
<div class="container">
    <h1>Savat</h1>
    <div class="cart-items">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="cart-item">
                <h2><?= $row['title'] ?></h2>
                <p>Narxi: $<?= $row['price'] ?></p>
                <p>Soni: <?= $row['quantity'] ?></p>
                <?php $total_price += $row['price'] * $row['quantity']; ?>
            </div>
        <?php endwhile; ?>
    </div>
    <h2>Jami narx: $<?= $total_price ?></h2>
    <button onclick="alert('Website to\'liq emas')">Sotib olish</button>
    <a href="books.php">Orqaga qaytish</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
