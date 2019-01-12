<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$kursid=$_GET['id'];
if(isset($_POST['submit']))
{
$donemid=$_POST['donemid'];
$seviyeid=$_POST['seviyeid'];
$oturumid=$_POST['oturumid'];
$kontenjanSayisi=$_POST['kontenjanSayisi'];
$ret=mysqli_query($con,"insert into acilankurslar(kursid,donemid,seviyeid,oturumid,kontenjanSayisi) values('$kursid','$donemid','$seviyeid','$oturumid','$kontenjanSayisi')");
if($ret)
{
$_SESSION['msg']="Sınıf Başarıyla Açıldı!";
}
else
{
  $_SESSION['msg']="Hata! Sınıf Açılamadı.";
}
}
if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from acilankurslar where id = '".$_GET['silid']."'");
                  $_SESSION['delmsg']="Sınıf silindi!";
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
            <li class="breadcrumb-item active">Sınıf</li>
          </ol>

          <!-- Page Content -->
          <h1>Sınıf Aç</h1>
          <hr>
          
            
            
            
            
            
            <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                     
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>

                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="ogrenciadi">Sınıf Açmak İstediğiniz Kurs</label>
    <select class="form-control" name="kursid" id="kursid" required="required" readonly>   
   <?php 
    $result =mysqli_query($con,"SELECT *, id kursID from kurs where id='".$kursid."'");
    $count=mysqli_num_rows($result);
    if($count > 0){
    while($row=mysqli_fetch_array($result)){ 
        echo '<option value="'.$row['kursID'].'">'.$row['kursAdi'].'</option>';
    }
    }else{
        echo '<option value="">Uygun Kurs Yok!</option>';
    }
?>
    </select>
  </div>
                           
                           
<div class="form-group">
    <label for="ogrenciadi">Sınıfı Açmak İstediğiniz Dönemi Seçin</label>
    <select class="form-control" name="donemid" id="donemid" required="required">
   <option value="">Dönem Seçin</option>   
   <?php 
    $result =mysqli_query($con,"SELECT *, id donemID from donem");
    $count=mysqli_num_rows($result);
if($count > 0){
    while($row=mysqli_fetch_array($result)){ 
        echo '<option value="'.$row['donemID'].'">'.$row['donem'].'</option>';
    }
    }else{
        echo '<option value="">Uygun Dönem Yok!</option>';
    }
?>
    </select>
  </div>

 <div class="form-group">
    <label for="ogrencino">Seviye</label>
    <select class="form-control" name="seviyeid" id="seviyeid" required="required">
   <option value="">Seviye Seçin</option>   
   <?php 
    $result =mysqli_query($con,"SELECT *, id seviyeID from seviye");
    $count=mysqli_num_rows($result);
if($count > 0){
    while($row=mysqli_fetch_array($result)){ 
        echo '<option value="'.$row['seviyeID'].'">'.$row['seviye'].'</option>';
    }
    }else{
        echo '<option value="">Uygun Seviye Yok!</option>';
    }
?>
    </select>
     <span id="user-availability-status1" style="font-size:12px;"></span>
  </div>



<div class="form-group">
    <label for="parola">Oturum</label>
    <select class="form-control" name="oturumid" id="oturumid" required="required">
   <option value="">Oturum Seçin</option>   
   <?php 
    $result =mysqli_query($con,"SELECT *, id oturumID from oturum");
    $count=mysqli_num_rows($result);
if($count > 0){
    while($row=mysqli_fetch_array($result)){ 
        echo '<option value="'.$row['oturumID'].'">'.$row['oturum'].'</option>';
    }
    }else{
        echo '<option value="">Uygun Oturum Yok!</option>';
    }
?>
    </select>
  </div>  
                           <div class="form-group">
                               <label for="parola">Kontenjanı</label>
<input type="text" class="form-control" id="kontenjanSayisi" name="kontenjanSayisi" placeholder="" required />
                               </div>

 <button type="submit" name="submit" id="submit" class="btn btn-info">Kaydet</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
            
            
            
            <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Sınıfları Yönet
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Bölüm</th>
                                            <th>Kurs Adı</th>
                                            <th>Dönemi</th>
                                            <th>Seviyesi</th>
                                            <th>Oturumu</th>
                                            <th>Kontenjan</th>
                                            <th>Eklenme Tarihi</th>
                                            <th>Eylem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select *,acilankurslar.id acilankursID, acilankurslar.olusturmaTarihi aolusturmaTarihi, kurs.id kursID, donem.donem donemAdi, seviye.seviye seviyeAdi, oturum.oturum oturumAdi, bolum.bolum bolumAdi, kontenjanSayisi kontenjan from acilankurslar left join kurs on kurs.id=acilankurslar.kursid left join donem on donem.id=acilankurslar.donemid left join seviye on seviye.id=acilankurslar.seviyeid left join oturum on oturum.id=acilankurslar.oturumid left join bolum on bolum.id=kurs.bolumid order by aolusturmaTarihi");
#$bolumtablosu=mysqli_query($con,"select * from bolum");
#$bolumtab=mysqli_fetch_array($bolumtablosu);
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['bolumAdi']);?></td>
                                            <td><?php echo htmlentities($row['kursAdi']);?></td>
                                            <td><?php echo htmlentities($row['donemAdi']);?></td>
                                            <td><?php echo htmlentities($row['seviyeAdi']);?></td>
                                            <td><?php echo htmlentities($row['oturumAdi']);?></td>
                                            <td><?php echo htmlentities($row['kontenjan']);?></td>
                                            <td><?php echo htmlentities($row['aolusturmaTarihi']);?></td>
                                            <td>                                       
  <a href="sinifac.php?silid=<?php echo $row['acilankursID']?>&del=delete" onClick="return confirm('Sınıfı silmek istediğinize emin misiniz?')">
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
                     <!--  End  Bordered Table  -->
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