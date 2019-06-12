<?php

$mysqlDb = getenv('MYSQL_DB');
if(!$mysqlDb) {
	die('No MYSQL_DB env var');
}

$mysqlHost = getenv('MYSQL_SERVER');
if(!$mysqlHost) {
	die('No MYSQL_SERVER env var');
}

$mysqlUser = getenv('MYSQL_USER');
if(!$mysqlUser) {
	die('No MYSQL_USER env var');
}

$mysqlPass = getenv('MYSQL_PASS');
if(!$mysqlPass) {
	die('No MYSQL_PASS env var');
}

$connectionStr = 'mysql:host='.$mysqlHost.';dbname='.$mysqlDb;
$conn = new PDO($connectionStr, $mysqlUser, $mysqlPass);


$file = __DIR__ . '/log.sql';
$qs = file_get_contents($file);
$qs = explode("\n", $qs);
foreach($qs as $q) {
  $stmt = $conn->prepare($q);
  if (!$stmt) {
      echo $q . "\n";
      echo "\nPDO::errorInfo():\n";
      print_r($conn->errorInfo());
      exit;
  }
  $stmt->execute();
  $result = $stmt->fetchAll();
  print_r($result);
}

