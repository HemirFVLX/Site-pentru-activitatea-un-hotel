<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style1.css">
  <title>Formular rezervare</title>
</head>
<body>
    <h1>Formular rezervare</h1>
    <form action="trimite_formular.php" method="post">
        <label for="cnp">CNP:</label><br>
        <input type="text" id="cnp" name="cnp" required><br><br>
        
        <label for="nume">Nume:</label><br>
        <input type="text" id="nume" name="nume" required><br><br>

        <label for="oras">Oras:</label><br>
        <input type="text" id="oras" name="oras" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required><br><br>
        
        <label for="tel">Telefon:</label><br>
        <input type="text" id="tel" name="tel" required><br><br>
        
        <input type="hidden" name="camera" value="<?php echo $_POST['camera']; ?>">
        <input type="hidden" name="data1" value="<?php echo $_POST['data1']; ?>">
        <input type="hidden" name="data2" value="<?php echo $_POST['data2']; ?>">
        
        <input type="submit" value="Trimite rezervarea">
    </form>
</body>
</html>