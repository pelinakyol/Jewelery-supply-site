<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
    include "head1.php";
    

    //Kullanıcı giriş
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mail = $_POST['mail'];
        $password = md5($_POST['password']); // MD5 ile şifre şifreleniyor
    
        $sql = "SELECT id, name, mail FROM kullanicilar WHERE mail='$mail' AND password='$password'";
        // query metodu ile conn veritabanındaki veriler çalıştırıldı ve result değişkenine atandı
        $result = $conn->query($sql);
        // num_rows satırın olup olmadığını yani kullanıcı var mı yok mu onu gösterir
        if ($result->num_rows > 0) {
            // kullanıcı bulundu 
            $user = $result->fetch_assoc();  //bu fonksiyon ile bulunan satır işlendi 
        
            echo "Giriş başarılı";
            $_SESSION['user_id'] = $user['id']; // Kullanıcı ID'si oturuma kaydediliyor
            $_SESSION['user_name'] = $user['name']; // Kullanıcı name'si oturuma kaydediliyor
       

            header("location:islem1.php");
        } else {
            echo "Mail veya şifre yanlış";
        }
    }
    
    $conn->close();
    ?>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        
                        <form action="" method="POST">
                            <h3 class="card-title text-center">Giriş Yap</h3>
                        
                            <div class="mb-3">
                                <label for="username" class="form-label">Mail</label>
                                <input type="text" name="mail" class="form-control" id="mail" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Şifre</label>
                                <input type="password" name="password"class="form-control" id="password" required>
                            </div>
                            <div class="mb-3">
                                <p >Hesabın yok mu?</p>
                                <a href="kayit1.php">Kayıt Ol</a>
                            </div>
                            <button type="submit1" class="btn btn-primary w-100">Giriş Yap</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>