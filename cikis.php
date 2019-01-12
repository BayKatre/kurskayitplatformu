<?php
session_start();
include("gereksinim/baglanti.php");
$_SESSION['login']=="";
date_default_timezone_set('Europe/Istanbul');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE giriskayitlari  SET cikisZamani = '$ldate' WHERE ogrenciNo = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
session_unset();
$_SESSION['errmsg']="Başarıyla çıkış yaptınız!";
?>
<script language="javascript">
document.location="index.php";
</script>
