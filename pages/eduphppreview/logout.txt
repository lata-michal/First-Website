<?php
session_start();

$_SESSION = [];
session_destroy();

header("Refresh: 5; URL=../index.html");

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Ciekawe wylogowywanko</title>
	<link rel="stylesheet" href="../styles.css">
	<style>
		body {
			font-size: 1em
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="header">Nastąpiło wylogowanie! Za chwilę zostaniesz przekierowany na stronę główną.</h2>
	</div>
</body>

</html>
<?php
    exit;
?>