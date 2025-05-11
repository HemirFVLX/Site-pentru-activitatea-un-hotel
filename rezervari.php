<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style1.css">
  <title>Rezervari</title>
</head>
<body>
  <?php
    @ $db = new mysqli('localhost', 'webuser', 'webuser', 'agentie');
    if (mysqli_connect_errno()) {
      echo 'Eroare! Conectarea la baza de date nu a reusit!';
      exit;
    }
    $q1 = "select password from admin where username = 'adminuser'";
    $r = $db->query($q1);
    if ($r->num_rows > 0) {
       while ($row = $r->fetch_assoc()) {
            $password = $row['password'];
        }
    }   else {
        echo "Eroare: " . $q1 . "<br>" . $db->error;
    }
  
    if (isset($_SESSION['username']) && $_SESSION['username'] == 'adminuser' && $_SESSION['password'] == $password) {
      echo '<h1>Rezervari</h1>';
      $query = "SELECT * FROM rezervari";
      $result = $db->query($query);

      if ($result->num_rows > 0) {
        echo '<form action="sterge_rezervari.php" method="post">
        <br/>';
        echo '<table border="1" cellpadding="5" cellspacing="0" style="width: 80%;">';
        echo '<tr><th>Nr. camera</th><th>Nume client</th><th>Email client</th><th>Telefon</th><th>Data checkin</th><th>Data checkout</th><th>Sterge</th></tr>';
        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row['nr_camera'] . '</td>';
          echo '<td>' . $row['nume'] . '</td>';
          echo '<td>' . $row['email'] . '</td>';
          echo '<td>' . $row['tel'] . '</td>';
          echo '<td>' . $row['data_checkin'] . '</td>';
          echo '<td>' . $row['data_checkout'] . '</td>';
          echo '<td><input type="checkbox" name="sterge[]" value="' . $row['id_rezervare'] . '"></td>';
          echo '</tr>';
        }
        echo '</table>
        </br>
        <input type="submit" value="Sterge">
        </form>';
      } else {
        echo 'Nu exista rezervari in acest moment.';
      }
    } else {
      echo '<h1>Acces nepermis</h1>';
      echo '<p>Nu sunteti autorizat sa vizionati aceasta pagina</p>';
    }
    $db->close();
  ?>
</body>
</html>