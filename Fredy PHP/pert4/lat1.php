<!DOCTYPE html>
<html>
<head>
    <title>Deret Bilangan Ganjil</title>
</head>
<body>

<form method="post">
    Nilai Awal: <input type="number" name="nilai_awal"><br>
    Nilai Akhir: <input type="number" name="nilai_akhir"><br>
    <button type="submit" name="hitung">Hitung</button>
</form>

<?php
// Proses saat tombol hitung diklik
if (isset($_POST['hitung'])) {
    // Mendapatkan nilai awal dan nilai akhir dari form
    $nilai_awal = $_POST['nilai_awal'];
    $nilai_akhir = $_POST['nilai_akhir'];

    // Inisialisasi jumlah dan banyaknya deret bilangan
    $jumlah = 0;
    $banyak = 0;

    // Menampilkan deret bilangan ganjil yang habis dibagi 3
    echo "Maka deret bilangan yang tampil: ";
    for ($i = $nilai_awal; $i <= $nilai_akhir; $i++) {
        if ($i % 2 != 0 && $i % 3 == 0) {
            echo $i . " ";
            $jumlah += $i; // Menambahkan bilangan ke jumlah
            $banyak++; // Menambahkan banyaknya deret bilangan
        }
    }

    // Menampilkan jumlah dan jumlah nilai bilangan
    echo "<br>Jumlah bilangan: " . $banyak . "<br>";
    echo "Jumlah nilai bilangan: " . $jumlah . "<br>";
}
?>

</body>
</html>
