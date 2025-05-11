<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style1.css">
  <style>
    input{
        background-color: #00278a;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
  </style>
  <title>Hotelul Steaua Mica</title>
</head> 
<body>
    <?php
        @ $db = new mysqli('localhost', 'webuser', 'webuser', 'agentie');
        if (mysqli_connect_errno()) {
            echo 'Eroare! Conectarea la baza de date nu a reusit!';
            exit;
        }
        $query = "select password from admin where username = 'adminuser'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $password = $row['password'];
            }
        } else {
            echo "Eroare: " . $query . "<br>" . $db->error;
        }
        
        $db->close();
        
        if (isset($_SESSION['username']) && $_SESSION['username'] == 'adminuser' && $_SESSION['password'] == $password) {
            echo '<p style="text-align:right">Acces administrator</p>';
            echo '<nav style="text-align:right">';
            echo '<a href="logout.php">Logout</a>';
            echo '</nav>';

        } else {
            echo '<nav style="text-align:right">';
            echo '<a href="login.php">Login</a>';
            echo '</nav>';
        }


    ?>
    <h1>Pagina principala</h1>
    <h2>Hotelul Steaua Mica</h2>
    <p>Hotelul este situat aproape de malul marii, numai bine pentru a va distra.
        Camerele sunt dotate cu aer conditionat, televizor, Wi-Fi gratuit, baie proprie si un
        mini-frigider.</p>
    <p>Hotelul ofera si un restaurant cu preparate traditionale romanesti, precum si mancaruri cu peste.</p>
    <p>Pentru a face o rezervare, trebuie sa completati un formular, iar plata se va face fizic.</p>
    <p>Va asteptam cu drag!</p>
    <form action="cauta_camere.html" method="get">
        <input type="submit" value="Cauta camere disponibile">
    </form>
    <?php
        if (isset($_SESSION['username']) && $_SESSION['username'] == 'adminuser' && $_SESSION['password'] == $password) {
            echo '<nav>';
            echo '<a href="rezervari.php">Vizualizare rezervari</a>';
            echo '</nav>';
        }
    ?>
    <nav>
        <a href="contact.html">Contact</a>
    </nav>
    <footer>
        <p>&copy; 2025 Hotelul Steaua Mica. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>