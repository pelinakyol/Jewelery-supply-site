<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
    include "head1.php";

    //Kayıt olma 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mail = $_POST['mail'];
        $password = md5($_POST['password']); 
        $name = $_POST['name'];

        $sql = "INSERT INTO kullanicilar (mail, password,name) VALUES ('$mail', '$password','$name')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Kayıt başarıyla tamamlandı lütfen giriş yapınız.";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
   
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        
                        <form action="" method="POST" > 
                            <h3 class="card-title text-center">Kayıt Ol</h3>
                            <div class="mb-3">
                                <label for="username" class="form-label">Kuyumcu Adı</label>
                                <input type="text" name="name"class="form-control" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Mail</label>
                                <input type="text" name="mail"class="form-control" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Şifre</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="mb-3">
                                <p>Hesabın var mı?</p><a href="giris1.php">Giriş Yap</a>
                            </div>
                            <button type="submit1" class="btn btn-primary w-100">Kayıt Ol</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>