<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$sorunid=intval($_GET['id']);
if(isset($_POST['submit']))
{
    $durumbilgisi=mysqli_query($con,"select durum from sorunlar where id='$sorunid'");
    $durumbilgisisatir=mysqli_fetch_array($durumbilgisi);
    if($durumbilgisisatir['durum']){
        #echo "<script>alert ('sorunguncellemeici');</script>";
        $cozumaciklamasi=$_POST['cozumaciklamasi'];
        $ret2=mysqli_query($con,"update soruncozumleri set cozumaciklamasi='$cozumaciklamasi' where sorunid='$sorunid'");
        if($ret2)
        {
        $_SESSION['msg']="Sorun Çözümü Başarıyla Güncellendi!";
        }
        else
        {
          $_SESSION['msg']="Hata: Sorun Çözümü Güncellenemedi!";
        }

    }
    else {
        #echo "<script>alert ('elseici');</script>";
$yoneticiadi=$_SESSION['alogin'];
$sorgu=mysqli_query($con,"select id from yonetici where kullaniciadi='$yoneticiadi'");
$yoneticisorgu=mysqli_fetch_array($sorgu);
$yoneticiid=$yoneticisorgu['id'];
$cozumaciklamasi=$_POST['cozumaciklamasi'];
$durum=1;
$ret=mysqli_query($con,"insert into soruncozumleri(sorunid,yoneticiid,cozumaciklamasi) values('$sorunid','$yoneticiid','$cozumaciklamasi')");
$ret2=mysqli_query($con,"update sorunlar set durum='$durum' where id='$sorunid'");
if($ret)
{
$_SESSION['msg']="Sorun Çözümü Başarıyla Eklendi!";
}
else
{
  $_SESSION['msg']="Hata: Sorun Çözümü Eklenemedi!";
}
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
            <li class="breadcrumb-item active">Sorunlar</li>
          </ol>

          <!-- Page Content -->
          <h1>Sorun Çöz</h1>
          <hr>
          
            <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                      
                         <!-- <script>alert ("<?php #echo $yoneticiid ?>")</script> -->
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
<?php
$sql=mysqli_query($con,"select sorunlar.eklemeTarihi soruneklemeTarihi, sorunlar.sorun sorunAciklamasi, ogrenciAdi, cozumaciklamasi from sorunlar left join ogrenciler on sorunlar.ogrenciNo=ogrenciler.ogrenciNo left join soruncozumleri on sorunlar.id=soruncozumleri.sorunid where sorunlar.id='$sorunid'");
$cnt=1;
$row=mysqli_fetch_array($sql);

?>
   <div class="form-group">
    <label for="kurskodu">Sorun Açıklaması</label>
    <input type="text" class="form-control" id="sorunaciklamasi" name="sorunaciklamasi" placeholder="" value="<?php echo htmlentities($row['sorunAciklamasi']);?>" readonly />
  </div>

 <div class="form-group">
    <label for="kursadi">Ekleyen Öğrenci</label>
    <input type="text" class="form-control" id="ekleyenogrenci" name="ekleyenogrenci" placeholder="" value="<?php echo htmlentities($row['ogrenciAdi']);?>" readonly />
  </div>

<div class="form-group">
    <label for="kursseviyesi">Eklenme Tarihi</label>
    <input type="text" class="form-control" id="soruneklemetarihi" name="soruneklemetarihi" placeholder="" value="<?php echo htmlentities($row['soruneklemeTarihi']);?>" readonly />
  </div>  

<div class="form-group">
    <label for="kontenjan">Çözüm Açıklamanız</label>
    <input type="text" class="form-control" id="cozumaciklamasi" name="cozumaciklamasi" placeholder="Çözüm Açıklamanızı Yazınız" value="<?php echo htmlentities($row['cozumaciklamasi']);?>" required />
  </div>  


 <button type="submit" name="submit" class="btn btn-info"><i class=" fa fa-refresh "></i>Kaydet</button>
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
      
  

    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>