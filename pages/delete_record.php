<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $databaseUrl = getenv("DATABASE_URL");

    if ($databaseUrl) {
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

            $sql = "DELETE FROM osoby WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $id = $_GET['delete'];

            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            header("Location: page6.php");
        } catch (PDOException $e) {
            exit("Database error: " . $e->getMessage());
        }
    } else {
        exit("DATABASE_URL not set");
    }
}
?>