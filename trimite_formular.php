<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style1.css">
  <title>Formular rezervare</title>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $camera = $_POST['camera'];
            $data1 = $_POST['data1'];
            $data2 = $_POST['data2'];

            $cnp = $_POST['cnp'];  
            $nume = $_POST['nume'];
            $oras = $_POST['oras'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            
            @ $db = new mysqli('localhost', 'webuser', 'webuser', 'agentie');
            if (mysqli_connect_errno()) {
                echo 'Eroare! Conectarea la baza de date nu a reusit!';
                exit;
            }
            $query = "INSERT INTO rezervari (cnp, nume, oras, tel, email, nr_camera, data_checkin, data_checkout) VALUES ('".$cnp."', '".$nume."', '".$oras."', '".$tel."', '".$email."', '".$camera."', '".$data1."', '".$data2."')";
            if ($db->query($query) === TRUE) {
                echo "<h2>Rezervarea a fost efectuata cu succes!</h2>";
                echo "<p>Veti primi un email cu detaliile rezervarii.</p>";
            } else {
                echo "Eroare: " . $query . "<br>" . $db->error;
            }
            $db->close();

            echo '<nav style="text-align:center">
            <a href="pagina_principala.php">Inapoi la pagina principala</a>
            </nav>';

        } else {
            echo "Nu s-au primit datele corecte!";
            exit;
        }
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        /* Exception class. */
        require 'C:\xampp\PHPMailer\src\Exception.php';

        /* The main PHPMailer class. */
        require 'C:\xampp\PHPMailer\src\PHPMailer.php';
        require 'C:\xampp\PHPMailer\src\SMTP.php';

        $mail = new PHPMailer(TRUE);

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        require('../date_email.php');


        $mail->setFrom('dragos.stemat2003@gmail.com', 'Hotelul Steaua Mica');

        // ?????????????????????????????????

        $mail->addAddress($email, $nume);
 
        $mail->isHTML(true);
 
        $mail->Subject = 'Confirmare rezervare';
        $mail->Body    = 'Va multumim pentru rezervarea facuta la hotelul nostru! Detalii rezervare:<br>'.
                        'Camera: '.$camera.'<br>'.
                        'Data check-in: '.$data1.'<br>'.
                        'Data check-out: '.$data2.'<br>'.
                        '<br>'.
                        'Va rugam sa ne contactati pentru orice intrebari si nelamuriri sau daca vreti sa anulati rezervarea facuta.<br>'.
                        '<br>'.
                        'Va asteptam cu drag!<br>'.
                        'Hotelul Steaua Mica<br>';
        
        $mail->send();
        
    ?>
</body>
</html>