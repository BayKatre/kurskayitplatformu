<?php
session_start();
include('gereksinim/baglanti.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Europe/Istanbul');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
    
    
if(isset($_GET['sil']))
      {
              mysqli_query($con,"delete from sorunlar where id = '".$_GET['no']."'");
                  $_SESSION['hatamsg']="Sorun Kaydı Silindi!";
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
          <h1>Sorunlar</h1>
          <hr>
          
            
            
            
            
            
           <div class="row" >
                    <div class="col-md-12">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Çözümlenmemiş Sorunlar
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Öğrenci Numarası</th>
                                            <th>Sorun İçeriği</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$durum=0;
$sql=mysqli_query($con,"select id as sorunno, sorun as sorunaciklama, ogrenciNo as ogrencininnumarasi from sorunlar where durum='".$durum."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['ogrencininnumarasi']);?></td>
                                            <td><?php echo htmlentities($row['sorunaciklama']);?></td>
                                            <td>   
<a href="soruncoz.php?id=<?php echo $row['sorunno']?>"><button class="btn btn-primary"><i class="fa fa-check-square-o"></i> Sorun Çözümü Ekle</button> </a>   
<a href="sorunlar.php?no=<?php echo $row['sorunno']?>&sil=silgardasim" onClick="return confirm('Sorunu silmek istediğinize emin misiniz?')">
                                            <button class="btn btn-danger">Sil</button>
</a>

                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>
    

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                  
                </div>
            
            
            
                 <div class="row" >
                    <div class="col-md-12">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Çözümlenmiş Sorunlar
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Öğrenci Numarası</th>
                                            <th>Sorun İçeriği</th>
                                            <th>Çözüm Açıklaması</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$durum=1;
$sql=mysqli_query($con,"select sorunlar.id as sorunno, sorunlar.sorun as sorunaciklama, ogrenciNo as ogrencininnumarasi, cozumaciklamasi as cozumaciklama from sorunlar left join soruncozumleri on sorunlar.id=soruncozumleri.sorunid where durum='".$durum."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['ogrencininnumarasi']);?></td>
                                            <td><?php echo htmlentities($row['sorunaciklama']);?></td>
                                            <td><?php echo htmlentities($row['cozumaciklama']);?></td>
                                            <td>   
<a href="soruncoz.php?id=<?php echo $row['sorunno']?>"><button class="btn btn-primary"><i class="fa fa-edit"></i> Sorun Çözümünü Düzenle</button> </a>    
<a href="sorunlar.php?no=<?php echo $row['sorunno']?>&sil=silgardasim" onClick="return confirm('Sorunu silmek istediğinize emin misiniz?')">
                                            <button class="btn btn-danger">Sil</button>
</a>

                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
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