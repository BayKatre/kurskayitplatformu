<?php 
require_once("gereksinim/baglanti.php");
if(!empty($_POST["regno"])) {
	$regno= $_POST["regno"];
	
		$result =mysqli_query($con,"SELECT ogrenciNo FROM ogrenciler WHERE ogrenciNo='$regno'");
		$count=mysqli_num_rows($result);
if($count>0)
{
    echo "<span style='color:red'>Aynı numarayla iki öğrenci kaydedemezsiniz!</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	echo "<script>$('#submit').prop('disabled',false);</script>";

}
}


?>
