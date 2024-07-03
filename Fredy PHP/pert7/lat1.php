<?php 
    session_start();
    function menu($menu) {
        if ($menu == '1') {
            include 'penggunaanIf.php';
        } elseif ($menu == '2') {
            include 'penggunaanSwitch.php';
        } elseif ($menu == '3') {
            include 'penggunaanFor.php';
        } elseif ($menu == '4') {
            include 'penggunaanArray.php';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-inline-size: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h3 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        ul li {
            margin-block-end: 10px;
        }
        form {
            margin-block-start: 20px;
        }
        input[type="text"], input[type="submit"], input[type="reset"] {
            padding: 8px 12px;
            margin-inline-end: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        
        }
        input[type="submit"], input[type="reset"] {
            background-color: #4caf50;
            color: #fff;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049;
        }
        input[type="text"] {
            background-color:#E8E8E8;
            border-radius: 10px;
            inline-size: 100px;
            margin-inline-end: 10px;
            margin-block-end: 10px;
            
            
            
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Pilih Menu Yang Ingin Dipilih</h3>
        <ul> <!-- Menggunakan tag <ul> untuk membuat daftar hitam -->
            <li>1 Penggunaan IF ... ELSE (Menentukan Nilai Akhir) </li>
            <li>2 Penggunaan Switch ... CASE (Kalkulator) </li>
            <li>3 Penggunaan Looping (Bilangan Genap yang habis dibagi 3) </li>
            <li>4 Penggunaan Array (Perkalian Matriks) </li>
        </ul>

        <form action="" method="POST">
            <input type="text" name="menu" placeholder="Pilih nomor                     ">
            <input type="submit" name="pilih" value="Pilih">
            <input type="submit" name="reset" value="Reset">
        </form>

        <br/>
        <br/>

        <?php 
            // Handling form submission
            if (isset($_POST['pilih'])) {
                // Set session variable for selected menu
                $_SESSION['menu'] = $_POST['menu'];
                // Call menu function to include respective PHP file
                menu($_POST['menu']);
            } else {
                // If session variable is not empty, include respective PHP file
                if (!empty($_SESSION['menu'])) {
                    menu($_SESSION['menu']);
                }
            }

            // Reset session
            if (isset($_POST['reset'])) {
                session_destroy();
            }
        ?>
    </div>
</body>
</html>
