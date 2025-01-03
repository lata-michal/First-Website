<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Refresh: 3; URL=login.php?param=page3.php");
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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ciekawy kalkulator</title>
    <link rel="stylesheet" href="../styles.css">
    <script src="script.js" defer></script>
</head>

<body>
    <div class="container">
        <h2 class="header">Ciekawy Kalkulator</h2>
        <div class="calculator">
            <button class="clear-button" onclick="clearDisplay()">C</button>
            <input type="text" id="display" class="display" disabled>
            <div class="buttons">
                <button class="button" onclick="appendToDisplay('7')">7</button>
                <button class="button" onclick="appendToDisplay('8')">8</button>
                <button class="button" onclick="appendToDisplay('9')">9</button>
                <button class="button" onclick="appendToDisplay('/')">/</button>
                <button class="button" onclick="appendToDisplay('4')">4</button>
                <button class="button" onclick="appendToDisplay('5')">5</button>
                <button class="button" onclick="appendToDisplay('6')">6</button>
                <button class="button" onclick="appendToDisplay('*')">*</button>
                <button class="button" onclick="appendToDisplay('1')">1</button>
                <button class="button" onclick="appendToDisplay('2')">2</button>
                <button class="button" onclick="appendToDisplay('3')">3</button>
                <button class="button" onclick="appendToDisplay('-')">-</button>
                <button class="button" onclick="appendToDisplay('0')">0</button>
                <button class="button" onclick="appendToDisplay('.')">.</button>
                <button class="button" onclick="appendToDisplay('+')">+</button>
                <button class="button" onclick="calculateResult()">=</button>
            </div>
        </div>
        <a class="back-link" href="../index.html">Wróć na stronę główną!</a>
    </div>
</body>

</html>