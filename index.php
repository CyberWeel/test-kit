<?php
# Подключение базы данных
# require_once $_SERVER['DOCUMENT_ROOT'].'/pdo.php';

function load_users_data($user_ids) {
  $user_ids = explode(',', $user_ids);
  foreach ($user_ids as $user_id) {
      $db = mysqli_connect("localhost", "root", "123123", "database");
      $sql = mysqli_query($db, "SELECT * FROM users WHERE id=$user_id");
      while($obj = $sql->fetch_object()){
          $data[$user_id] = $obj->name;
      }
      mysqli_close($db);
  }
  return $data;
}

$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id=>$name) {
  echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}
# По мне так лучше использовать PDO для безопасности
# Вывод нужно очистить

# Указать ожидаемый тип
# Подключение снаружи. Верный ли порядок данных?
# Проверить все строки
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Главная страница</title>
</head>
<body>

</body>
</html>
