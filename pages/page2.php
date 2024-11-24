<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
header("Refresh: 3; URL=login.php");
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
    <title>Ciekawy formularz</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1 class="header">Formularz zgłoszeniowy</h1>
        <div class="form-container">
            <form action="/action_page.php" method="post">
                <div class="form-group">
                    <label for="fname">Podaj imię:</label>
                    <input type="text" id="fname" name="fname" placeholder="Imię">
                </div>
                <div class="form-group">
                    <label for="lname">Podaj nazwisko:</label>
                    <input type="text" id="lname" name="lname" placeholder="Nazwisko">
                </div>
                <div class="form-group">
                    <label for="phonenumber">Podaj telefon:</label>
                    <input type="text" id="phonenumber" name="phonenumber" placeholder="Telefon">
                </div>
                <div class="form-group">
                    <label for="country">Podaj państwo:</label>
                    <input type="text" id="country" name="country" placeholder="Państwo">
                </div>
                <div class="form-group">
                    <label for="city">Podaj miasto:</label>
                    <input type="text" id="city" name="city" placeholder="Miasto">
                </div>
                <div class="form-group">
                    <label for="street">Podaj ulicę:</label>
                    <input type="text" id="street" name="street" placeholder="Ulica">
                </div>
                <div class="form-group">
                    <label for="building_number">Podaj numer budynku:</label>
                    <input type="text" id="building_number" name="building_number" placeholder="Numer budynku">
                </div>
                <div class="form-group">
                    <label for="apartment_number">Podaj numer lokalu:</label>
                    <input type="text" id="apartment_number" name="apartment_number" placeholder="Numer lokalu">
                </div>
                <div class="form-group">
                    <label for="birthdate">Podaj datę urodzenia:</label>
                    <input type="date" id="birthdate" name="birthdate">
                </div>
                <div class="form-group">
                    <label>Czy posiadasz prawo jazdy:</label>
                    <div class="radio-group">
                        <input type="radio" id="licenseYes" name="license" value="yes">
                        <label for="licenseYes">Tak</label>
                        <input type="radio" id="licenseNo" name="license" value="no">
                        <label for="licenseNo">Nie</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Wybierz płeć:</label>
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Mężczyzna</label>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Kobieta</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" placeholder="Hasło">
                </div>
                <div class="form-submit">
                    <input type="submit" value="Wyślij swoje zgłoszenie">
                </div>
            </form>
            <a class="back-link" href="../index.html">Wróć na stronę główną!</a>
        </div>
    </div>
</body>

</html>