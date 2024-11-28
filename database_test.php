<?php

$databaseUrl = getenv("DATABASE_URL");

if ($databaseUrl) {
    // Rozbicie URL na składniki
    $db = parse_url($databaseUrl);

    $host = $db['host'];
    $port = $db['port'];
    $user = $db['user'];
    $password = $db['pass'];
    $dbname = ltrim($db['path'], '/');

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        echo "Connected to MySQL Managed Database!";
    } catch (PDOException $e) {
        die("Error connecting to the database: " . $e->getMessage());
    }
} else {
    die("DATABASE_URL not set");
}

?>