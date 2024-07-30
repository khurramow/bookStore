<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kitoblar ro'yxati</title>
</head>
<body>
<div class="container">
    <h1>Kitoblar ro'yxati</h1>
    <div class="books">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="book">
                <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
                <h2><?= $row['title'] ?></h2>
                <p>Muallif: <?= $row['author'] ?></p>
                <p>Narxi: $<?= $row['price'] ?></p>
                <a href="book_details.php?id=<?= $row['id'] ?>">Batafsil</a>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="cart.php">Savatga o'tish</a>
    <a href="logout.php">Chiqish</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
