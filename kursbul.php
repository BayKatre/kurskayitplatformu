<?php 
require_once("gereksinim/baglanti.php");


if(!empty($_POST["cid"])) {
	$bolumid= $_POST["cid"];
		$result =mysqli_query($con,"SELECT *, kurs.id kursID FROM kurs left join bolum on bolum.id=kurs.bolumid where bolum.id='$bolumid'");
		$count=mysqli_num_rows($result);
if($count>0)
{
    echo "<option value=''>Kurs Seçin</option>";
    while($row=mysqli_fetch_array($result)){  
        echo "<option value=".$row[kursID].">".$row[kursAdi]."</option>";
    }
    
       
}
else{
    echo "<option value=''>Uygun Kurs Yok</option>";
	echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
elseif(!empty($_POST["kid"])) {
	$kursid= $_POST["kid"];
    $bolumid=$_POST["bid"];
		$result =mysqli_query($con,"SELECT DISTINCT donem.id donemID, donem FROM donem left join acilankurslar on acilankurslar.donemid=donem.id where acilankurslar.kursid='$kursid' ");
		$count=mysqli_num_rows($result);
if($count>0)
{
    echo "<option value=''>Dönem Seçin</option>";
    while($row=mysqli_fetch_array($result)){ 
        echo "<option value=".$row[donemID].">".$row[donem]."</option>";
    }
}
else{
	echo "<option value=''>Uygun Dönem Yok</option>";
	echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
elseif(!empty($_POST["did"])) {
	$donemid= $_POST["did"];
    $kursid= $_POST["kursid"];
		$result =mysqli_query($con,"SELECT DISTINCT seviye.id seviyeID, seviye FROM seviye left join acilankurslar on acilankurslar.seviyeid=seviye.id where acilankurslar.donemid='$donemid' and acilankurslar.kursid='$kursid'");
		$count=mysqli_num_rows($result);
if($count>0)
{
    echo "<option value=''>Seviye Seçin</option>";
    while($row=mysqli_fetch_array($result)){ 
        echo "<option value=".$row[seviyeID].">".$row[seviye]."</option>";
    }
}
else{
	echo "<option value=''>Uygun Seviye Yok</option>";
	echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
elseif(!empty($_POST["sid"])) {
	$seviyeid= $_POST["sid"];
    $donemid= $_POST["donemid"];
    $kursid= $_POST["kursid"];
		$result =mysqli_query($con,"SELECT DISTINCT oturum.id oturumID, oturum FROM oturum left join acilankurslar on acilankurslar.oturumid=oturum.id where acilankurslar.seviyeid='$seviyeid' and acilankurslar.kursid='$kursid' and acilankurslar.donemid='$donemid'");
		$count=mysqli_num_rows($result);
if($count>0)
{
    echo "<option value=''>Oturum Seçin</option>";
    while($row=mysqli_fetch_array($result)){ 
        echo "<option value=".$row[oturumID].">".$row[oturum]."</option>";
    }
}
else{
	echo "<option value=''>Uygun Oturum Yok</option>";
	echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
elseif(!empty($_POST["oid"])) {
	$oturumid= $_POST["oid"];
    $seviyeid= $_POST["seviyeid"];
    $donemid= $_POST["donemid"];
    $kursid= $_POST["kursid"];
		$result =mysqli_query($con,"SELECT * FROM acilankurslar where oturumid='$oturumid' and acilankurslar.seviyeid='$seviyeid' and acilankurslar.kursid='$kursid' and acilankurslar.donemid='$donemid'");
		$count=mysqli_num_rows($result);
if($count>0)
{
    while($row=mysqli_fetch_array($result)){ 
        echo $row[id];
    }
}
else{
	echo "<script>alert('Bilinmeyen Hata!');</script>";
	echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
    

?>
