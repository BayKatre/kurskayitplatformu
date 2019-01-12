<?php
session_start();
include('gereksinim/baglanti.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



if(isset($_GET['sil']))
      {
              mysqli_query($con,"delete from ogrenciler where ogrenciNo = '".$_GET['no']."'");
                  $_SESSION['delmsg']="Öğrenci Kaydı Silindi!";
      }

     if(isset($_GET['parola']))
      {
        $parola="Amasya05";
        $newpass=md5($parola);
              mysqli_query($con,"update ogrenciler set parola='$newpass' where ogrenciNo = '".$_GET['no']."'");
                  $_SESSION['delmsg']="Öğrenci Parolası Sıfırlandı. Yeni Parola: Amasya05";
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
            <li class="breadcrumb-item active">Öğrenci Yönetim</li>
          </ol>

          <!-- Page Content -->
          <h1>Öğrenci Yönetim</h1>
          <hr>
          
            
            
            
            
            
           <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Öğrenci Numarası</th>
                                            <th>Öğrenci Adı</th>
                                            <th>PIN Kodu</th>
                                             <th>Kayıt Tarihi</th>
                                             <th>Eylem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from ogrenciler");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['ogrenciNo']);?></td>
                                            <td><?php echo htmlentities($row['ogrenciAdi']);?></td>
                                            <td><?php echo htmlentities($row['pinKodu']);?></td>
                                            <td><?php echo htmlentities($row['olusturmaTarihi']);?></td>
                                            <td>
                                            <a href="ogrenciduzenle.php?id=<?php echo $row['ogrenciNo']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i>Düzenle</button> </a>                                        
<a href="ogrenciyonetim.php?no=<?php echo $row['ogrenciNo']?>&sil=silgardasim" onClick="return confirm('Öğrenci kaydını silmek istediğinize emin misiniz?')">
                                            <button class="btn btn-danger">Sil</button>
</a>
<a href="ogrenciyonetim.php?no=<?php echo $row['ogrenciNo']?>&parola=sifirla" onClick="return confirm('Öğrencinin parolasını sıfırlamak istediğinize emin misiniz?')">
<button type="submit" name="submit" id="submit" class="btn btn-info">Parolayı Sıfırla</button>
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
                     <!--  End  Bordered Table  -->
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