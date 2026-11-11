<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "QLHocPhan"; // Tên CSDL bạn vừa tạo trong phpMyAdmin

$conn = new mysqli($host, $user, $pass, $dbName);
mysqli_set_charset($conn, 'UTF8');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>