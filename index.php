<?php
# Подключение базы данных
require_once $_SERVER['DOCUMENT_ROOT'].'/pdo.php';

$gender = 2;
$minAge = 18;
$maxAge = 22;
$minAgeTimestamp = $minAge * 365 * 24 * 60 * 60;
$maxAgeTimestamp = $maxAge * 365 * 24 * 60 * 60;

/* Просто возвращение строк с девушками
$sql = "SELECT *
  FROM users, phone_numbers
  WHERE users.gender = $gender
    AND (((NOW() - users.birth_date) >= $minAgeTimestamp)
      OR ((NOW() - users.birth_date) <= $maxAgeTimestamp))";
*/

$sql = "SELECT users.name, COUNT(phone_numbers.user_id) as quantity
  FROM users, phone_numbers
  WHERE users.id = phone_numbers.user_id
    AND users.gender = $gender
    AND (((NOW() - users.birth_date) >= $minAgeTimestamp)
      OR ((NOW() - users.birth_date) <= $maxAgeTimestamp))
  GROUP BY phone_numbers.user_id";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Главная страница</title>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>Имя</th>
        <th>Количество телефонных номеров</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($connection->query($sql) as $row) {
        echo '<tr>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$row['quantity'].'</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</body>
</html>
