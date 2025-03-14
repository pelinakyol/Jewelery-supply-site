<?php
        session_start();
        include 'baglanti1.php';
        //hata ayıklama
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);
      
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #sidebar {
            min-height: 100vh;
            background-color: #EA2027 ; 
            color: white;
        }
        #sidebar .nav-link {
            color: white;
        }
      
        #sidebar .nav-link:hover {
            background-color: #CC0000;
          
        }
        @media (max-width: 768px) {
            #sidebar {
                display: none;
            }
        }
        .main {
            flex: 1;
            padding: 20px;
        }
        .btn-toggle {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .btn-toggle {
                display: block;
            }
        } 
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body{
    background-size: cover;
    align-items: center;
    justify-content: center;
  }


 .card-body form{

  width: 100%;
  max-width: 400px;
  border: 2px solid #c1c1c1;
  border-radius: 40px;
  margin: 0 auto;
  margin-top: 10%;
  padding: 25px 25px 25px 25px;
  font: 14px/130% 'Roboto', sans-serif;
  background:#fff ;
  text-align: center;
  box-shadow: 0 0 20px rgba(123, 6, 6, 0.8); 
  margin-bottom: 10%;
}
.mb-3{
  width: 100%;
  text-align: left;
  padding: 5px;
}
.mb-3 .hesap{
  width: 100%;
  text-align: right;
  padding: 5px;
}
form h3[class="card-title text-center"]{
  font-size: 25px;
  font-weight: normal;
  line-height: 25px;
  text-align: center;
  margin-bottom: 15px;
}

form input[type="text"] , form input[type="password"] {
  width: 100%;
  padding: 15px 20px;
  background: #f1f1f9;
  border-radius: 18px;
  border: 2px solid #c1c1c1;
  outline: none;
  transition: all .25s ease;
}
form input:focus{
    border-color: #f04747;
}
form button[type="submit1"]{
  background: #EA2027 !important;
  color: #fff !important;
  cursor: pointer;
  border: 0 !important;
  font-weight: bold;
  height:40px;
  width: 40%;
  align-items: center;
  border-radius: 35px;
  transition: 0.2s linear
}
form input[type="text"]:focus , form input[type="password"]:focus {
    width:100%;
    border:solid 2px rgb(144, 65, 65);
}

form button[type="submit1"]:hover{
    box-shadow: 0 10px 30px 0 rgb(144 65 65 / 70%);
}
    </style>