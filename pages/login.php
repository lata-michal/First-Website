<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Refresh: 10; URL=../index.html");
    ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Ciekawe zalogowanko</title>
	<link rel="stylesheet" href="../styles.css">
	<style>
		body {
			font-size: 1em
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="header">Jesteś zalogowany!</h2>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="border: 0px;box-shadow: 0px 0px 0px; padding: 0px;">
				<a href="logout.php" class="back-link-index">Wyloguj się!</a>
			</div>	
            <div class="content-item" style="border: 0px;box-shadow: 0px 0px 0px; padding: 0px;">
				<a href="../index.html" class="back-link-index">Wróć na stronę główną!</a>
			</div>	
        </div>
	</div>
</body>

</html>
    <?php
    exit;
}

if(isset($_GET['param']))
{
    $param = $_GET['param'];
}
else 
{
    $param = "../index.html";
}

if($_SERVER['REQUEST_METHOD']==='POST') {
    $hardcoded_username = "admin";
    $hardcoded_password = "1da1231!9r83ms";

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $hardcoded_username && $password === $hardcoded_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("Location: " . $_POST['loc']);
        exit;
    } else {
        header("Refresh: 3; URL=login.php");
        ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Ciekawe złe logowanka</title>
	<link rel="stylesheet" href="../styles.css">
	<style>
		body {
			font-size: 1em
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="header">Złe dane logowania! Za chwilę spróbuj ponownie.<h2>
	</div>
</body>

</html>
        <?php
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ciekawe logowanie</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1 class="header">Ciekawe logowanie</h1>
        <div class="form-container">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="fname">Podaj login:</label>
                    <input type="text" id="username" name="username" value ="admin" required>
                </div>
                <div class="form-group">
                    <label for="password">Podaj hasło:</label>
                    <input type="password" id="password" name="password" value="1da1231!9r83ms" required>
                    <input type="hidden" name="loc" value="<?php echo $param; ?>">
                </div>
                <div class="form-submit">
                    <input type="submit" value="Zaloguj się">
                </div>
            </form>
            <a class="back-link" href="../index.html">Wróć na stronę główną!</a>
        </div>
    </div>
</body>

</html>