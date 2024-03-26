<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Aritmatika - pert2 lat2</title>
</head>
<body>
<h3>Kalkulator</h3>
    <fieldset>
        <form action="" method="POST">
            <legend>Penilaian Aritmatika</legend>
            <input type="number" name="angka1">
            <select name="operasi" id="operasi">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
                <option value="%">%</option>
            </select>
            <input type="number" name="angka2">
            <input type="submit" name="submit" value="submit">
        </form>
    </fieldset>
    <section>
        <?php 
            $perhitungan = '';
            if (isset($_POST['submit'])) {
                $angka1 = $_POST['angka1'];
                $angka2 = $_POST['angka2'];
                $operasi = $_POST['operasi'];
                
                switch ($operasi) {
                    case "+": 
                        $perhitungan = "$angka1 + $angka2 = " . ($angka1 + $angka2);
                        break;
                    case "-": 
                        $perhitungan = "$angka1 - $angka2 = " . ($angka1 - $angka2);
                        break;
                    case "*": 
                        $perhitungan = "$angka1 * $angka2 = " . ($angka1 * $angka2);
                        break;
                    case "/": 
                        if ($angka2 != 0) {
                            $perhitungan = "$angka1 / $angka2 = " . ($angka1 / $angka2);
                        } else {
                            $perhitungan = "Tidak bisa melakukan pembagian dengan nol";
                        }
                        break;
                    case "%": 
                        $perhitungan = "$angka1 % $angka2 = " . ($angka1 % $angka2);
                        break;
                    default: 
                        $perhitungan = "Operasi Tidak Ditemukan";
                        break;
                }
            }
        ?>
        <p>Hasil Dari Perhitungan Aritmatika adalah : <?= $perhitungan; ?></p>
    </section>
</body>
</html>
