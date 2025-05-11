<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style1.css">
  <title>Camere disponibile:</title>
</head>
<body>
  <h1>Camere disponibile</h1>
  <?php
      $year = $_POST['year'];
      $month1 = str_pad($_POST['month1'], 2, "0", STR_PAD_LEFT);
      $day1 = str_pad($_POST['day1'], 2, "0", STR_PAD_LEFT);
      $month2 = str_pad($_POST['month2'], 2, "0", STR_PAD_LEFT);
      $day2 = str_pad($_POST['day2'], 2, "0", STR_PAD_LEFT);

      $data1 = "$year-$month1-$day1";
      $data2 = "$year-$month2-$day2";

      echo "Camere disponibile intre $data1 si $data2: <br>";

      @ $db = new mysqli('localhost', 'webuser', 'webuser', 'agentie');
      if (mysqli_connect_errno()) 
      {
        echo 'Eroare! Conectarea la baza de date nu a reusit!';
        exit;
      }
      $query = "SELECT * FROM camere WHERE nr_camera NOT IN (SELECT nr_camera FROM rezervari WHERE data_checkout BETWEEN '".$data1."' AND '".$data2."' OR data_checkin BETWEEN '".$data1."' AND '".$data2."' OR (data_checkin <= '".$data1."' AND data_checkout >= '".$data2."'))";
      $result = $db->query($query);
      
      if ($result->num_rows > 0)
      {
        echo '<form action="formular.php" method="post">
        <br/>';
        echo '<table border="1" cellpadding="5" cellspacing="0" style="width: 80%;">';
        echo '<tr><th>Nr. camera</th><th>Tip camera</th><th>Nr. paturi</th><th>Tip pat</th><th>Tarif/noapte</th><th>Selecteaza</th></tr>';
        while ($row = $result->fetch_assoc()) 
        {
          echo '<tr>';
          echo '<td>' . $row['nr_camera'] . '</td>';
          echo '<td>' . $row['tip_camera'] . '</td>';
          echo '<td>' . $row['nr_paturi'] . '</td>';
          echo '<td>' . $row['tip_pat'] . '</td>';
          echo '<td>' . $row['pret_camera'] . ' lei</td>';
          echo '<td><input type="radio" name="camera" value="' . $row['nr_camera'] . '"></td>';
          echo '</tr>';
        }
        echo '</table>
        </br>
        <input type="hidden" name="data1" value="'.$data1.'">
        <input type="hidden" name="data2" value="'.$data2.'">
        <input type="submit" value="Rezerva">
        </form>';
      } else {
        echo 'Nu mai sunt camere disponibile pentru perioada aleasa.';
      }
      $db->close();

?>
</body>
</html>