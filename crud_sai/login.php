<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
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
        .animate-login {
            animation: slide-in-right 0.5s ease-out forwards;
        }
        @keyframes slide-in-right {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(0%);
            }
        }
    </style>
</head>
<body>
    <canvas id="backgroundCanvas"></canvas>
    <div class="flex items-center justify-center min-h-screen relative z-10">
        <div class="grid grid-cols-2 gap-4 w-full max-w-4xl">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="text-3xl font-bold mb-4 text-center">Login</h1>
                <form action="login.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                        <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                        <a href="register.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Register</a>
                    </div>
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $sql = "SELECT * FROM users WHERE username='$username'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        
                        if (password_verify($password, $row['password'])) {
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['username'] = $row['username'];
                            header("Location: index.php");
                        } else {
                            echo "<p class='text-red-500 text-xs italic mt-4'>Invalid password</p>";
                        }
                    } else {
                        echo "<p class='text-red-500 text-xs italic mt-4'>No user found with that username</p>";
                    }
                }
                ?>
            </div>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 animate-login">
    <h1 class="text-3xl font-bold mb-4 text-center">Profile Picture</h1>
    <!-- Placeholder for profile picture display -->
    <div class="h-64 bg-gray-200 flex items-center justify-center rounded-lg overflow-hidden">
        <img src="assets/kaizubuild.png" alt="Profile Picture" class="h-full w-full object-cover object-center">
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
