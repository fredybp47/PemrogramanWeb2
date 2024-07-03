<?php include 'auth.php'; ?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/tailwind.min.css" rel="stylesheet">
    <title>Data Mahasiswa</title>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-4">Data Mahasiswa</h1>
        <a href="add.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Mahasiswa</a>
        <a href="logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4">Logout</a>
        <table class="min-w-full bg-white mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM students";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='py-2 px-4 border-b'>{$row['id']}</td>
                                <td class='py-2 px-4 border-b'>{$row['name']}</td>
                                <td class='py-2 px-4 border-b'>{$row['email']}</td>
                                <td class='py-2 px-4 border-b'>
                                    <a href='edit.php?id={$row['id']}' class='bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded'>Edit</a>
                                    <a href='delete.php?id={$row['id']}' class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center py-4'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
