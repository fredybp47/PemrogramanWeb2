<?php
// Array nama depan dari berbagai budaya
$firstNames = [
    // Arab
    "Ahmad", "Fatima", "Ali", "Zainab", "Hassan",
    // Indonesia
    "Budi", "Siti", "Indah", "Pratama", "Rahman",
    // Jepang
    "Ichiro", "Yuki", "Hiroshi", "Dewi", "Sakura",
    // Barat
    "John", "Mary", "Michael", "Emma", "William",
    // Korea
    "Ji-hye", "Min-ho", "Soo-jin", "Hyun-woo", "Yoon-ji",
    // Nordik
    "Erik", "Ingrid", "Lars", "Freja", "Magnar",
    // China
    "Wei", "Li", "Yan", "Jun", "Lin",
    // Afrika
    "Kwame", "Amina", "Musa", "Aisha", "Jabari",
    // Nama dari seluruh dunia
    "Juan", "Maria", "Jose", "Luis", "Ana",
    "Mohammed", "Amira", "Youssef", "Jasmine", "Mohammad",
    "Pierre", "Jean", "Marie", "Claire", "Antoine",
    // Nama tambahan untuk variasi
    "Josephine", "Gabriel", "Alexandra", "Nicholas", "Sophia"
];

// Array nama belakang dari berbagai budaya
$lastNames = [
    // Arab
    "Abdullah", "Yusuf", "Hassan", "Rahman", "Sari",
    // Indonesia
    "Santoso", "Setiawan", "Pratama", "Sari", "Yamamoto",
    // Jepang
    "Tanaka", "Nakamura", "Kobayashi", "Yamamoto", "Sato",
    // Barat
    "Smith", "Johnson", "Williams", "Jones", "Brown",
    // Korea
    "Kim", "Lee", "Park", "Choi", "Jung",
    // Nordik
    "Jensen", "Nielsen", "Hansen", "Pedersen", "Andersen",
    // China
    "Wang", "Li", "Zhang", "Liu", "Chen",
    // Afrika
    "Kwame", "Omar", "Suleiman", "Fatima", "Keita",
    // Nama dari seluruh dunia
    "Garcia", "Rodriguez", "Martinez", "Lopez", "Hernandez",
    "Rossi", "Ricci", "Ferrari", "Moretti", "Conti",
    // Nama tambahan untuk variasi
    "Dupont", "Lefevre", "Leclerc", "Dubois", "Bernard"
];

// Array jurusan
$majors = [
    "Teknik Informatika", "Manajemen", "Sistem Informasi", "Sastra Indonesia", "Sastra Inggris",
    "Teknik Elektro", "Ekonomi Pembangunan", "Akuntansi", "Hukum Perdata", "Kedokteran Umum",
    "Psikologi Klinis", "Pendidikan Matematika", "Agribisnis", "Perikanan", "Sastra Korea",
    "Teknologi Pangan", "Kesehatan Masyarakat", "Pendidikan Bahasa Inggris", "Hukum Internasional", "Farmasi"
];

// Fungsi untuk menghasilkan email acak berdasarkan nama
function generateEmail($firstName, $lastName) {
    $domains = ["gmail.com", "yahoo.com", "hotmail.com", "outlook.com", "icloud.com"];
    $domain = $domains[array_rand($domains)];
    $username = strtolower($firstName . "." . $lastName);
    return $username . "@" . $domain;
}

// Fungsi untuk menghasilkan kelas acak
function generateClass($major, $classNumber) {
    $prefix = "05";
    return $prefix . substr($major, 0, 3) . str_pad($classNumber, 2, '0', STR_PAD_LEFT);
}

$sql = "INSERT INTO students (name, email, kelas, jurusan) VALUES \n";

$classCounter = [];
$classCapacity = rand(25, 30); // Kapasitas kelas antara 25-30 mahasiswa

$totalStudents = 5000;
$studentsPerMajor = ceil($totalStudents / count($majors));

foreach ($majors as $major) {
    for ($classNumber = 1; $classNumber <= 10; $classNumber++) {
        $className = generateClass($major, $classNumber);
        $classCounter[$major][$className] = 0;
    }
}

for ($i = 0; $i < $totalStudents; $i++) {
    $majorIndex = $i % count($majors);
    $major = $majors[$majorIndex];
    
    $classNumber = 1;
    foreach ($classCounter[$major] as $className => $count) {
        if ($count < $classCapacity) {
            $classCounter[$major][$className]++;
            break;
        }
        $classNumber++;
    }
    
    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
    $name = $firstName . " " . $lastName;
    $email = generateEmail($firstName, $lastName);
    $kelas = generateClass($major, $classNumber);
    
    $sql .= "('$name', '$email', '$kelas', '$major'),\n";
}

$sql = rtrim($sql, ",\n") . ";";

// Menyimpan query ke file insert_students.sql
file_put_contents("insert_students.sql", $sql);
echo "SQL query has been written to insert_students.sql";
?>
