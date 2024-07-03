<?php include 'auth.php'; ?>
<?php include 'config.php'; ?>

<?php
// Proses simpan data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $kelas = $_POST['kelas']; // Tambahkan ini
    $jurusan = $_POST['jurusan']; // Tambahkan ini

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO students (name, email, kelas, jurusan) VALUES ('$name', '$email', '$kelas', '$jurusan')";

    if ($conn->query($sql) === TRUE) {
        // Jika penyimpanan berhasil, redirect ke halaman index.php
        header("Location: index.php");
        exit();
    } else {
        // Jika terjadi error dalam penyimpanan data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Tambah Mahasiswa</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background: #f7fafc; /* Tailwind's bg-gray-100 */
        }
        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 50; /* Ensure footer is above other elements */
            background-color: white; /* Match the navbar background color */
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); /* Add shadow to the footer */
        }
    </style>
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
<body onload="updateYear()">
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
            <div class="container mx-auto p-8">
                <h1 class="text-3xl font-bold mb-4">Tambah Mahasiswa</h1>
                <form action="add.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                        <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kelas:</label>
                        <input type="text" name="kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jurusan:</label>
                        <input type="text" name="jurusan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex items-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Simpan</button>
                        <a href="index.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</a>
                    </div>
                </form>
            </div>
                        <!-- Footer -->
                        <footer class="footer bg-white p-4 shadow">
                <div class="container mx-auto">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-center md:text-left">
                            <h2 class="text-xl font-bold text-gray-700">Kaizu Build</h2>
                            <p class="text-sm text-gray-700">IT, Get It !!!</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <p class="text-gray-700">&copy; <span id="year"></span> PT. Kaizu Bangun Semesta. All rights reserved.</p>
                        </div>
                        <div class="flex mt-4 md:mt-0 space-x-4">
                            <a href="#" class="text-gray-700 hover:text-gray-900"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-gray-700 hover:text-gray-900"><i class="fab fa-github"></i></a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">Privacy Policy</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </footer>
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
            ctx.translate(this.x, this.y);
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
    </script>
</body>
</html>
