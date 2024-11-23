<?php
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$phonenumber = $_POST['phonenumber'] ?? ''; 
$country = $_POST['country'] ?? ''; 
$city = $_POST['city'] ?? ''; 
$street = $_POST['street'] ?? ''; 
$building_number = $_POST['building_number'] ?? ''; 
$apartment_number = $_POST['apartment_number'] ?? ''; 
$birthdate = $_POST['birthdate'] ?? ''; 
$license = $_POST['license'] ?? ''; 
$gender = $_POST['gender'] ?? ''; 
$password = $_POST['password'] ?? ''; 
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Michał Lata</title>
	<link rel="stylesheet" href="../styles.css">
	<style>
		body {
			font-size: 1em
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class="header">Dane podane w formularzu</h2>
		<div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Imię: <?php echo $fname; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Nazwisko: <?php echo $lname; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Numer telefonu: <?php echo $phonenumber; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Państwo: <?php echo $country; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Miasto: <?php echo $city; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Ulica: <?php echo $street; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Numer budynku: <?php echo $building_number; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Numer lokalu: <?php echo $apartment_number; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Data urodzenia: <?php echo $birthdate; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Czy posiada prawo jazdy?: <?php echo $license == "yes" ? "Tak" : "Nie"; ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Płeć: <?php
                if($gender == "male")
                {
                    echo "Mężczyzna"; 
                }
                else
                {
                    echo "Kobieta";
                }
                 ?>
			</div>	
		</div>
        <div class="content-grid-vertical-index">
			<div class="content-item" style="text-align:center">  
                Hasło: <?php echo $password; ?>
			</div>	
		</div>

	</div>
</body>

</html>
