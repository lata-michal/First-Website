<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Refresh: 3; URL=login.php?param=page6.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Ciekawe niezalogowanko</title>
	<link rel="stylesheet" href="../styles.css">
	<style>
		body {
			font-size: 1em
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="header">Nie jesteś zalogowany! Za chwilę zostaniesz przekierowany na stronę logowania.</h2>
	</div>
</body>

</html>
<?php
    exit;
}

$databaseUrl = getenv("DATABASE_URL");

if ($databaseUrl) 
{
    $db = parse_url($databaseUrl);

    $host = $db['host'];
    $port = $db['port'];
    $user = $db['user'];
    $password = $db['pass'];
    $dbname = ltrim($db['path'], '/');

    try 
    {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $stmt = $pdo->query("SELECT * FROM osoby");
        $osoby = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $editingId = $_GET['edit'] ?? null;
        $nextId = 1;
    }
     catch (PDOException $e) 
    {
        exit("Database error: " . $e->getMessage());
    }
} 
else
{
    exit("DATABASE_URL not set");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Ciekawe wyświetlanie</title>
	<link rel="stylesheet" href="../styles.css">
	<style>
		body {
			font-size: 0.85em
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="header">Ciekawa wizualizacja bazy danych</h2>
		<div class="content-grid-vertical-index">
            <?php foreach ($osoby as $osoba): ?>
                <?php $nextId = $osoba['id'] >= $nextId ? $osoba['id'] + 1 : $nextId ?>
                <?php if ($editingId == $osoba['id']): ?>
                    <div class="content-item" style="text-align:center; padding: 2px; color: #3B3B98; font-size: 1.15em">  
                        <form action = "edit_record.php" method="post" style="display: inline-block">
                            Id: <input type="number" name="id" value="<?= htmlspecialchars($osoba['id']) ?>" readonly style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Imię: <input type="text" name="imie" value="<?= htmlspecialchars($osoba['imie']) ?>" required style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Nazwisko: <input type="text" name="nazwisko" value="<?= htmlspecialchars($osoba['nazwisko']) ?>" required style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Wiek: <input type="number" name="wiek" value="<?= htmlspecialchars($osoba['wiek']) ?>" required style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            <div class = "form-submit" style="display: inline-block; margin: 0px;">
                                <input type="submit" value="Zmień" style="margin: 1px; padding: 3px 11px; border-radius: 4px">
                            </div>
                        </form>
                        <form action="page6.php" method="get" class ="form-submit" style="display: inline-block; margin: 0px">
                            <input type="submit" value="Anuluj" style="margin: 1px; padding: 3px 10px; border-radius: 4px">
                        </form>
                    </div>
                <?php else: ?>
                    <div class="content-item" style="text-align:center; padding: 2px; color: #3B3B98; font-size: 1.15em">  
                        <form action = "" method="get" style="display: inline-block">
                            Id: <input type="number" name="id" value="<?= htmlspecialchars($osoba['id']) ?>" disabled style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Imię: <input type="text" name="imie" value="<?= htmlspecialchars($osoba['imie']) ?>" disabled style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Nazwisko: <input type="text" name="nazwisko" value="<?= htmlspecialchars($osoba['nazwisko']) ?>" disabled style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Wiek: <input type="number" name="wiek" value="<?= htmlspecialchars($osoba['wiek']) ?>" disabled style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                        </form>
                        <form action="" method="get" class ="form-submit" style="display: inline-block; margin: 0px; ">
                            <input type="hidden" name="edit" value="<?= htmlspecialchars($osoba['id']) ?>">
                            <input type="submit" value="Edytuj" style="margin: 1px; padding: 3px 10px; border-radius: 4px">
                        </form>
                        <form action="delete_record.php" method="get" class ="form-submit" style="display: inline-block; margin: 0px; ">
                            <input type="hidden" name="delete" value="<?= htmlspecialchars($osoba['id']) ?>">
                            <input type="submit" value="Usuń" style="margin: 1px; padding: 3px 14px; border-radius: 4px">
                        </form>
			        </div>	
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="content-item" style="text-align:center; padding: 2px; color: #3B3B98; font-size: 1.15em">  
                        <form action = "insert_record.php" method="post" style="display: inline-block">
                            Id: <input type="number" name="id" value="<?= htmlspecialchars($nextId )?>" disabled style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Imię: <input type="text" name="imie" required style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Nazwisko: <input type="text" name="nazwisko" required style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            Wiek: <input type="number" name="wiek" required style="background-color:#E9EBDC; border: 1px solid #3B3B98;">
                            <div class = "form-submit" style="display: inline-block; margin: 0px;">
                                <input type="submit" value="Dodaj" style="margin: 1px; padding: 3px 44px; border-radius: 4px">
                            </div>
                        </form>
			        </div>	
		</div>
		<a class="back-link" href="../index.html">Wróć na stronę główną!</a>
	</div>
</body>

</html>