<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghitung Luas Segitiga (Cara 1)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        p {
            margin-bottom: 10px;
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
        <h2>Menghitung Luas Segitiga (Cara 1)</h2>

        <div class="hasil">
            <?php
            // Definisikan data alas dan tinggi dalam array
            $data_alas = array(5, 6, 7, 8, 9);
            $data_tinggi = array(8, 9, 10, 11, 12);

            // Fungsi untuk menghitung luas segitiga
            function hitungLuasSegitiga($alas, $tinggi) {
                return 0.5 * $alas * $tinggi;
            }

            // Iterasi melalui data dan hitung luas untuk setiap segitiga
            echo "<p><strong>Hasil:</strong></p>";
            for ($i = 0; $i < count($data_alas); $i++) {
                $luas = hitungLuasSegitiga($data_alas[$i], $data_tinggi[$i]);
                echo "<p>Luas segitiga dengan alas {$data_alas[$i]} dan tinggi {$data_tinggi[$i]} adalah: $luas </p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
