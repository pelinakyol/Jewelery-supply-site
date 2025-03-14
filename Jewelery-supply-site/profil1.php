<!DOCTYPE html>
<html lang="tr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    
    <?php
   include 'head1.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: giris1.php');
    exit();
}
$data_for_currency = ['USD' => 'Dolar (USD)', 'EUR' => 'Euro (EUR)', 'ons' => 'Ons Altın', 'gram-altin' => 'Gram Altın', 'gram-has-altin' => 'Gram Has Altın', 'ceyrek-altin' => 'Çeyrek Altın', 'yarim-altin' => 'Yarım Altın', 'tam-altin' => 'Tam Altın', 'cumhuriyet-altini' => 'Cumhuriyet Altını', 'ata-altin' => 'Ata Altın', '14-ayar-altin' => '14 Ayar Altın', '18-ayar-altin' => '18 Ayar Altın', '22-ayar-bilezik' => '22 Ayar Bilezik', 'ikibucuk-altin' => 'İkibuçuk Altın', 'besli-altin' => 'Beşli Altın', 'gremse-altin' => 'Gremse Altın', 'resat-altin' => 'Reşat Altın', 'hamit-altin' => 'Hamit Altın', ];
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Veri tanımlaması yapıldı
    $currency_type = $_POST['currency_type'];
    $quantity = $_POST['quantity'];

    //Seçilen tür var mı kontrol edilir
    $check_sql = 'SELECT amount FROM bank WHERE user_id = ? AND currency_type = ?';
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param('is', $user_id, $currency_type);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    //fetch_assoc metodu her bir satırı dizi olarak alır (bank tablosundaki usd eur satırları ayrı ayrı alındı)
    $row = $result->fetch_assoc();

    if ($row) {
        // Eğer seçilen tür mevcutsa, yeni miktarı ekleyin
        $new_quantity = $row['amount'] + $quantity;
        $update_sql = 'UPDATE bank SET amount = ? WHERE user_id = ? AND currency_type = ?';
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param('iss', $new_quantity, $user_id, $currency_type);
        $update_stmt->execute();
        echo "<div class='alert alert-success'>İşlem başarıyla güncellendi.</div>";
    } else {
        // Eğer seçilen tür mevcut değilse, yeni bir kayıt ekleyin
        $insert_sql = 'INSERT INTO bank (user_id, currency_type, amount) VALUES (?, ?, ?)';
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param('isi', $user_id, $currency_type, $quantity);
        $insert_stmt->execute();
        echo "<div class='alert alert-success'>İşlem başarıyla kaydedildi.</div>";
    }
}


// hesap verilerini çek
$sql = 'SELECT * FROM bank WHERE user_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result2 = $stmt->get_result();

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Google chart verileri 
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart(dataArray = []) {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Tarih');
            data.addColumn('number', 'Kar');

            data.addRows(dataArray);

            var options = {
                title: 'Kar/Zarar Grafiği',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }

        function fetchData() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            //sunucu ile veri alışverişi yapmak için nesne oluşturuldu
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_data1.php', true);
            // gönderilen verinin url kodlanmış form verisi olduğu sunucuya iletir
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status === 200) {
                    var responseData = JSON.parse(this.responseText);
                    drawChart(responseData);
                }
            };
            xhr.send('start_date=' + startDate + '&end_date=' + endDate);
        }
    </script>
</head>
<body>
    <button class="btn btn-primary btn-toggle" onclick="toggleSidebar()"><</button>

    <div class="container-fluid">
        <div class="row">
            <?php
            include 'sidebar1.php';
            ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main">
                <br>
                <h1 class="h2">Hesabım</h1>
                
                <hr>
                <div class="form-section">
                    <form id="salesForm" action="" method="POST" class="row g-3">
                        <h3>Döviz Ekle</h3>
                        <div class="col-md-4">

                        
                             <select class="form-select" name="currency_type" id="inputGroupSelect01">
                                <option selected disabled>Döviz Türü</option>


                            
                                <?php
                                    // tüm döviz türlerini yazdır.

                                    foreach ($data_for_currency as $key => $value) {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                ?>
                        </select>                            
                        </div>
                        
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="quantity" placeholder="Miktar" name="amount" required>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary mb-3" style="background-color:#EA2027;border:none;text-align:center">Ekle</button>
                        </div>
                    </form>
                </div>
                <hr>
                <h3>Kasa</h3>
            
                <div class="row"> 
                <?php
                //hesap verilerini yazdır
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                    ?>
                    <div class="col-md-2">
                        <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                            <div class="card-header"><?php echo $row['currency_type']; ?></div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['amount']; ?></h5>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo '<p>Hesabınız boş</p>'; 
                    
                }
                ?>
                </div>
                <hr>
                <h3>İstatistikler</h3>
                <div>
        <label for="start_date">Başlangıç Tarihi:</label>
        <input type="date" id="start_date" name="start_date">
        <label for="end_date">Bitiş Tarihi:</label>
        <input type="date" id="end_date" name="end_date">
        <button onclick="fetchData()" ; style="background-color:#EA2027;border:none;color:white">Gönder</button>
    </div>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  
            </main>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>

        //sidebar tıklama fonksiyonu
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.style.display === 'block') {
                sidebar.style.display = 'none';
            } else {
                sidebar.style.display = 'block';
            }
        }
    </script>
    
</body>
</html>