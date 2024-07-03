<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator PHP</title> 
    <style>
        label{
            margin-right:165px;
        }
    </style>
</head>
<body>

<h2>Kalkulator PHP</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="">Nilai 1</label> 
    <label for="">Nilai 2</label> <br>
    <input type="number" name="angka1">
    <select name="operasi">
        <option value="tambah">+</option>
        <option value="kurang">-</option>
        <option value="kali">*</option>
        <option value="bagi">/</option>
    </select>
   
    <input type="number" name="angka2">
    <br><br>
    <input type="submit" name="hitung" value="Hitung">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $angka1 = $_POST["angka1"];
    $angka2 = $_POST["angka2"];
    $operasi = $_POST["operasi"];
    $hasil = 0;

    if ($operasi == "tambah") {
        $hasil = $angka1 + $angka2;
    } elseif ($operasi == "kurang") {
        $hasil = $angka1 - $angka2;
    } elseif ($operasi == "kali") {
        $hasil = $angka1 * $angka2;
    } elseif ($operasi == "bagi") {
        if ($angka2 != 0) {
            $hasil = $angka1 / $angka2;
        } else {
            echo "Tidak bisa membagi dengan 0";
        }
    } else {
        echo "Operasi tidak valid";
    }

    echo "<br>Hasil: $hasil";
}
?>

</body>
</html>

