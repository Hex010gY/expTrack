<?php
declare(strict_types=1);
// db configuration file
$host = '*****';      // db host 
$db   = '*****';  // db name
$user = '*****';           // mysql usr
$pass = '*****';               // mysql pass
$charset = 'utf8mb4';

//--DSN
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO security and conn
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // errors exceptions 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // assoc array result
    PDO::ATTR_EMULATE_PREPARES   => false,                  // prepare statement conf as def
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // shit is happenning on connection 
    die('Database Connection Failed: ' . htmlspecialchars($e->getMessage()));

}
