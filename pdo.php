<?php
# Вообще, такой файл желательно хранить рядом с корневой директорией сайта,
# а не в ней (для безопасности), но для простоты я разместил его здесь

$connection = new PDO('mysql:host=localhost;port=3306;dbname=test_kit', 'root', '');
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
