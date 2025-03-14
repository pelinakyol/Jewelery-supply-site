<?php
session_start(); // Oturumu başlatılıyor

// Oturum değişkenlerini sil
$_SESSION = array();

// Oturumu sonlandır
session_destroy();

// Giriş sayfasına veya ana sayfaya yönlendir
header("Location: giris1.php");
exit();
?>
