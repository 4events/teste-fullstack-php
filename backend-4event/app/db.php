<?php

// Configurando a conexão com o banco de dados
function connect()
{
  $server = "db";
  $user = "root";
  $password = "root";
  $db = "4Events-backend";

  try {
    $pdo = new \PDO("mysql:host=$server;dbname=$db", $user, $password);
    return $pdo;
  } catch (PDOException $e) {
    echo $e->getMessage();
    return null;
  }
}
