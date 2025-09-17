<?php

$db_host = "";
$db_username = "";
$db_password = "";
$db_name = "";

$options = [
  PDO::ATTR_EMULATE_PREPARES => false, 
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
  $pdo->exec("SET time_zone = '-03:00'");
} 
catch (Exception $e) {
  exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
}
?>
