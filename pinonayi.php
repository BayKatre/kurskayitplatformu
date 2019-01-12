
<?php
session_start();
include('gereksinim/baglanti.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Europe/Istanbul');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT * FROM  ogrenciler where pinKodu='".trim($_POST['pinKodu'])."' && ogrenciNo='".$_SESSION['login']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
$_SESSION['pcode']=$_POST['pinKodu'];
header("location:kurskayit.php");
}
else
{
$_SESSION['msg']="Hatalı PIN Kodu!";
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
            <li class="breadcrumb-item active">Kurslar</li>
          </ol>

          <!-- Page Content -->
          <h1>PIN Onayı</h1>
          <hr>
          <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                       
<font color="red" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="pinKoduverify" method="post">
   <div class="form-group">
    <label for="pinKodu">PIN Kodunu Giriniz:</label>
    <input type="password" class="form-control" id="pinKodu" name="pinKodu" placeholder="Sadece rakam giriniz" required />
  </div>
 
  <button type="submit" name="submit" class="btn btn-info">Doğrula</button>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>