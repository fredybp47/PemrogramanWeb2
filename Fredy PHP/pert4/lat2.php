<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Perkalian</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Tabel Perkalian</h2>
    <table>
        <tr>
            <th></th>
<?php
    // Membuat header kolom
    for ($i = 1; $i <= 10; $i++) {
        echo "<th>$i</th>";
    }
?>
        </tr>
<?php
    // Membuat isi tabel
    for ($i = 1; $i <= 10; $i++) {
        echo "<tr>";
        echo "<th>$i</th>";
        for ($j = 1; $j <= 10; $j++) {
            echo "<td>" . ($i * $j) . "</td>";
        }
        echo "</tr>";
    }
?>
    </table>
</body>
</html>
