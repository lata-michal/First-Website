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

            $sql = "INSERT INTO osoby (imie, nazwisko, wiek) VALUES (:imie, :nazwisko, :wiek)";
            $stmt = $pdo->prepare($sql);

            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $wiek = $_POST['wiek'];

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