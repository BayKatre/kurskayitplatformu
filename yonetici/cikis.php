<?php
session_start();
include("gereksinim/baglanti.php");
$_SESSION['alogin']=="";
date_default_timezone_set('Europe/Istanbul');
$ldate=date( 'd-m-Y h:i:s A', time () );
session_unset();
$_SESSION['errmsg']="Başarıyla çıkış yaptınız!";
?>
<script language="javascript">
document.location="index.php";
</script>
