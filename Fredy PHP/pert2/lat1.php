<!DOCTYPE html>
<html>
<head>
    <title>Hitung Rata-rata Nilai</title>
</head>
<body>
    <h2>Data Yang Di Input :</h2>
    <form method="post" action="">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br>

        <label for="jurusan">Jurusan:</label><br>
        <input type="text" id="jurusan" name="jurusan"><br>

        <label for="nilai_tugas">Nilai Tugas:</label><br>
        <input type="text" id="nilai_tugas" name="nilai_tugas"><br>

        <label for="nilai_uts">Nilai UTS:</label><br>
        <input type="text" id="nilai_uts" name="nilai_uts"><br>

        <label for="nilai_uas">Nilai UAS:</label><br>
        <input type="text" id="nilai_uas" name="nilai_uas"><br><br>

        <input type="submit" name="submit" value="Hitung">
    </form>

    <?php
    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $nilai_tugas = $_POST['nilai_tugas'];
        $nilai_uts = $_POST['nilai_uts'];
        $nilai_uas = $_POST['nilai_uas'];

        $rata_rata = ($nilai_tugas + $nilai_uts + $nilai_uas) / 3;

        echo "<h3>Hasil Perhitungan</h3>";
        echo "Nama: $nama <br>";
        echo "Jurusan: $jurusan <br>";
        echo "Nilai Tugas: $nilai_tugas <br>";
        echo "Nilai UTS: $nilai_uts <br>";
        echo "Nilai UAS: $nilai_uas <br>";
        echo "Rata-rata Nilai: $rata_rata";
    }
    ?>
</body>
</html>
