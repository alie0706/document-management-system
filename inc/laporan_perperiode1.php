<?php
session_start();
include"inc.koneksi.php";
include"class_paging.php";
include"fungsi_indotgl.php";

$kd=$_GET[kd];
$id=$_GET[id];

$no=1; $mm = 0;		

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../style.css" type="text/css" />

<title> :: BOX DATA :: </title>
<style>
hr { border:thin; border-top:none; border-left:none; border-right:none; border-bottom-style:solid; border-collapse:collapse; }
table {
	border:none;
	border-collapse:collapse;  }
th 
{ 
	border:thin;  
	border-style:solid; 
	border-collapse:collapse; 
	text-align:center; 
	padding-right: 2px ;
	padding-left: 2px; 
}
td
{
	padding-right: 10px ;	
	padding-left: 10px ;
}
input { border:thin; border-style:solid; border-collapse:collapse; }
</style>

<style>
/* default styles */
#header { width:100%;border:1px solid #000000; }
#menu { width:150px;border:1px solid #000000;line-height:30px;float:left; }
#content { border:1px solid #000000;margin-left:150px; }
.printHead { display: none; }
.printView { display: none; }
/* print specific styles */
@media print {
  #header { display: none; }
  #menu { display: none; }
  #content { margin-left:0px; border:0px; }
  #allAcctHeader { display: none; }
  .printHead { display: inline; }
  .printView { display: inline; }
  .pageBreak { page-break-after: always; }
}
</style>
</head>

