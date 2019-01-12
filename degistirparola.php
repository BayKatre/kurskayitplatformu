
<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['login'])==0)
    {   
    header('location:index.php');
    }
else{
date_default_timezone_set('Europe/Istanbul');
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT parola FROM  ogrenciler where parola='".md5($_POST['mparola'])."' && ogrenciNo='".$_SESSION['login']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update ogrenciler set parola='".md5($_POST['yeniparola'])."', guncellemeTarihi='$currentTime' where ogrenciNo='".$_SESSION['login']."'");
$_SESSION['msg']="Parolanız başarıyla değiştirildi!";
}
else
{
$_SESSION['errmsg']="Yanlış Parola!";
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

    <title>Kurs Kayıt Platformu</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="anasayfa.php">Kurs Kayıt Platformu</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
 

      <!-- Navbar -->
      <?php include('gereksinim/ustcubuk.php');?>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php include('gereksinim/kenarcubuk.php');?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="anasayfa.php">Öğrenci Paneli</a>
            </li>
            <li class="breadcrumb-item active">Parola Değiştir</li>
          </ol>

          <!-- Page Content -->
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
            
          <h1>Parola Değiştir</h1>
          <hr>
          <form method="post" onSubmit="return valid();">
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="parola1" name="mparola" class="form-control" placeholder="" required="required" autofocus="autofocus">
                <label for="mparola">Mevcut Parola</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="parola2" name="yeniparola" class="form-control" placeholder="" required="required">
                <label for="yeniparola">Yeni Parola</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="parola3" name="dyeniparola" class="form-control" placeholder="" required="required">
                <label for="dyeniparola">Yeni Parola Doğrulama</label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Değiştir</button><hr>
                          
                <span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
              <span style="color:green;" ><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']="");?></span>
          </form>
                        </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include('gereksinim/altyazi.php');?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include('gereksinim/cikisuyari.php');?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
      <script type="text/javascript">
            function valid()
            {
            if(document.paroladegistir.mparola.value=="")
            {
            alert("Lütfen parolanızı girin!");
            document.paroladegistir.mparola.focus();
            return false;
            }
            else if(document.paroladegistir.yeniparola.value=="")
            {
            alert("Yeni parola alanı boş olamaz!");
            document.paroladegistir.yeniparola.focus();
            return false;
            }
            else if(document.paroladegistir.dyeniparola.value=="")
            {
            alert("Yeni parolanızı doğrulayın!");
            document.paroladegistir.dyeniparola.focus();
            return false;
            }
            else if(document.paroladegistir.yeniparola.value!= document.paroladegistir.dyeniparola.value)
            {
            alert("Parolalar eşleşmiyor!");
            document.paroladegistir.dyeniparola.focus();
            return false;
            }
            return true;
            }
        </script>

  </body>

</html>
<?php } ?>