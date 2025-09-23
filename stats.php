<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Грешка при свързване: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>

<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="UTF-8">
  <title>Статистика</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form-container">
    <h2>Статистика</h2>

    <?php

    $sql = "SELECT AVG(age) AS avg_age FROM users_stats";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        echo "<p><strong>Средна възраст:</strong> " . round($row['avg_age'], 1) . " години</p>";
    }

    echo "<h3>Потребители по възрастови групи</h3>";
    $sql = "
      SELECT 
        CASE 
          WHEN age < 18 THEN 'Под 18'
          WHEN age BETWEEN 18 AND 29 THEN '18-29'
          WHEN age BETWEEN 30 AND 44 THEN '30-44'
          WHEN age BETWEEN 45 AND 59 THEN '45-59'
          ELSE '60+'
        END AS age_group,
        COUNT(*) AS users_count
      FROM users_stats
      GROUP BY age_group
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>{$row['age_group']}:</strong> {$row['users_count']} потребители</li>";
        }
        echo "</ul>";
    }

    echo "<h3>Хобита</h3>";
    $sql = "SELECT SUM(music) AS total_music, SUM(cinema) AS total_cinema, SUM(sports) AS total_sports FROM users_stats";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        echo "<ul>";
        echo "<li><strong>Музика:</strong> " . $row['total_music'] . "</li>";
        echo "<li><strong>Кино:</strong> " . $row['total_cinema'] . "</li>";
        echo "<li><strong>Спорт:</strong> " . $row['total_sports'] . "</li>";
        echo "</ul>";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>