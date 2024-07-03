<?php include 'auth.php'; ?>
<?php include 'config.php'; ?>

<?php
// Inisialisasi variabel SQL dan result
$sql = "";
$result = null;

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    $sql = "SELECT * FROM students WHERE jurusan = '$filter'";
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql .= " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
    }
    $result = $conn->query($sql);
} elseif (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
    $result = $conn->query($sql);
}

// Query untuk mendapatkan data kelas dan jurusan
$sql_kelas = "SELECT DISTINCT kelas FROM students";
$sql_jurusan = "SELECT DISTINCT jurusan FROM students";
$result_kelas = $conn->query($sql_kelas);
$result_jurusan = $conn->query($sql_jurusan);

// Mengumpulkan data kelas dan jurusan menjadi array
$kelasData = [];
$jurusanData = [];

while ($row_kelas = $result_kelas->fetch_assoc()) {
    $kelasData[] = $row_kelas['kelas'];
}

while ($row_jurusan = $result_jurusan->fetch_assoc()) {
    $jurusanData[] = $row_jurusan['jurusan'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
    body {
        margin: 0;
        background: #f7fafc; /* Tailwind's bg-gray-100 */
        overflow: auto; /* Mengizinkan scroll vertikal pada halaman */
    }
    canvas#backgroundCanvas {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .card {
        margin-top: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .flex-1 {
        overflow-y: auto; /* Membuat konten utama dapat discroll jika melebihi layar */
    }
</style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);

        async function fetchWeather() {
            const apiKey = 'YOUR_API_KEY'; // Ganti dengan API key Anda
            const city = 'YourCity'; // Ganti dengan nama kota Anda
            const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`);
            const data = await response.json();
            const temperature = data.main.temp;
            const description = data.weather[0].description;
            document.getElementById('weather').textContent = `${temperature}°C, ${description}`;
        }
        fetchWeather();
    </script>
</head>
<body>
    <canvas id="backgroundCanvas"></canvas>
    <div class="flex relative z-10">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white min-h-screen">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Dashboard</h1>
            </div>
            <nav class="mt-4">
                <ul>
                    <li class="p-4 hover:bg-blue-700"><a href="index.php">Data Mahasiswa</a></li>
                    <li class="p-4 hover:bg-blue-700"><a href="add.php">Tambah Mahasiswa</a></li>
                    <li class="p-4 hover:bg-blue-700"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <div class="flex items-center justify-between bg-white p-4 shadow">
                <div class="flex items-center">
                    <span class="text-gray-700 font-bold">Welcome, <?php echo $_SESSION['username']; ?></span>
                </div>
                <div class="flex items-center space-x-4">
                    <span id="clock" class="text-gray-700 font-bold"></span>
                    <span id="weather" class="text-gray-700 font-bold"></span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <h2 class="text-3xl font-bold mb-4">Data Mahasiswa</h2>
                
                <!-- Form Pencarian -->
                <form action="index.php" method="GET" class="mb-4">
                    <div class="flex mb-4">
                        <input type="text" name="search" placeholder="Cari berdasarkan nama atau email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded">Cari</button>
                        <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                            <a href="index.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 ml-2 rounded">Batal</a>
                        <?php endif; ?>
                    </div>
                </form>

                <!-- Form Filter -->
                <form action="index.php" method="GET" class="mb-4">
                    <div class="flex mb-4">
                        <select name="filter" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Pilih jurusan</option>
                            <?php
                            // Menampilkan pilihan jurusan
                            foreach ($jurusanData as $jurusan) {
                                echo "<option value='$jurusan'>Jurusan $jurusan</option>";
                            }
                            ?>
                        </select>
                        <select name="filter_kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2">
                            <option value="">Pilih kelas</option>
                            <?php
                            // Menampilkan pilihan kelas
                            foreach ($kelasData as $kelas) {
                                echo "<option value='$kelas'>Kelas $kelas</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded">Filter</button>
                        <?php if (isset($_GET['filter']) || isset($_GET['filter_kelas'])): ?>
                            <a href="index.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 ml-2 rounded">Batal</a>
                        <?php endif; ?>
                    </div>
                </form>

                <!-- Tabel Data Mahasiswa -->
                <?php if ($result && $result->num_rows > 0): ?>
                    <table class="min-w-full bg-white border mb-8">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">Nama</th>
                                <th class="py-2 px-4 border-b">Email</th>
                                <th class="py-2 px-4 border-b">Kelas</th>
                                <th class="py-2 px-4 border-b">Jurusan</th>
                                <th class="py-2 px-4 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class='py-2 px-4 border-b'><?php echo $row['id']; ?></td>
                                    <td class='py-2 px-4 border-b'><?php echo $row['name']; ?></td>
                                    <td class='py-2 px-4 border-b'><?php echo $row['email']; ?></td>
                                    <td class='py-2 px-4 border-b'><?php echo $row['kelas']; ?></td>
                                    <td class='py-2 px-4 border-b'><?php echo $row['jurusan']; ?></td>
                                    <td class='py-2 px-4 border-b'>
                                        <a href='edit.php?id=<?php echo $row['id']; ?>' class='bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded'>Edit</a>
                                    <a href='delete.php?id=<?php echo $row['id']; ?>' class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded' onclick='return confirm("Are you sure?")'>Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="text-center py-4">No data found</div>
            <?php endif; ?>

            <!-- Card untuk Diagram -->
            <div class="card">
                <h2 class="text-3xl font-bold mb-4">Diagram Jumlah Mahasiswa per Kelas</h2>
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const canvas = document.getElementById('backgroundCanvas');
    const ctx = canvas.getContext('2d');
    let width, height, shapes = [];

    function resizeCanvas() {
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
    }

    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    function Shape(x, y, size, speed, type) {
        this.x = x;
        this.y = y;
        this.size = size;
        this.speed = speed;
        this.type = type;
        this.angle = 0;
    }

    Shape.prototype.update = function() {
        this.angle += this.speed;
        this.x += Math.sin(this.angle) * 0.5;
        this.y += Math.cos(this.angle) * 0.5;
        if (this.y > height + this.size) {
            this.y = -this.size;
        }
    };

    Shape.prototype.draw = function() {
        ctx.save();
        ctx.translate
(this.x, this.y);
            ctx.rotate(this.angle);
            ctx.beginPath();
            if (this.type === 'circle') {
                ctx.arc(0, 0, this.size, 0, Math.PI * 2);
            } else if (this.type === 'triangle') {
                ctx.moveTo(0, -this.size);
                ctx.lineTo(this.size, this.size);
                ctx.lineTo(-this.size, this.size);
                ctx.closePath();
            } else {
                ctx.rect(-this.size, -this.size, this.size * 2, this.size * 2);
            }
            ctx.fillStyle = 'rgba(0, 0, 0, 0.1)';
            ctx.fill();
            ctx.restore();
        };

        function initShapes() {
            shapes = [];
            for (let i = 0; i < 100; i++) {
                const x = Math.random() * width;
                const y = Math.random() * height;
                const size = Math.random() * 20 + 10;
                const speed = Math.random() * 0.02;
                const type = ['circle', 'triangle', 'square'][Math.floor(Math.random() * 3)];
                shapes.push(new Shape(x, y, size, speed, type));
            }
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            shapes.forEach(shape => {
                shape.update();
                shape.draw();
            });
            requestAnimationFrame(animate);
        }

        initShapes();
        animate();

// Chart.js untuk diagram batang
var ctxChart = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctxChart, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($kelasData); ?>,
        datasets: [{
            label: 'Jumlah Mahasiswa per Kelas',
            data: <?php
                $dataPoints = [];
                foreach ($kelasData as $kelas) {
                    $sql_count = "SELECT COUNT(*) AS total FROM students WHERE kelas = '$kelas'";
                    $result_count = $conn->query($sql_count);
                    $row_count = $result_count->fetch_assoc();
                    $dataPoints[] = $row_count['total'];
                }
                echo json_encode($dataPoints);
            ?>,
            backgroundColor: [ // Array warna untuk setiap kelas
                'rgba(54, 162, 235, 0.2)', // Warna untuk kelas pertama
                'rgba(255, 99, 132, 0.2)', // Warna untuk kelas kedua
                'rgba(255, 206, 86, 0.2)', // Warna untuk kelas ketiga, dan seterusnya
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [ // Array warna border untuk setiap kelas (opsional)
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

    </script>
</body>
</html>
