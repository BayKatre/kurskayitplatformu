<?php
session_start();
error_reporting(0);
include("gereksinim/baglanti.php");
if(isset($_POST['submit']))
{
    function removeBadCharacters($s)
    {
        return str_replace(array('&','<','>','/','\\','#','"',"'",'?','+'), '', $s);
    }
    $kullaniciadi = removeBadCharacters($_POST['kullaniciadi']);
    #$kullaniciadi=$_POST['kullaniciadi'];
    $parola=md5($_POST['parola']);
$query=mysqli_query($con,"SELECT * FROM yonetici WHERE kullaniciadi='$kullaniciadi' and parola='$parola'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="anasayfa.php";//
$_SESSION['alogin']=$_POST['kullaniciadi'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Hatalı kullanıcı adı veya parola!";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
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

    <title>Giriş - Yönetici Paneli</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Yönetici Girişi</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="kullaniciadi" name="kullaniciadi" class="form-control" placeholder="Kullanıcı adınızı Yazınız" required="required" autofocus="autofocus">
                <label for="kullaniciadi">Kullanıcı Adı</label>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
