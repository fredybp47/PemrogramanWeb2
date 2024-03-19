<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
</head>
<body>
    <h1>Buku Tamu</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="komentar">Komentar:</label><br>
        <textarea id="komentar" name="komentar" required></textarea><br><br>
        
        <input type="submit" name="submit" value="Simpan">
    </form>

    <?php
    $nameFile = "bukutamu.dat";
    if(isset($_POST['submit'])) {
        if(!file_exists($nameFile)) {
            $file = fopen($nameFile, 'w');
            fclose($file);
        }
        
        $name = $_POST['nama'];
        $email = $_POST['email'];
        $komentar = $_POST['komentar'];

        $file = fopen($nameFile, 'a+');
        $txt = "Nama : $name\n" . 
                "Email : $email\n" . 
                "Komentar : $komentar\n" ;

        fwrite($file, $txt);
        fclose($file);
        
        echo "Data berhasil disimpan";
    }
    ?>
</body>
</html>
