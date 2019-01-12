<?php
session_start();
include('gereksinim/baglanti.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$bolumid=$_POST['bolumid'];
    $donemid=$_POST['donemid'];
$kurskodu=$_POST['kurskodu'];
$kursadi=$_POST['kursadi'];
$kontenjan=$_POST['kontenjan'];
$farukabi=mysqli_query($con,"select * from kurs where kursKodu='".$kurskodu."'");
$say=mysqli_num_rows($farukabi);
if($say==0){

$ret=mysqli_query($con,"insert into kurs(kursKodu,bolumid,kursAdi) values('$kurskodu','$bolumid','$kursadi')");
if($ret)
{
$_SESSION['msg']="Kurs Başarıyla Eklendi.";
}
else
{
  $_SESSION['msg']="Hata! Kurs Eklenirken Bir Hata Oluştu.";
}
}
    else $_SESSION['errmsg']="Aynı Kodla İki Kurs Ekleyemezsiniz!";
}
if(isset($_GET['del']))
      {
            $kursid=$_GET['id'];
           mysqli_query($con,"delete from kurs where kurs.id='$kursid'");
  
                  $_SESSION['delmsg']="Kurs silindi!";
                

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
            <li class="breadcrumb-item active">Kurs Ekle</li>
          </ol>

          <!-- Page Content -->
          <h1>Kurs Ekle</h1>
          <hr>
          <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                    
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<font color="red" align="center"><?php echo htmlentities($_SESSION['errmsg']);?><?php echo htmlentities($_SESSION['errmsg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
                           
                           
    <div class="form-group">
    <label for="bolum">Bölüm</label>
    <select class="form-control" name="bolumid" required="required">
   <option value="">Kursu Eklemek İstediğiniz Bölümü Seçiniz.</option>   
   <?php 
$sql=mysqli_query($con,"select * from bolum");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['bolum']);?></option>
<?php } ?>

    </select> 
  </div> 
                           

                           
                           
   <div class="form-group">
    <label for="kurskodu">Kurs Kodu</label>
    <input type="text" class="form-control" id="kurskodu" name="kurskodu" placeholder="" required />
  </div>

 <div class="form-group">
    <label for="kursadi">Kurs Adı</label>
    <input type="text" class="form-control" id="kursadi" name="kursadi" placeholder="" required />
  </div>

  

 <button type="submit" name="submit" class="btn btn-info">Kaydet</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
            
            <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Kursları Yönet
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sıra Numarası</th>
                                            <th>Bölüm</th>
                                            <th>Kurs Kodu</th>
                                            <th>Kurs Adı</th>
                                             <th>Oluşturulma Tarihi</th>
                                            <th>Sınıf İşlemleri</th>
                                             <th>Eylem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select *, kurs.id kursID from kurs left join bolum on kurs.bolumid=bolum.id order by kursID");
#$bolumtablosu=mysqli_query($con,"select * from bolum");
#$bolumtab=mysqli_fetch_array($bolumtablosu);
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['bolum']);?></td>
                                            <td><?php echo htmlentities($row['kursKodu']);?></td>
                                            <td><?php echo htmlentities($row['kursAdi']);?></td>
                                            <td><?php echo htmlentities($row['olusturmaTarihi']);?></td>
                                            <td><a href="sinifac.php?id=<?php echo $row['kursID']?>">
<button class="btn btn-outline-dark"><i class="fa fa-plus-square"></i> Sınıf Aç</button> </a>   </td>
                                            <td>
                                            <a href="kursduzenle.php?id=<?php echo $row['kursID']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> Düzenle</button> </a>                                        
  <a href="kurs.php?id=<?php echo $row['kursID']?>&del=delete" onClick="return confirm('Kursu silmek istediğinize emin misiniz?')">
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