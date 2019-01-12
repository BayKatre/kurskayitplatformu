<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'Faruk.12');
define('DB_NAME','kurskayit');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Database Bağlantısı Başarısız: " . mysqli_connect_error();
}
?>