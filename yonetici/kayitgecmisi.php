<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

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
            <li class="breadcrumb-item active">Kayıt Geçmişi</li>
          </ol>

          <!-- Page Content -->
          <h1>Kayıt Geçmişi</h1>
          <hr>
          <div class="row" >
            
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
                                            <th>Öğrenci Adı</th>
                                            <th>Öğrenci Numarası</th>
                                            <th>Kurs Adı</th>
                                            <th>Bölüm</th>
                                            <th>Dönem</th>
                                            <th>Seviye</th>
                                            <th>Oturum</th>
                                            <th>Kayıt Tarihi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select kayitlikurslar.id as kayitlikurslarID, kurs.kursAdi as kursadi,oturum.oturum as oturum,bolum.bolum as bolum,kayitlikurslar.kayitTarihi as kayittarihi ,donem.donem as donem,seviye.seviye as seviye, ogrenciler.ogrenciAdi as ogrenciadi,ogrenciler.ogrenciNo as ogrencino from acilankurslar join kayitlikurslar on acilankurslar.id=kayitlikurslar.acilankursid join kurs on kurs.id=acilankurslar.kursid join oturum on oturum.id=acilankurslar.oturumid join bolum on bolum.id=kurs.bolumid   join donem on donem.id=acilankurslar.donemid join ogrenciler on ogrenciler.ogrenciNo=kayitlikurslar.ogrenciNo join seviye on acilankurslar.seviyeid=seviye.id");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                              <td><?php echo htmlentities($row['ogrenciadi']);?></td>
                                            <td><?php echo htmlentities($row['ogrencino']);?></td>
                                            <td><?php echo htmlentities($row['kursadi']);?></td>
                                            <td><?php echo htmlentities($row['bolum']);?></td>
                                            <td><?php echo htmlentities($row['donem']);?></td>
                                            <td><?php echo htmlentities($row['seviye']);?></td>
                                            <td><?php echo htmlentities($row['oturum']);?></td>
                                             <td><?php echo htmlentities($row['kayittarihi']);?></td>
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