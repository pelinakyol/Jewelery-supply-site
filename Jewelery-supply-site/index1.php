<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php
    //erişim engelleme (giriş yapmadan işlem sayfası görülemez)
    include "head1.php";
    if (!isset($_SESSION['user_id'])) {
        header("Location: giris1.php");
        exit();
    }
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