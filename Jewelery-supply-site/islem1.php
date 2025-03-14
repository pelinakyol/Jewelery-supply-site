<!DOCTYPE html>
<html lang="tr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İşlemler</title>
    <?php


        //Var olan döviz türleri
        $data = [
            'USD' => 'Dolar (USD)',
            'EUR' => 'Euro (EUR)',
            'ons' => 'Ons Altın',
            'gram-altin' => 'Gram Altın',
            'gram-has-altin' => 'Gram Has Altın',
            'ceyrek-altin' => 'Çeyrek Altın',
            'yarim-altin' => 'Yarım Altın',
            'tam-altin' => 'Tam Altın',
            'cumhuriyet-altini' => 'Cumhuriyet Altını',
            'ata-altin' => 'Ata Altın',
            '14-ayar-altin' => '14 Ayar Altın',
            '18-ayar-altin' => '18 Ayar Altın',
            '22-ayar-bilezik' => '22 Ayar Bilezik',
            'ikibucuk-altin' => 'İkibuçuk Altın',
            'besli-altin' => 'Beşli Altın',
            'gremse-altin' => 'Gremse Altın',
            'resat-altin' => 'Reşat Altın',
            'hamit-altin' => 'Hamit Altın',
        ];

        include 'head1.php';

        
        
        //Kullanıcı girişi kontrol et
        if (!isset($_SESSION['user_id'])) {
            header('Location: giris1.php');
            exit();
        }

        $user_id = $_SESSION['user_id'];  // Kullanıcı ID'si ile oturum sağlıyor

        //Yeni işlem ekleme
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Anlık döviz fiyatlarını diziye dönüştürdü
            $finans = json_decode(file_get_contents('https://finans.truncgil.com/today.json'), true);


            //Veri tanımlamaları
            $currency_type = $_POST['currency_type'];
            $sale_price = $_POST['sale_price'];
            $quantity = $_POST['quantity'];
            $transaction_date = date('Y-m-d h:i:s');
            $api_price = $finans[$currency_type]['Satış'];

            $converted_value = str_replace('.', '', $api_price); // noktayı kaldır
            $api_price = str_replace(',', '.', $converted_value); // virgülü noktayla değiştir

            //? ile olan yerler yer tutucularıdır
            $sql = 'INSERT INTO islemler (user_id, currency_type, sale_price, quantity, transaction_date, api_price) VALUES (?, ?, ?, ?, NOW(), ?)';
            //Sorguyu işlemek için hazırlık yapıldı
            $stmt = $conn->prepare($sql);
            //issddi = veri türleridir     bind_param metodu ile yer tutucular ile post metodundan gelen gerçek değerler bağlanır
            $stmt->bind_param('isddi', $_SESSION['user_id'], $currency_type, $sale_price, $quantity, $api_price);
            //execute metodu ile sorgu çalıştı ve veri tabanına eklendi
            $stmt->execute();
            

            echo "<div class='alert alert-success'>İşlem başarıyla kaydedildi.</div>";
        }

        //Tüm işlemleri veritabanından çek
        $sql2 = 'SELECT * FROM islemler WHERE user_id = ?';
        //sorgu hazırlandı
        $stmt2 = $conn->prepare($sql2);
        //eşleme/bağlama yapıldı
        $stmt2->bind_param('i', $user_id);
        //sorgu çalıştırıldı
        $stmt2->execute();
        //sonuçlar döndürüldü
        $result = $stmt2->get_result();

        //Kasadaki dövizleri veritabanından çek
        $sql = 'SELECT * FROM bank WHERE user_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result2 = $stmt->get_result();


    ?>

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
                <h1 class="h2">İşlemler</h1>
                
                <hr>
                <div class="form-section">
                    <form id="salesForm" action="" method="POST" class="row g-3">
                        <div class="col-md-4">
                            <select class="form-select" name="currency_type" id="inputGroupSelect01">
                                <option selected disabled>Döviz Türü</option>
                                <?php
                                    //Döviz türlerini yazdır.
                                    foreach ($data as $key => $value) {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                ?>
                        </select>                       
                        </div>
                        <div class="col-md-4">
                            <input type="text1" class="form-control" name="sale_price" placeholder="Satış Fiyatı" name="sellingPrice" required>
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
                <div class="row">
                <?php
                    if ($result2->num_rows > 0) {
                        // Kasadaki döviz miktarlarını yazdır
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
                        echo '<p>Kasa boş</p>';  
                    }
                    ?>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>ID</th>
                                <th>Tarih</th>
                                <th>Tür</th>
                                <th>Fiyat</th>
                                <th>Miktar</th>
                            </tr>
                        </thead>
                        <tbody id="salesTable">
                        <?php
                            if ($result->num_rows > 0) {
                                // İşlem verilerini yazdır.
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                          <td>' . htmlspecialchars($row['id']) . '</td>
                          <td>' . htmlspecialchars($row['transaction_date']) . '</td>

                          <td>' . htmlspecialchars($row['currency_type']) . '</td>
                          <td>' . htmlspecialchars($row['sale_price']) . '</td>
                          <td>' . htmlspecialchars($row['quantity']) . '</td>
                          <td>' . htmlspecialchars($row['api_price']) . '</td>

                          </tr>';
                                }
                            } else {
                                echo "<tr><td colspan='4'>No transactions found</td></tr>";
                            }
                        ?>

                                
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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