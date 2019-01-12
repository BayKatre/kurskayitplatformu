<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Europe/Istanbul');
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT parola FROM  yonetici where parola='".md5($_POST['mparola'])."' && kullaniciadi='".$_SESSION['alogin']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update yonetici set parola='".md5($_POST['yeniparola'])."', guncellemeTarihi='$currentTime' where kullaniciadi='".$_SESSION['alogin']."'");
$_SESSION['msg']="Parolanız başarıyla değiştirildi!";
}
else
{
$_SESSION['msg']="Yanlış Parola!";
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="anasayfa.php">Kurs Kayıt Platformu</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <?php include('gereksinim/ustcubukarama.php');?>

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
              <a href="anasayfa.php">Yönetici Paneli</a>
            </li>
            <li class="breadcrumb-item active">Parola Değiştir</li>
          </ol>

          <!-- Page Content -->
          <h1>Parola Değiştir</h1>
          <hr>
          <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                     
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="paroladegistir" method="post" onSubmit="return valid();">
   <div class="form-group">
    <label for="parola1">Mevcut Parola</label>
    <input type="password" class="form-control" id="parola1" name="mparola" placeholder="" />
  </div>
   <div class="form-group">
    <label for="parola1">Yeni Parola</label>
    <input type="password" class="form-control" id="parola2" name="yeniparola" placeholder="" />
  </div>
  <div class="form-group">
    <label for="parola1">Yeni Parola Doğrulama</label>
    <input type="password" class="form-control" id="parola3" name="dyeniparola" placeholder="" />
  </div>
 
  <button type="submit" name="submit" class="btn btn-info">Değiştir</button>
                           <hr />
   



</form>
                            </div>
                            </div>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
      
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

    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>