<body onLoad="window.print()">
<?php
$tanggal1=$_GET['tanggal1'];
$bulan1=$_GET['bulan1'];
$tahun=$_GET['tahun'];
$tanggal2=$_GET['tanggal2'];
$bulan2=$_GET['bulan2'];
$tahuna=$_GET['tahuna'];
$tglsebelum = $_GET['from'];
$tglsetelah = $_GET['to'];

 
 if($jenis!='0')
		{
		$m=@mysql_query("SELECT * FROM dakot_h WHERE KODPLG='$_SESSION[KODPLG]' AND RECMOD>='$tglsebelum' and RECMOD<='$tglsetelah' 
		ORDER BY dakot_h.NOMKOT, dakot_h.RECMOD");
		}
		else
		{
		$m=@mysql_query("SELECT * FROM dakot_h WHERE KODPLG='$_SESSION[KODPLG]' AND RECMOD>='$tglsebelum' and RECMOD<='$tglsetelah'
		ORDER BY dakot_h.NOMKOT, dakot_h.RECMOD");
		}
	
if($jenis!='')
		{
		$m=@mysql_query("SELECT * FROM dakot_h WHERE KODPLG='$_SESSION[KODPLG]' AND RECMOD>='$tglsebelum' and RECMOD<='$tglsetelah' 
		ORDER BY dakot_h.NOMKOT, dakot_h.RECMOD");
		}
		else
		{
		$m=@mysql_query("SELECT * FROM dakot_h WHERE KODPLG='$_SESSION[KODPLG]' AND RECMOD>='$tglsebelum' and RECMOD<='$tglsetelah' 
		ORDER BY dakot_h.NOMKOT, dakot_h.RECMOD");
		}
while($r=mysql_fetch_array($m))
{
$mm++;
$xx=mysql_num_rows($m);
$m1=@mysql_query("SELECT * FROM pelanggan where KODPLG='$r[KODPLG]'");
$r1=mysql_fetch_array($m1);
$tglmus=tgl_indo($r[TGLMUS]);		
	$count = 0;
	$max = 2;
	$ambil_all0 = 
	"
	SELECT DISTINCT NOMKOT FROM dakot_d where NOMKOT='$r[NOMKOT]'	
	";	
	$hasil_all0 = mysql_query($ambil_all0);
	while($row_all0 = mysql_fetch_array($hasil_all0))
	{
		$count++;
	}
	
	$bagi = floor($count / $max) + 1;

$k=0;
for($i=1;$i<=$bagi;$i++)
{
	
$ambil = 
"
SELECT DISTINCT NOMKOT FROM dakot_d where NOMKOT='$r[NOMKOT]'
";

echo "<div id=\"allAcctHeader\"></div>\n"; // multipage
?>
<table width=700 height=350>
<col width="29" />
  <col width="93" />
  <col width="120" />
  <col width="60" span="2" />
  <col width="100" />
  <col width="100" />
  <tr height="20">
    <td colspan="2" rowspan="1" width="90" align=center height=80><img src=../images/logoindoarsip.JPG width=90 height=80></td>
    <td colspan="5" rowspan="1" width="510" align=center height=80><font size=+2><b> BOX DATA </b></font></td>
  </tr>
  <tr >
  
    <td colspan="2" rowspan="3" width="90" align=center><b> <br>BOX NO <br></b><font size=+1.5> <?=$r[NOMKOT]?></font>
<br><br><br><?=$no++;echo "/";?><?=$xx?>	</td>
    <td width=90 height=20><b><font size=1px>ACCOUNT NAME</b></td>
    <td colspan="2" width=200 height=20><font size=1px><?=$r1[NAMPLG]?></td>
    <td colspan="2" rowspan=2 width=100 height=20 align=center><font size=1px><b>RETENTION </b><br> <font size=1px><?=$r[MASRET1]?> THN</td>
  </tr>
  <tr>
    <td height=20><font size=1px><b>DEPARTEMENT</b></td>
    <td colspan="2" height=20><font size=1px><?=$r[KODBAG]?></td>
  </tr>
  <tr>
    <td height=20><font size=1px><b>CONTROL NO</b></td>
    <td colspan="2" height=20><font size=1px><?=$r[NOMCON]?></td>
    <td colspan="2" rowspan="1" align=center><font size=1px><b>DESTRUCTION DATE</b> <br> <font size=1px><?=$tglmus?></td>
  </tr>
  
  <tr>
    <td align=center width=10 height=20><font size=1px><b>NO</td>
    <td colspan="4" width=150 height=20 align=center><font size=1px><b>DESCRIPTION OF CONTENT</td>
    <td align=center height=20><font size=1px><b>PERIOD</td>
    <td align=center height=20><font size=1px><b>DESCRIPTION</b></td>
  </tr>
  <?
   $mc=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
$j=mysql_num_rows($mc);
    
if($j < 2){
     
$m2=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
while($x=mysql_fetch_array($m2)){
//$j=mysql_num_rows($m2);
echo "<tr>
    <td align='center' height=20><font size=1px><i>$x[URTDOK]</td>
    <td colspan='4' height=20><font size=1px><i>$x[NAMDOK]</td>
    <td height=20><font size=1px><i>$x[PRD_TX]</td>
    <td height=20><font size=1px><i>$x[KETDK1]$x[KETDK2]$x[KETDK3] </i></td>
  </tr>";


  //$no++;
  }
  
  $tgl11=tgl_indo($r[TGL_11]);
  
  
  echo "<tr height='30'> </tr>
  <tr height='30'> </tr>
  <tr height='30'> </tr>
  <tr height='30'> </tr>";
 }
elseif($j < 3){
     
$m2=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
while($x=mysql_fetch_array($m2)){
//$j=mysql_num_rows($m2);
echo "<tr>
    <td align='center' height=20><font size=1px><i>$x[URTDOK]</td>
    <td colspan='4' height=20><font size=1px><i>$x[NAMDOK]</td>
    <td height=20><font size=1px><i>$x[PRD_TX]</td>
    <td height=20><font size=1px><i>$x[KETDK1]$x[KETDK2]$x[KETDK3] </i></td>
  </tr>";


  //$no++;
  }
  
  $tgl11=tgl_indo($r[TGL_11]);
  
  
  echo "<tr height='20'> </tr>
  <tr height='20'> </tr>
  <tr height='20'> </tr>
  <tr height='20'> </tr>";
 }
 elseif($j < 4){
     
$m2=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
while($x=mysql_fetch_array($m2)){
//$j=mysql_num_rows($m2);
echo "<tr>
    <td align='center' height=20><font size=1px><i>$x[URTDOK]</td>
    <td colspan='4' height=20><font size=1px><i>$x[NAMDOK]</td>
    <td height=20><font size=1px><i>$x[PRD_TX]</td>
    <td height=20><font size=1px><i>$x[KETDK1]$x[KETDK2]$x[KETDK3] </i></td>
  </tr>";


  //$no++;
  }
  
  $tgl11=tgl_indo($r[TGL_11]);
  
  
  echo "<tr height='20'> </tr>
  <tr height='20'> </tr>
  <tr height='20'> </tr>";
 }
 elseif($j < 5){
     
$m2=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
while($x=mysql_fetch_array($m2)){
//$j=mysql_num_rows($m2);
echo "<tr>
    <td align='center' height=20><font size=1px><i>$x[URTDOK]</td>
    <td colspan='4' height=20><font size=1px><i>$x[NAMDOK]</td>
    <td height=20><font size=1px><i>$x[PRD_TX]</td>
    <td height=20><font size=1px><i>$x[KETDK1]$x[KETDK2]$x[KETDK3] </i></td>
  </tr>";


  //$no++;
  }
  
  $tgl11=tgl_indo($r[TGL_11]);
  
  
  echo "<tr height='20'> </tr>
  <tr height='20'> </tr>";
 }
 elseif($j < 6){
     
$m2=@mysql_query("SELECT * FROM dakot_d where dakot_d.NOMKOT='$r[NOMKOT]' ORDER BY URTDOK");
while($x=mysql_fetch_array($m2)){
//$j=mysql_num_rows($m2);
echo "<tr>
    <td align='center' height=15><font size=1px><i>$x[URTDOK]</td>
    <td colspan='4' height=15><font size=1px><i>$x[NAMDOK]</td>
    <td height=15><font size=1px><i>$x[PRD_TX]</td>
    <td height=15><font size=1px><i>$x[KETDK1]$x[KETDK2]$x[KETDK3] </i></td>
  </tr>";


  //$no++;
  }
  
  $tgl11=tgl_indo($r[TGL_11]);
   
echo "";
     
 }
 
 ?>
 
  <tr>
    <td colspan="2" rowspan="1" align=center height=20><font size=1px><b>PREPARED</td>
    <td rowspan="1" align=center height=20><font size=1px><b>CHECKED</td>
    <td colspan="2" rowspan="1" align=center height=20><font size=1px><b>APPROVED</td>
    <td colspan="2" rowspan="1" align=center height=20><font size=1px><B>RECEIPT BY INDOARSIP</td>
  </tr>
   <tr>
    <td colspan="2" rowspan="2"  height=20>&nbsp;</td>
    <td rowspan="2" height=20></td>
    <td colspan="2" rowspan="2" height=20></td>
    <td colspan="2" height=20><font size=1px>DATE :<?=$tgl11?></td>
  </tr>
  <tr>
    <td colspan="2" height=20><font size=1px>BY :</td>
  </tr>
  <br \><br \>
  <?
  }
  ?>
  <!--<div class="page-break">-->
 
<?php

  $ceck = $mm % 2;
if($ceck == 1) // multipage
	echo"<h3 style='page-break-before: always;'><br></h3>"; // multipage
}
?>
</body>
</html>