<?php
function hitungNilaiAkhir($jumlah_kehadiran, $nilai_tugas, $nilai_uts, $nilai_uas) {
    // Bobot masing-masing komponen
    $bobot_kehadiran = 0.1;
    $bobot_tugas = 0.2;
    $bobot_uts = 0.3;
    $bobot_uas = 0.4;

    // Maksimum kehadiran
    $maksimal_kehadiran = 18;

    // Perhitungan nilai
    $nilai_kehadiran = min($jumlah_kehadiran, $maksimal_kehadiran) / $maksimal_kehadiran * 100 * $bobot_kehadiran;
    $nilai_tugas = $nilai_tugas * $bobot_tugas;
    $nilai_uts = $nilai_uts * $bobot_uts;
    $nilai_uas = $nilai_uas * $bobot_uas;

    // Nilai akhir
    $nilai_akhir = $nilai_kehadiran + $nilai_tugas + $nilai_uts + $nilai_uas;

    // Penentuan grade
    if ($nilai_akhir >= 80) {
        $grade = 'A';
    } elseif ($nilai_akhir >= 70) {
        $grade = 'B';
    } elseif ($nilai_akhir >= 60) {
        $grade = 'C';
    } elseif ($nilai_akhir >= 50) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    // Penentuan keterangan
    if ($nilai_akhir > 65) {
        $keterangan = 'Lulus';
    } else {
        $keterangan = 'Tidak Lulus';
    }

    // Mengembalikan hasil
    return [
        'nilai_akhir' => round($nilai_akhir),
        'grade' => $grade,
        'keterangan' => $keterangan
    ];
}

// Memeriksa apakah form telah disubmit
if(isset($_POST['submit'])) {
    // Memanggil fungsi hitungNilaiAkhir dengan data dari form
    $hasil_penilaian = hitungNilaiAkhir($_POST['jmlkehadiran'], $_POST['tugas'], $_POST['uts'], $_POST['uas']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 2 pertemuan 3</title>
</head>
<body>
     <form action="" method="post">
        <label for="nama">Nama : </label>
        <input type="text" name="nama" required></br>

        <label for="nim">Nim : </label>
        <input type="number" name="nim" required></br>

        <label for="matkul">Mata Kuliah : </label>
        <input type="text" name="matkul" required></br>

        <label for="jumlahkehadiran">Jumlah Kehadiran : </label>
        <input type="number" name="jmlkehadiran" required></br>

        <label for="tugas">Nilai Tugas : </label>
        <input type="number" name="tugas" required></br>

        <label for="uts">Nilai UTS : </label>
        <input type="number" name="uts" required></br>

        <label for="uas">Nilai UAS : </label>
        <input type="number" name="uas" required></br>

        <input type="submit" name="submit" value="Submit">
     </form>

    <?php if(isset($_POST['submit'])) { ?>
        <h2>Nilai AKADEMIK : <?= $_POST['matkul'] ?></h2>
        <h2>Nama : <?= $_POST['nama'] ?></h2>
        <h2>Nim : <?= $_POST['nim'] ?></h2>

        <table border="1" width="60%">
            <tr>
                <td>Jumlah Kehadiran  </td>
                <td>: <?= $_POST['jmlkehadiran'] ?></td>
                <td>Nilai Kehadiran  </td>
                <td>: <?= $hasil_penilaian['nilai_akhir'] ?></td>
            </tr>
            <tr>
                <td>Nilai Tugas  </td>
                <td>: <?= $_POST['tugas'] ?></td>
                <td>Niai UTS  </td>
                <td>: <?= $_POST['uts'] ?></td>
            </tr>
            <tr>
                <td>Nilai UAS  </td>
                <td>: <?= $_POST['uas'] ?></td>
                <td>Nilai Akhir  </td>
                <td>: <?= $hasil_penilaian['nilai_akhir'] ?></td>
            </tr>
            <tr>
                <td>Grade  </td>
                <td>: <?= $hasil_penilaian['grade'] ?></td>
                <td>Keterangan  </td>
                <td>: <?= $hasil_penilaian['keterangan'] ?></td>
            </tr>
        </table>
    <?php } ?>
</body>
</html>
