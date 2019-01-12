<?php
session_start();
include('gereksinim/baglanti.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0 or strlen($_SESSION['pcode'])==0)
    {   
header('location:login.php');
}
else{

if(isset($_POST['submit']))
{
$ogrencino=$_POST['ogrencino'];
$pinKodu=$_POST['pinkodu'];
$acilankursid=$_POST['acilankursid'];
$ret=mysqli_query($con,"insert into kayitlikurslar(ogrenciNo,pinKodu,acilankursid) values('$ogrencino','$pinKodu','$acilankursid')");
if($ret)
{
$_SESSION['msg']="Kayıt Başarılı!";
}
else
{
  $_SESSION['msg']="Kayıt Başarısız! Lütfen Yeniden Deneyin.";
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
          <h1>Kurs Kayıt</h1>
          <hr>
          <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<?php $sql=mysqli_query($con,"select * from ogrenciler where ogrenciNo='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>

                        <div class="panel-body">
                       <form name="dept" method="post" enctype="multipart/form-data">
   <div class="form-group">
    <label for="studentname">Öğrenci Adı </label>
    <input type="text" class="form-control" id="ogrenciadi" name="ogrenciadi" value="<?php echo htmlentities($row['ogrenciAdi']);?>"  placeholder="" readonly />
  </div>

 <div class="form-group">
    <label for="studentregno">Öğrenci No </label>
    <input type="text" class="form-control" id="ogrencino" name="ogrencino" value="<?php echo htmlentities($row['ogrenciNo']);?>"  readonly />
    
  </div>


<div class="form-group">
    <label for="Pincode">PIN Kodu</label>
    <input type="text" class="form-control" id="pinkodu" name="pinkodu" readonly value="<?php echo htmlentities($row['pinKodu']);?>" required />
  </div>   

 <?php } ?>




<div class="form-group">
    <label for="Department">Bölüm</label>
    <select class="form-control" name="bolum" id="bolum" onBlur="kursgetir()" required="required">
   <option value="">Bölüm Seçin</option>   
   <?php 
    $result =mysqli_query($con,"SELECT *, id bolumID from bolum");
    $count=mysqli_num_rows($result);
if($count > 0){
    while($row=mysqli_fetch_array($result)){ 
        echo '<option value="'.$row['bolumID'].'">'.$row['bolum'].'</option>';
    }
    }else{
        echo '<option value="">Uygun Bölüm Yok</option>';
    }
?>
    </select> 
    <span id="deneme" style="font-size:12px;"></span>
  </div> 
                        
                           
                           
<div class="form-group">
    <label for="Course">Kurs</label>
    <select class="form-control" name="kurs" id="kurs" onBlur="donemgetir()" required="required">  
        <option value="">Önce Bölüm Seçin</option> 
    </select> 
    
  </div>
                           
                           
<div class="form-group">
    <label for="Semester">Dönem</label>
    <select class="form-control" name="donem" id="donem" onBlur="seviyegetir()" required="required">
   <option value="">Önce Bölüm Seçin</option>   

    </select> 
  </div>


<div class="form-group">
    <label for="Level">Seviye</label>
    <select class="form-control" name="seviye" id="seviye" onBlur="oturumgetir()" required="required">
   <option value="">Önce Bölüm Seçin</option>   

    </select> 
  </div>  
                           
<div class="form-group">
    <label for="Session">Oturum</label>
    <select class="form-control" name="oturum" id="oturum" onBlur="acilankursidgetir()" required="required">
   <option value="">Önce Bölüm Seçin</option>   
 

    </select> 
  </div> 
        <input type="hidden" name="acilankursid" id="acilankursid" value=""/>


<span id="kontenjankontrol" style="font-size:12px;"></span><br>






 <button type="submit" name="submit" id="submit" class="btn btn-info">Kayıt Ol</button>
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
      

<script>
    function kursgetir() {
        jQuery.ajax({
            url: "kursbul.php",
            data: {cid: $("#bolum").val()},
            type: "POST",
            success:function(data){
                $("#kurs").html(data);
            },
            error:function (){alert("hata");}
        });
    }
    function donemgetir() {
        jQuery.ajax({
            url: "kursbul.php",
            data: {kid: $("#kurs").val()},
            type: "POST",
            success:function(data){
                $("#donem").html(data);
            },
            error:function (){alert("hata");}
        });
    }
    function seviyegetir() {
        jQuery.ajax({
            url: "kursbul.php",
            data: {did: $("#donem").val(), kursid: $("#kurs").val()},
            type: "POST",
            success:function(data){
                $("#seviye").html(data);
            },
            error:function (){alert("hata error jquery");}
        });
    }
    function oturumgetir() {
        jQuery.ajax({
            url: "kursbul.php",
            data: {sid: $("#seviye").val(), donemid: $("#donem").val(), kursid: $("#kurs").val()},
            type: "POST",
            success:function(data){
                $("#oturum").html(data);
            },
            error:function (){alert("hata error jquery");}
        });
    }
    
    function acilankursidgetir() {
        jQuery.ajax({
            url: "kursbul.php",
            data: {oid: $("#oturum").val(), seviyeid: $("#seviye").val(), donemid: $("#donem").val(), kursid: $("#kurs").val()},
            type: "POST",
            success:function(data){
                $("#acilankursid").val(data);
                $("akursid").html("<option value=" + data + ">Acilan Kurs</option>");
            },
            error:function (){alert("hata error jquery");},
            complete: function (data) {
                kontenjanKontrolu(); 
            }
        });
    }
    function kontenjanKontrolu() {
        jQuery.ajax({
            url: "kontrol.php",
            data: {akursid: $("#acilankursid").val(), ogrno: $("#ogrencino").val()},
            type: "POST",
            success:function(data){
                $("#kontenjankontrol").html(data);
            },
            error:function (){alert("hata error jquery");}
        });
    }
 
</script>


    <!-- Custom scripts for all pages-->

  </body>

</html>
<?php } ?>