<?php

function db_connect(){
  require_once('core/config.php');

  $dsn = "mysql:dbname={$dbname};host={$host};charset=utf8";
  // $user = 'root';
  // $password = 'root';
  $options = array(
    // PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    );
    // DBへ接続
    $pdo = new PDO($dsn, $user, $password, $options);
    return $pdo;
}
