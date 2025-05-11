<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style1.css">
    <title>Hotelul Steaua Mica</title>
</head>
<body>
    <nav style="text-align:left">
        <a href="pagina_principala.php">Inapoi la pagina principala</a>
    </nav>
    <h1>Acces administrator</h1>
    <form action="login.php" method="post">
        <label for="username">Nume utilizator:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Parola:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Autentificare">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            @ $db = new mysqli('localhost', 'webuser', 'webuser', 'agentie');
            if (mysqli_connect_errno()) {
                echo 'Eroare! Conectarea la baza de date nu a reusit!';
                exit;
            }

            $username = $db->real_escape_string($_POST['username']);
            $password = sha1($db->real_escape_string($_POST['password']));

            $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
            $result = $db->query($query);

            if ($result->num_rows > 0) {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header("Location: pagina_principala.php");
                exit();
            } else {
                echo "<p style='color: red;'>Nume utilizator sau parola incorecta!</p>";
            }
            $db->close();
        }
    ?>
</body>
</html>