<?php
header("Content-Type: text/html; charset=UTF-8");

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Грешка при свързване: " . $conn->connect_error);
}

// Отваряне на масив от POST
var_dump($_POST);

$name    = $_POST['name'] ?? '';
$age     = (int)($_POST['age'] ?? 0);
$hobbies = $_POST['hobbies'] ?? [];

$music  = in_array("music", $hobbies) ? 1 : 0;
$cinema = in_array("cinema", $hobbies) ? 1 : 0;
$sports = in_array("sports", $hobbies) ? 1 : 0;

$sql = "INSERT INTO users_stats (name, age, music, cinema, sports) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Грешка при подготовка на заявката: " . $conn->error);
}

$stmt->bind_param("siiii", $name, $age, $music, $cinema, $sports);

if ($stmt->execute()) {
    echo "✅ Данните бяха записани успешно!<br>";
} else {
    echo "❌ Грешка при изпълнение: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
