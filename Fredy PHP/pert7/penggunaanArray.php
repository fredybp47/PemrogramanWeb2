<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pert4 - lat2</title>
</head>
<body>
    <h3>Perkalian Matriks</h3>
    <table width="30%" border="1" align="center">
        <tr>
            <th colspan="11">Table Perkalian</th>
        </tr>
        <tr>
            <td></td>
            <?php for($i = 1; $i <= 10; $i++) : ?>
                <td><?= $i ?></td>
            <?php endfor;?>
        </tr>
        <?php for($i = 1; $i <= 10; $i++) : ?>
            <tr>
                <td><?= $i ?></td>
                <?php for($j = 1; $j <= 10; $j++) : ?>
                    <td><?= ($i * $j) ?></td>
                <?php endfor;?>
            </tr>
        <?php endfor;?>
    </table>
</body>
</html>