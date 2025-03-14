<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kuyted"; 

// Veritabanı bağlantısını oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>