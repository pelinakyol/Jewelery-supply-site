<?php
session_start();

include "baglanti1.php"; 

//Verileri veritabanından çek
$user_id = $_SESSION['user_id'];
$sql = "SELECT DATE(transaction_date) as Date, SUM((sale_price - api_price) * quantity) AS Profit FROM islemler where user_id = ".$user_id." GROUP BY DATE(transaction_date)";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Sonuçları çekme
$result = $stmt->get_result();
$allData = [];


while ($row = $result->fetch_assoc()) {
    //profit kârı gösterir
    $allData[] = [$row['Date'], (float)$row['Profit']];
}
$stmt->close();

$conn->close();


// Seçilen tarih aralığı
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

// Tarih aralığına göre verileri filtreleme
//entry dizi içerisindeki her bir eleman
$filteredData = array_filter($allData, function ($entry) use ($startDate, $endDate) {
    return $entry[0] >= $startDate && $entry[0] <= $endDate;
});
//json_encode php tarafından işlenen veriyi javascript formatına dönüştürdü
echo json_encode(array_values($filteredData));
?>