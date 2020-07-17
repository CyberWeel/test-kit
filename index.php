<?php
# Подключение базы данных
# require_once $_SERVER['DOCUMENT_ROOT'].'/pdo.php';

# По мне так лучше вынести подключеие к БД наружу, для безопасности
# и повышения эффективности, чтобы не подключаться-отключаться много раз
# А в идеале надо вынести параметры подключения в отдельный защищённый файл
$db = mysqli_connect("localhost", "root", "123123", "database");

$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id => $name) {
  # Неизвестно, чистили ли данные, когда вносили их в таблицу
  $name = htmlspecialchars($name);
  echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}

# После всех работ с БД нужно её закрыть
mysqli_close($db);

# Так как версия PHP не была указана, будем считать, что это PHP7+
/**
 * @param string $user_ids содержит id пользователей, указанных через запятую
 * @author CyberWeel
 * @return array, где id_пользователя => имя_пользователя
 */
function load_users_data(string $user_ids) :array {
  # Результаты $_GET лучше почистить
  $user_ids = htmlspecialchars($user_ids);

  $user_ids = explode(',', $user_ids);
  foreach ($user_ids as $user_id) {
    $sql = mysqli_query($db, "SELECT * FROM users WHERE id=$user_id");
    while($obj = $sql->fetch_object()) {
      $data[$user_id] = $obj->name;
    }
  }
  return $data;
}
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
