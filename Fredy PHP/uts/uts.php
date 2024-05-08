<!DOCTYPE html>
<html>
<head>
    <title>Input & Output Data Klasemen Piala Asia U-23</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Input Data Klasemen Piala Asia U-23 Group A</h2>
    <form method="post">
        <label for="negara">Nama Negara:</label>
        <select name="negara" id="negara">
            <option value="Qatar U-23">Qatar U-23</option>
            <option value="Indonesia U-23">Indonesia U-23</option>
            <option value="Australia U-23">Australia U-23</option>
            <option value="Yordania U-23">Yordania U-23</option>
        </select><br><br>
        <label for="pertandingan">Jumlah Pertandingan (P):</label>
        <input type="number" name="pertandingan" id="pertandingan"><br><br>
        <label for="menang">Jumlah Menang (M):</label>
        <input type="number" name="menang" id="menang"><br><br>
        <label for="seri">Jumlah Seri (S):</label>
        <input type="number" name="seri" id="seri"><br><br>
        <label for="kalah">Jumlah Kalah (K):</label>
        <input type="number" name="kalah" id="kalah"><br><br>
        <label for="operator">Nama Operator:</label>
        <input type="text" name="operator" id="operator"><br><br>
        <label for="nim">NIM Mahasiswa:</label>
        <input type="text" name="nim" id="nim"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <h2>Data Group A Piala Asia Qatar U-23</h2>
    <p>Per <?php echo date("d M Y H:i:s"); ?> </p>
    <!-- Output Nama Operator -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $operator = $_POST['operator'];
        echo "<p>Nama Operator: $operator</p>";
    }
    ?>

    <table>
        <tr>
            <th>Negara</th>
            <th>P</th>
            <th>M</th>
            <th>S</th>
            <th>K</th>
            <th>Poin</th>
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $negara = $_POST['negara'];
            $pertandingan = $_POST['pertandingan'];
            $menang = $_POST['menang'];
            $seri = $_POST['seri'];
            $kalah = $_POST['kalah'];
            $poin = ($menang * 3) + ($seri * 1);

            // Menulis data ke file data.txt
            $file = fopen("data.txt", "a");
            fwrite($file, "$negara/$pertandingan/$menang/$seri/$kalah/$poin\n");
            fclose($file);
        }

        // Membaca data dari file data.txt
        $file = fopen("data.txt", "r");
        while (!feof($file)) {
            $line = fgets($file);
            if (trim($line) != '') {
                $data = explode("/", $line);
                echo "<tr>";
                foreach ($data as $value) {
                    echo "<td>" . htmlspecialchars(trim($value)) . "</td>";
                }
                echo "</tr>";
            }
        }
        fclose($file);
        ?>
    </table>
</body>
</html>
