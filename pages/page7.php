<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Refresh: 3; URL=login.php?param=page7.php");
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
if ($databaseUrl) {
    $db = parse_url($databaseUrl);
    $host = $db['host'];
    $port = $db['port'];
    $user = $db['user'];
    $password = $db['pass'];
    $dbname = ltrim($db['path'], '/');
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} else {
    exit("DATABASE_URL not set");
}

if (isset($_GET['ajax']) && isset($_GET['term'])) {
    $term = trim($_GET['term']) . '%';
    $stmt = $pdo->prepare("SELECT CONCAT(imie, ' ', nazwisko) AS fullname 
                           FROM osoby 
                           WHERE imie LIKE :term OR nazwisko LIKE :term 
                           COLLATE utf8mb4_general_ci 
                           LIMIT 10");
    $stmt->bindParam(':term', $term, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array_column($results, 'fullname'));
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciekawa wyszukiwarka</title>
    <style>
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
        background-color: #E9EBDC;
    }

    .container {
        text-align: center;
        position: relative;
    }

    h2 {
        color: #3B3B98;
        margin-bottom: 30px;
    }

    .search-container {
        display: inline-flex;
        align-items: center;
        position: relative;
    }

    input[type="text"] {
        padding: 8px;
        width: 400px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        box-shadow: 0 2px 4px #3B3B98;
    }

    input[type="text"]:focus {
    border: 2px solid #3B3B98; 
    outline: none;
}

    #loader {
        display: none;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3B3B98;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        position: absolute;
        right: -30px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    #suggestions {
        border: 1px solid #ddd;
        background-color: white;
        position: absolute;
        width: 100%; 
        top: 100%; 
        left: 0; 
        display: none;
        z-index: 1000;
        box-shadow: 0 4px 8px #3B3B98;
        max-height: 200px;
        overflow-y: auto;
        text-align: left;
    }

    .suggestion {
        padding: 10px;
        cursor: pointer;
    }

    .suggestion:hover {
        background-color: #f0f0f0;
    }
    .back-link {
    position: absolute;
    align-items: center;
    width: fit-content;
    margin: 20px auto;
    margin-left: auto;
    margin-right: auto;
    font-size: 1.1em;
    color: #3B3B98;
    text-decoration: none;
    margin-top: 200px;
}

.back-link:hover {
    text-decoration: underline;
}
</style>

</head>
<body>
    <div class="container">
        <h2>Wyszukiwarka z bazy danych</h2>
        <div class="search-container">
            <input type="text" id="searchBox" placeholder="Wpisz imię lub nazwisko..." autocomplete="off">
            <div id="loader"></div>
        </div>
        <div id="suggestions"></div>
    </div>
    <a class="back-link" href="../index.html">Wróć na stronę główną!</a>

    <script>
        const searchBox = document.getElementById("searchBox");
        const suggestionsBox = document.getElementById("suggestions");
        const loader = document.getElementById("loader");

        searchBox.addEventListener("input", function () {
            const query = this.value.trim();

            if (query.length > 0) {
                loader.style.display = "block"; 
                fetch(`?ajax=1&term=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        loader.style.display = "none"; 
                        suggestionsBox.innerHTML = "";
                        if (data.length > 0) {
                            suggestionsBox.style.display = "block";
                            data.forEach(item => {
                                const div = document.createElement("div");
                                div.textContent = item;
                                div.classList.add("suggestion");
                                div.addEventListener("click", function () {
                                    searchBox.value = item;
                                    suggestionsBox.style.display = "none";
                                });
                                suggestionsBox.appendChild(div);
                            });
                        } else {
                            suggestionsBox.style.display = "none";
                        }
                    })
                    .catch(() => {
                        loader.style.display = "none";
                        suggestionsBox.style.display = "none";
                    });
            } else {
                suggestionsBox.style.display = "none";
                loader.style.display = "none";
            }
        });

        document.addEventListener("click", function (e) {
            if (!suggestionsBox.contains(e.target) && e.target !== searchBox) {
                suggestionsBox.style.display = "none";
            }
        });
    </script>
</body>
</html>
