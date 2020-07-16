<?php
# Подключение базы данных
# require_once $_SERVER['DOCUMENT_ROOT'].'/pdo.php';

$url = 'https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3';
$url = cleanURL($url);

function cleanURL(string $url) :string {
  $url = parse_url($url);
  $protocol = $url['scheme'];
  $host = $url['host'];
  $path = $url['path'];
  $query = $url['query'];
  $workingQuery = [];
  $tempQuery = [];

  # Очищаем строку запроса от параметров со значением 3
  foreach (explode('&', $query) as $pair) {
    $param = explode('=', $pair);

    if ($param[1] != 3) {
      $workingQuery += [$param[0] => $param[1]];
    }
  }

  # Сортируем значения
  asort($workingQuery);

  # Формируем строку запроса заново
  foreach ($workingQuery as $key => $value) {
    array_push($tempQuery, $key.'='.$value);
  }

  $query = $protocol.'://'.$host.'/?';
  $query .= implode('&', $tempQuery);
  $query .= '&url='.urlencode($path);

  # Надо было сделать тут header("Location: $protocol://$host/") ?

  return htmlspecialchars($query);
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
