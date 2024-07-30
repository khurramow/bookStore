<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$book_id = $_GET['id'];
$sql = "SELECT * FROM books WHERE id='$book_id'";
$result = $conn->query($sql);
$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $book['title'] ?></title>
</head>
<body>
<div class="container">
    <h1><?= $book['title'] ?></h1>
    <img src="<?= $book['image'] ?>" alt="<?= $book['title'] ?>">
    <p>Muallif: <?= $book['author'] ?></p>
    <p>Narxi: $<?= $book['price'] ?></p>
    <p>Tavsifi: <?= $book['description'] ?></p>
    <form action="cart.php" method="POST">
        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
        <button type="submit">Savatga qo'shish</button>
    </form>
    <a href="books.php">Orqaga qaytish</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
