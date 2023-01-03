<?php
session_start();
include "./inc/inc.koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$thn_jam_sekarang = date("Y-m-d H:i:s");
$username	= anti_injection($_POST['username']);
$pass		= anti_injection(md5($_POST['password']));
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
?>
<script>
	alert('Sorry login can not be injected.');
	window.location.href='index.php';
</script>
<?php
}
else{
	$login	=mysql_query("SELECT * FROM user WHERE username='$username' AND password='$pass'");
	$ketemu	=mysql_num_rows($login);
	
	if ($ketemu > 0){
		// session_start();
	  	$r = mysql_fetch_array($login);
		
		$_SESSION['userid']     = $r['id_user'];
		$_SESSION['namauser']     = $r['username'];
		$_SESSION['passuser']     = $r['password'];
		$_SESSION['namalengkap']  = $r['nama_lengkap'];
		$_SESSION['leveluser']     = $r['level'];
		$_SESSION['departemenuser']     = $r['departemenid'];
		$_SESSION['ceckuser']     = $r['ceck'];
		
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$r[id_user]','$username','$thn_jam_sekarang','Log-in To Home')");	
$todayDate = date("Y-m-d");// current date
$notif=mysql_query("SELECT day FROM notification");
$rr=mysql_fetch_array($notif);
//echo "$rr[day]";

//echo "Today: ".$todayDate."<br>";
$now = strtotime(date("Y-m-d"));
$month=$rr['day'];
//Add one day to today
$date = date('Y-m-j', strtotime($month. 'month', $now));
//echo "".$date."<br>";
$tampil=mysql_query("SELECT count(*) as jml FROM dokumen_file where retentiondate <='$date' AND departemenid='$r[departemenid]'");
$r=mysql_fetch_array($tampil);
$jml=$r['jml'];
//echo "$jml";
	if($jml > 0){
		echo "<script>alert('There is $jml data coming near a period of retention.  !!'); window.location = 'media.php?module=home'</script>";
	}
	else{
		header('location:media.php?module=home');
		}
	}else{
	?>
    <script>
	alert('Sorry, Username and password incorrect.');
	window.location.href='index.php';
	</script>
    <?php
	}
			
	}	

?>
