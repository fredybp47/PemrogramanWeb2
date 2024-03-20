<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghitung Luas Segitiga (Cara 2)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .hapus {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .hapus:hover {
            background-color: #d32f2f;
        }
        .hasil {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Menghitung Luas Segitiga (Cara 2)</h2>

        <form method="post">
            <?php
            // Jumlah input yang diinginkan
            $jumlah_input = 5;

            // Loop untuk membuat input field
            for ($i = 0; $i < $jumlah_input; $i++) {
                echo "<label for='alas{$i}'>Alas Segitiga {$i}:</label>";
                echo "<input type='number' name='alas{$i}' id='alas{$i}' required>";
                echo "<br>";

                echo "<label for='tinggi{$i}'>Tinggi Segitiga {$i}:</label>";
                echo "<input type='number' name='tinggi{$i}' id='tinggi{$i}' required>";
                echo "<br><br>";
            }
            ?>

            <input type="submit" name="hitung" value="Hitung">
            <button type="button" class="hapus" onclick="hapusHasil()">Hapus</button>
        </form>

        <?php
        // Proses hitung luas segitiga setelah form dikirimkan
        if (isset($_POST['hitung'])) {
            echo "<div class='hasil'>";
            echo "<p><strong>Hasil:</strong></p>";

            for ($i = 0; $i < $jumlah_input; $i++) {
                // Ambil nilai alas dan tinggi dari form
                $alas = $_POST["alas{$i}"];
                $tinggi = $_POST["tinggi{$i}"];

                // Hitung luas segitiga
                $luas = 0.5 * $alas * $tinggi;

                echo "<p>Luas segitiga dengan alas $alas dan tinggi $tinggi adalah: $luas </p>";
            }
            echo "</div>";
        }
        ?>

        <script>
            function hapusHasil() {
                var hasilDiv = document.querySelector('.hasil');
                if (hasilDiv) {
                    hasilDiv.remove();
                }
            }
        </script>
    </div>
</body>
</html>
