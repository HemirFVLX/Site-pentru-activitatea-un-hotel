<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style1.css">
  <title>Stergere rezervari</title>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!isset($_POST['sterge']) || empty($_POST['sterge'])){
                header("Location: rezervari.php");
                exit;
            }
            $lista_sterge = $_POST['sterge'];
            $sterge = implode(',', $lista_sterge);
            if(empty($sterge)){
                echo 'Nu ati selectat nicio rezervare pentru stergere!';
                exit;
            }
            @ $db = new mysqli('localhost', 'webuser', 'webuser', 'agentie');
            if (mysqli_connect_errno()) {
                echo 'Eroare! Conectarea la baza de date nu a reusit!';
                exit;
            }
            $query = "DELETE FROM rezervari WHERE id_rezervare IN (".$sterge.")";
            $db->query($query);
            $db->close();

            header("Location: rezervari.php");
            exit;
        } else {
            header("Location: rezervari.php");
            exit;
        }
    ?>
</body>
</html>    