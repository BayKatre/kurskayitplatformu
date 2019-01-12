<?php
session_start();
error_reporting(0);
include("gereksinim/baglanti.php");
if(isset($_POST['submit']))
{
    $regno=$_POST['regno'];
    $parola=md5($_POST['parola']);
$query=mysqli_query($con,"SELECT * FROM ogrenciler WHERE ogrenciNo='$regno' and parola='$parola'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="anasayfa.php";//
$_SESSION['login']=$_POST['regno'];
$_SESSION['id']=$num['ogrenciNo'];
$_SESSION['sname']=$num['ogrenciAdi'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into giriskayitlari(ogrenciNo,kullaniciIP,durumBilgisi) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:https://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Hatalı Öğrenci Numarası veya Parola!";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:https://$host$uri/$extra");
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Giriş - Öğrenci Paneli</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Öğrenci Girişi</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="regno" name="regno" class="form-control" placeholder="Öğrenci Numaranızı Yazınız" required="required" autofocus="autofocus">
                <label for="inputEmail">Öğrenci Numarası</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="parola" name="parola" class="form-control" placeholder="Parolanızı Yazınız" required="required">
                <label for="inputPassword">Parola</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Beni Hatırla
                </label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                          
                <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
          </form>
          
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
