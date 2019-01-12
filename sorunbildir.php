
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
    
    
if(isset($_GET['sil']))
      {
              mysqli_query($con,"delete from sorunlar where id = '".$_GET['no']."'");
                  $_SESSION['hatamsg']="Sorun Kaydı Silindi!";
      }
  
    function removeBadCharacters($s)
    {
        return str_replace(array('&','<','>','/','\\','#','"',"'",'+'), '', $s);
    }
    
    
if(isset($_POST['submit']))
{
$durum=0;
$sorun = removeBadCharacters($_POST['sorun']);
#$sorun=$_POST['sorun'];
$num=mysqli_query($con,"insert into sorunlar(ogrenciNo,sorun,durum) values('".$_SESSION['login']."','$sorun','$durum')");
if($num>0)
{
$_SESSION['msg']="Sorun Bildirimi Başarılı!";
$_SESSION['hatamsg']="";
}
else
{
$_SESSION['hatamsg']="Hata Oluştu!";
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
            <li class="breadcrumb-item active">Sorunlar</li>
          </ol>

          <!-- Page Content -->
          <h1>Sorun Bildir</h1>
          <hr>
           <div class="row" >
               <div class="col-md-3"></div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                        
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<font color="red" align="center"><?php echo htmlentities($_SESSION['hatamsg']);?><?php echo htmlentities($_SESSION['hatamsg']="");?></font>


                        <div class="panel-body">
                       <form name="sorunbildir" method="post">
   <div class="form-group">
    <label for="sorun">Sorun Açıklaması:</label>
    <input type="text" class="form-control" id="sorun" name="sorun" placeholder="Açıklamayı giriniz" required />
  </div>
 
  <button type="submit" name="submit" class="btn btn-info">Gönder</button>
                           <hr />
   



</form>
                            </div>
                    </div>
                            </div>
                        
                            </div>
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
                                            <th>Sorun İçeriği</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$durum=0;
$sql=mysqli_query($con,"select id as sorunno, sorun as sorunaciklama from sorunlar where ogrenciNo='".$_SESSION['login']."' and durum='".$durum."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['sorunaciklama']);?></td>
                                            <td>                                      
<a href="sorunbildir.php?no=<?php echo $row['sorunno']?>&sil=silgardasim" onClick="return confirm('Sorunu silmek istediğinize emin misiniz?')">
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
                          Çözümlendirilmiş Sorunlar
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Sorun İçeriği</th>
                                            <th>Çözüm Açıklaması</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$durum=1;
$sql=mysqli_query($con,"select sorunlar.id as sorunno, sorun as sorunaciklama, cozumaciklamasi as aciklama from sorunlar left join soruncozumleri on sorunlar.id=soruncozumleri.sorunid where ogrenciNo='".$_SESSION['login']."' and durum='".$durum."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['sorunaciklama']);?></td>
                                            <td><?php echo htmlentities($row['aciklama']);?></td>
                                            <td>                                      

                                            <button id="sil" class="btn btn-danger" disabled>Sil</button>
                                               


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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>