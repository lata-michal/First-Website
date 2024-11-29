<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

            $sql = "UPDATE osoby SET imie = :imie, nazwisko = :nazwisko, wiek = :wiek WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $id = $_POST['id'];
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $wiek = $_POST['wiek'];

            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":imie", $imie, PDO::PARAM_STR);
            $stmt->bindParam(":nazwisko", $nazwisko, PDO::PARAM_STR);
            $stmt->bindParam(":wiek", $wiek, PDO::PARAM_INT);

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