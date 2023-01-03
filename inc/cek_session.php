<?
session_start();
include "../config/koneksi.php";
if(empty($_SESSION[id_user]) AND empty($_SESSION[password]))
{
header("location:index.php?warning=login");
exit;
}

?>