<?php 

$nama = "-";
$jurusan = "-";
$nilai_tugas = 0;
$nilai_uts = 0;
$nilai_uas = 0;
$total = 0;
$rata_rata = 0;
$grade = "-";
$keterangan = "-";

if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $nilai_tugas = $_POST['nilai_tugas'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];

    $total = $nilai_tugas + $nilai_uts + $nilai_uas;
    $rata_rata = $total / 3;

    // Penentuan grade
    if ($rata_rata >= 80) {
        $grade = 'A';
    } elseif ($rata_rata >= 70) {
        $grade = 'B';
    } elseif ($rata_rata >= 60) {
        $grade = 'C';
    } elseif ($rata_rata >= 50) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    // Penentuan keterangan
    if ($rata_rata >= 65) {
        $keterangan = 'Lulus';
    } else {
        $keterangan = 'Tidak Lulus';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Sederhana - Pert2 lat1</title>
</head>
<body>
<h3>Menentukan Nilai Akhir</h3>
    <fieldset>
        <legend>Data yang diinput</legend>
        <form action="" method="POST">
        <label for="nama">Nama : </label>
<input type="text" name="nama"><br/>
<label for="jurusan">Jurusan : </label>
<input type="text" name="jurusan"><br/>
<label for="nilai_tugas">Nilai Tugas : </label>
<input type="text" name="nilai_tugas"><br/>
<label for="nilai_uts">Nilai UTS : </label>
<input type="text" name="nilai_uts"><br/>
<label for="nilai_uas">Nilai UAS : </label>
<input type="text" name="nilai_uas"><br/>

        </form>
    </fieldset>

    <section>
        <fieldset>
            <legend>Informasi Data</legend>
            <table width="100%">
                <tr>
                    <td>Nama</td>
                    <td>: <?= $nama ?></td>
                    <td>Jurusan</td>
                    <td>: <?= $jurusan ?></td>
                </tr>
                <tr>
                    <td>Nilai Tugas</td>
                    <td>: <?= $nilai_tugas ?></td>
                    <td>Nilai UTS</td>
                    <td>: <?= $nilai_uts ?></td>
                </tr>
                <tr>
                    <td>Nilai UAS</td>
                    <td>: <?= $nilai_uas ?></td>
                    <td>Rata-rata</td>
                    <td>: <?= $rata_rata ?></td>
                </tr>
                <tr>
                    <td>Grade</td>
                    <td>: <?= $grade ?></td>
                    <td>Keterangan</td>
                    <td>: <?= $keterangan ?></td>
                </tr>
            </table>
        </fieldset>
    </section>
</body>
</html>
