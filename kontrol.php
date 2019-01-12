<?php 
require_once("gereksinim/baglanti.php");
if(!empty($_POST["akursid"])) {
	$acilankursid= $_POST["akursid"];
    $ogrno= $_POST["ogrno"];
    $sayac=0;
		$result =mysqli_query($con,"SELECT * FROM kayitlikurslar WHERE acilankursid='$acilankursid' AND ogrenciNo='$ogrno'");
		$count=mysqli_num_rows($result);
if($count>0)
{
    echo "<span style='color:red'>Bu kursu daha önce aldınız!</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
    $sayac=1;
}
else{
	echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
if(!empty($_POST["akursid"])) {
	$acilankursid= $_POST["akursid"];
	
		$result =mysqli_query($con,"SELECT * FROM acilankurslar WHERE id='$acilankursid'");
        $count=mysqli_fetch_array($result);
        $kontenjan=$count['kontenjanSayisi'];
		$result1 =mysqli_query($con,"SELECT * FROM kayitlikurslar WHERE acilankursid='$acilankursid'");
		$kayitsayisi=mysqli_num_rows($result1);
if($kayitsayisi>=$kontenjan)
{
echo "<span style='color:red'>Seçmek istediğiniz kursta yeterli kontenjan yok!</span>";

            echo "<script>$('#submit').prop('disabled',true);</script>";
} 
else {
        if($sayac==0){
    echo "<script>$('#submit').prop('disabled',false);</script>";}
}
}




?>
