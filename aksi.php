<?php
session_start();
include "inc/inc.koneksi.php";
include "inc/library.php";
include "inc/fungsi_combobox.php";
include "inc/class_paging.php";

$module=$_GET['module'];
$act=$_GET['act'];
// $cek=$_POST['cek'];
// $jumlah=count($cek);

$id_user=$_SESSION['userid'];
$namauser=$_SESSION['namauser'];
// Input user
if ($module=='user' AND $act=='input'){
$pass=md5($_POST['password']);
  mysql_query("INSERT INTO user(username,
                                password,
                                nama_lengkap,
								email,
								no_tlp,
								`level`,
								departemenid) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
								'$_POST[email]',
								'$_POST[no_tlp]',
								'$_POST[level]',
								'$_POST[departemenid]')");
	//role user
	if($_POST['level']=='user'){
	$userid=mysql_insert_id();
	mysql_query("INSERT INTO roleuser(id_user,
                                `create`,
								`read`,
								edit,
								`delete`,
								link,
								approve,
								watermark,
								refisi,
								preview,
								download) 
	                       VALUES('$userid',
								'$_POST[create]',
								'$_POST[read]',
								'$_POST[edit]',
								'$_POST[delete]',
								'$_POST[link]',
								'$_POST[approve]',
								'$_POST[watermark]',
								'$_POST[refisi]',
								'$_POST[preview]',
								'$_POST[download]')");
	}							
		header('location:media.php?module='.$module);
  }
  elseif ($module=='user' AND $act=='update'){
  $pass=md5($_POST['password']);
  // Apabila password tidak diubah
  if (empty($_POST['password'])) {
    mysql_query("UPDATE user SET username     = '$_POST[username]',
                                 nama_lengkap = '$_POST[nama_lengkap]',
                                 email		  = '$_POST[email]',
                                 no_tlp		  = '$_POST[no_tlp]',
                                 `level`		  = '$_POST[level]',
                                 departemenid		  = '$_POST[departemenid]'
                           WHERE id_user      = '$_POST[id_user]'");
	
  }
  else{
  mysql_query("UPDATE user SET username     = '$_POST[username]',
                               password     = '$pass',
                               nama_lengkap	 = '$_POST[nama_lengkap]',
                               email		  = '$_POST[email]',
                               no_tlp		  = '$_POST[no_tlp]',
                               `level`		  = '$_POST[level]',
                               departemenid		  = '$_POST[departemenid]'
                           WHERE id_user      = '$_POST[id_user]'");
  }
  //role user
  $cekrole=mysql_query("select count(id_user) as jml from roleuser where id_user='$_POST[id_user]'");
  $c=mysql_fetch_array($cekrole);
  $jml=$c['jml'];
  if($jml < 1){
  	mysql_query("INSERT INTO roleuser(id_user,
                                `create`,
								`read`,
								edit,
								`delete`,
								link,
								approve,
								watermark,
								refisi,
								preview,
								download) 
	                       VALUES('$_POST[id_user]',
								'$_POST[create]',
								'$_POST[read]',
								'$_POST[edit]',
								'$_POST[delete]',
								'$_POST[link]',
								'$_POST[approve]',
								'$_POST[watermark]',
								'$_POST[refisi]',
								'$_POST[preview]',
								'$_POST[download]')");
	}			
	else{				
  mysql_query("UPDATE roleuser SET id_user = '$_POST[id_user]',
                                  `create` = '$_POST[create]',
								  `read` = '$_POST[read]',
								  edit = '$_POST[edit]',
								  `delete` = '$_POST[delete]',
								  link = '$_POST[link]',
								  approve = '$_POST[approve]',
								  watermark = '$_POST[watermark]',
								  refisi = '$_POST[refisi]',
								  preview = '$_POST[preview]',
								  download = '$_POST[download]'
                           WHERE id_user      = '$_POST[id_user]'");
	}                      
   header('location:media.php?module='.$module);
  }
elseif ($module=='password' AND $act=='update'){
  $passlama=md5($_POST[passwordlama]);
  $pass=md5($_POST['password']);
  $login	=mysql_query("SELECT * FROM user WHERE id_user='$_POST[id_user]'");
  $r = mysql_fetch_array($login);
  // Apabila password tidak diubah
  if ($passlama !=$r[password]) {
   echo "<script Language=\"JavaScript\">
  window.alert (\"Sorry password incorrect\");
  window.location = \"media.php?module=password\";
  </script>')";

  }
  else{
  mysql_query("UPDATE user SET password     = '$pass'
                           WHERE id_user      = '$_POST[id_user]'");
  }
   header('location:media.php?module=home');
  } 
  //type
elseif ($module=='type' AND $act=='input'){
  mysql_query("INSERT INTO mastertype(namatype) 
	                       VALUES('$_POST[namatype]')");
		header('location:media.php?module='.$module);
  }
  elseif ($module=='type' AND $act=='update'){
    mysql_query("UPDATE mastertype SET namatype     = '$_POST[namatype]'
                           WHERE typeid      = '$_POST[typeid]'");
  
   header('location:media.php?module='.$module);
  }
  //delete type
elseif ($module=='type' AND $act=='hapus'){
  mysql_query("DELETE FROM mastertype WHERE typeid='$_GET[id]'");
  
  header('location:media.php?module=type');
} 
 //departemen
elseif ($module=='departemen' AND $act=='input'){
  mysql_query("INSERT INTO masterdepartemen(namadepartemen) 
	                       VALUES('$_POST[namadepartemen]')");
		header('location:media.php?module='.$module);
  }
  elseif ($module=='departemen' AND $act=='update'){
    mysql_query("UPDATE masterdepartemen SET namadepartemen     = '$_POST[namadepartemen]'
                           WHERE departemenid      = '$_POST[departemenid]'");
  
   header('location:media.php?module='.$module);
  }
  //delete departemen
elseif ($module=='departemen' AND $act=='hapus'){
  mysql_query("DELETE FROM masterdepartemen WHERE departemenid='$_GET[id]'");
  
  header('location:media.php?module=departemen');
} 

  
  // Input user
elseif ($module=='user' AND $act=='inputt'){
$pass=md5($_POST[password]);

  mysql_query("INSERT INTO userlogin(username,
                                password,
                                nama_lengkap,
								email,
								tambah,
								ubah,
								hapus,
								data,
								cari) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
								'$_POST[email]',
								'$_POST[add]',
								'$_POST[edit]',
								'$_POST[delete]',
								'$_POST[list]',
								'$_POST[search]')");
		header('location:media.php?module='.$module);
  }
elseif ($module=='upload' AND $act=='input'){
$docid=$_POST[docid];
 function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

 }
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
	UploadImage($nama_file);

$pass=$_POST[password];
  mysql_query("INSERT INTO temp_upload(userid,
                                filename,
                                fileimage,
								inputtgl,
								fileid,
                                retentiondate) 
	                       VALUES('$_POST[userid]',
                                '$_POST[filename]',
								'$nama_file',
								'$tgl_sekarang',
								'$_POST[fileid]',
								'$_POST[retentiondate]')");
echo "<script Language=\"JavaScript\">
  window.alert (\"Data telah berhasil dihapus..?\");
  window.location = \"media.php?module=upload&act=detail_upload&id=$docid\";
  </script>')";
  }
  //input desc
  elseif ($module=='upload' AND $act=='input_desc'){
  $docid=$_POST[docid];
 function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

 }
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
	UploadImage($nama_file);

$pass=$_POST[password];
  mysql_query("INSERT INTO upload_d(docid,
                                namafile,
                                image_d,
								tglupload,
								tglretensi,
                                keterangan) 
	                       VALUES('$_POST[docid]',
                                '$_POST[namafile]',
								'$nama_file',
								'$tgl_sekarang',
								'$_POST[tglretensi]',
								'$_POST[keterangan]')");
 echo "<script Language=\"JavaScript\">
  window.alert (\"Data telah berhasil diisi..?\");
  window.location = \"media.php?module=retensi&act=detail&id=$docid\";
  </script>')";
  }
  //
elseif ($module=='upload' AND $act=='update_desc'){
 //input desc
  $docid=$_POST[docid];
 function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

 }
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
if (empty($lokasi_file)){
    mysql_query("UPDATE upload_d SET docid	= '$_POST[docid]',
									 namafile = '$_POST[namafile]',
									 tglretensi = '$_POST[tglretensi]',
									 keterangan = '$_POST[keterangan]'
								where upl_d = '$_POST[upl_d]'");
                             }
	else{
	UploadImage($nama_file);
	mysql_query("UPDATE upload_d SET docid	= '$_POST[docid]',
									 namafile = '$_POST[namafile]',
									 image_d = '$nama_file',
									 tglretensi = '$_POST[tglretensi]',
									 keterangan = '$_POST[keterangan]'
								where upl_d = '$_POST[upl_d]'");
	}
	echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil di edit ..!?\");
  window.location = \"media.php?module=retensi&act=detail&id=$docid\";
  </script>')";
  }
 //input metadata
elseif ($module=='metadata' AND $act=='input'){
  mysql_query("INSERT INTO jenisfile(namajenis) 
	                       VALUES('$_POST[namajenis]')");
		header('location:media.php?module='.$module);
  }
//update metadata
elseif ($module=='metadata' AND $act=='update'){
  
  mysql_query("UPDATE jenisfile SET namajenis     = '$_POST[namajenis]'
                           WHERE fileid      = '$_POST[fileid]'");
  
   header('location:media.php?module='.$module);
  }
 //input keteranganbantex
elseif ($module=='keteranganbantex' AND $act=='input'){
  mysql_query("INSERT INTO masterfile(fileid,namametadata,ket1,ket2,ket3,ket4,ket5) 
	                       VALUES('$_POST[fileid]','$_POST[namametadata]','$_POST[ket1]','$_POST[ket2]','$_POST[ket3]','$_POST[ket4]','$_POST[ket5]')");
		header('location:media.php?module=metadata');
  }
 //update keteranganbantex
elseif ($module=='keteranganbantex' AND $act=='update'){
  
  mysql_query("UPDATE masterfile SET fileid     = '$_POST[fileid]',
									 namametadata = '$_POST[namametadata]',
									 ket1     	= '$_POST[ket1]',
									 ket2     	= '$_POST[ket2]',
									 ket3     	= '$_POST[ket3]',
									 ket4     	= '$_POST[ket4]',
									 ket5     	= '$_POST[ket5]'
                           WHERE masterid      = '$_POST[masterid]'");
  
   header('location:media.php?module=metadata');
  } 
//delete metadata
elseif ($module=='metadata' AND $act=='hapus'){
  mysql_query("DELETE FROM jenisfile WHERE fileid='$_GET[id]'");
  
  header('location:media.php?module=metadata');
} 
//delete upload
elseif ($module=='upload' AND $act=='hapus'){
  mysql_query("DELETE FROM upload WHERE docid='$_GET[id]'");
  
  header('location:media.php?module=retensi');
}
//delete retensi desc
elseif ($module=='retensi_d' AND $act=='hapus'){
 $edit=mysql_query("SELECT * FROM upload_d WHERE upl_d='$_GET[id]'");
 $r=mysql_fetch_array($edit);

$docid=$r[docid];
  mysql_query("DELETE FROM upload_d WHERE upl_d='$_GET[id]'");
  unlink("./files/$_GET[image_d]");
 echo "<script Language=\"JavaScript\">
  window.alert (\"Data telah berhasil dihapus..?\");
  window.location = \"media.php?module=retensi&act=detail&id=$docid\";
  </script>')";
}
//delete bagian
elseif ($module=='user' AND $act=='hapus'){
  mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
  
  header('location:media.php?module=user');
}
elseif ($module=='user' AND $act=='hapuss'){
  mysql_query("DELETE FROM userlogin WHERE id_userlogin='$_GET[id]'");
  
  header('location:media.php?module=user');
}

elseif ($module=='menu' AND $act=='input'){
  mysql_query("INSERT INTO f_cabang(statusid,namacabang) 
	                       VALUES('$_POST[statusid]','$_POST[namacabang]')");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input Folder=$_POST[namacabang]')");
					   
		header('location:media.php?module=menu&act=detailstatus&statusid='.$_POST[statusid]);
  }
elseif ($module=='menu' AND $act=='updatecabang'){
$fileid=$_POST[fileid]; 
mysql_query("UPDATE f_cabang SET namacabang='$_POST[namacabang]' where cabangid='$_POST[cabangid]'");	
  echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailcabang&cabangid=$_POST[cabangid]&statusid=$_POST[statusid]\";
  </script>')";
  } 
 elseif ($module=='menu' AND $act=='inputbatch'){
  mysql_query("INSERT INTO f_bacthno(cabangid,nobatch) 
	                       VALUES('$_POST[cabangid]','$_POST[batchno]')");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input Folder=$_POST[nobatch]')");
					   
		echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailcabang&cabangid=$_POST[cabangid]&statusid=$_POST[statusid]\";
  </script>')";
  } 
 elseif ($module=='menu' AND $act=='updatebacth'){
mysql_query("UPDATE f_bacthno SET nobatch='$_POST[nobatch]' where batchid='$_POST[batchid]' and cabangid='$_POST[cabangid]'");	
  echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailbatch&batchid=$_POST[batchid]&cabangid=$_POST[cabangid]\";
  </script>')";
  }  
elseif ($module=='menu' AND $act=='inputtahun'){
  mysql_query("INSERT INTO f_tahun(batchid,cabangid,tahun) 
	                       VALUES('$_POST[batchid]','$_POST[cabangid]','$_POST[tahun]')");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input Folder=$_POST[tahun]')");
					   
		echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailbatch&batchid=$_POST[batchid]&cabangid=$_POST[cabangid]\";
  </script>')";
  }   
  elseif ($module=='menu' AND $act=='updatetahun'){
mysql_query("UPDATE f_tahun SET tahun='$_POST[tahun]' where batchid='$_POST[batchid]' and tahunid='$_POST[tahunid]'");	
  echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailtahun&tahunid=$_POST[tahunid]&batchid=$_POST[batchid]&cabangid=$_POST[cabangid]\";
  </script>')";
  }  
 elseif ($module=='menu' AND $act=='inputbulan'){
  mysql_query("INSERT INTO f_bulan(tahunid,batchid,cabangid,bulan) 
	                       VALUES('$_POST[tahunid]','$_POST[batchid]','$_POST[cabangid]','$_POST[bulan]')");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input Folder=$_POST[bulan]')");
					   
		echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailtahun&tahunid=$_POST[tahunid]&batchid=$_POST[batchid]&cabangid=$_POST[cabangid]\";
  </script>')";
  }   
  elseif ($module=='menu' AND $act=='updatebulan'){
mysql_query("UPDATE f_bulan SET bulan='$_POST[bulan]' where bulanid='$_POST[bulanid]' and batchid='$_POST[batchid]' and tahunid='$_POST[tahunid]'");	
  echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailbulan&bulanid=$_POST[bulanid]&tahunid=$_POST[tahunid]&batchid=$_POST[batchid]&cabangid=$_POST[cabangid]\";
  </script>')";
  }  
   elseif ($module=='menu' AND $act=='inputtanggal'){
  mysql_query("INSERT INTO f_tanggal(bulanid,tahunid,batchid,cabangid,tanggal) 
	                       VALUES('$_POST[bulanid]','$_POST[tahunid]','$_POST[batchid]','$_POST[cabangid]','$_POST[tanggal]')");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input Folder=$_POST[tanggal]')");
					   
		echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=menu&act=detailbulan&bulanid=$_POST[bulanid]&tahunid=$_POST[tahunid]&batchid=$_POST[batchid]&cabangid=$_POST[cabangid]\";
  </script>')";
  }   
 elseif ($module=='menu' AND $act=='inputfile12'){
$tanggalid=$_POST[tanggalid];
$bulanid=$_POST[bulanid];
$tahunid=$_POST[tahunid];
$batchid=$_POST[batchid];
$cabangid=$_POST[cabangid];
//echo "$fileid";
//break;
  mysql_query("INSERT INTO upload(id_user,
                                nomtrak,
                                namanasabah,
								notransaksi,
								inputtgl,
								tanggalid,
								bulanid,
								tahunid,
								batchid,
								cabangid,
								pic,
                                username,
								status) 
	                       VALUES('$_POST[id_user]',
                                '$_POST[nomtrak]',
								'$_POST[namanasabah]',
								'$_POST[notransaksi]',
								'$tgl_sekarang',
								'$_POST[tanggalid]',
								'$_POST[bulanid]',
								'$_POST[tahunid]',
								'$_POST[batchid]',
								'$_POST[cabangid]',
								'$_POST[pic]',
								'$_POST[username]',
								'No')");
	// function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $count=count($_FILES["fupload"]["name"]);
	
for($a=0;$a<$count;$a++){
	
 
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	move_uploaded_file($_FILES["fupload"]["tmp_name"][$a], "files/".$_FILES['fupload']['name'][$a]);
	$nama_file   = $_FILES['fupload']['name'];
	
 }

		$namefile = $_POST['namefile'];
		 $metadata_file = $_POST['metadata_file'];
	     //$fupload = $_POST['fupload'];
		 $retentiondate = $_POST['retentiondate'];
		foreach ($namefile as $key => $j) {
		
								//foreach ($tahun as $key1 => $jj) {
									//echo "<p>" . $j . " : " . $dari[$key] . "   " . $tahun[$key] . "</p>";
								
		 mysql_query("INSERT INTO upload_d(nomtrak,
										filename,
										metadata,
										fileimage,
										retentiondate,
										inputtgl) 
								   VALUES('$_POST[nomtrak]',
										 '".$j."',
										 '".$metadata_file[$key]."',
										 '".$nama_file[$key]."',
										 '".$retentiondate[$key]."',
										 '$tgl_sekarang')");							
		
}								
	//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input No Kontrak $_POST[nomtrak]')");

echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil disimpan..!\");
  window.location = \"media.php?module=menu&act=detailfile&tanggalid=$tanggalid&bulanid=$bulanid&tahunid=$tahunid&batchid=$batchid&cabangid=$batchid\";
  </script>')";
  }  
  
   elseif ($module=='menu' AND $act=='inputfile12_d'){
$statusid=$_POST[statusid];
$cabangid=$_POST[cabangid];
//echo "$fileid";
//break;
  mysql_query("INSERT INTO upload(id_user,
                                nomtrak,
                                namanasabah,
								notransaksi,
								inputtgl,
								cabangid,
								pic,
                                username,
								status) 
	                       VALUES('$_POST[id_user]',
                                '$_POST[nomtrak]',
								'$_POST[namanasabah]',
								'$_POST[notransaksi]',
								'$tgl_sekarang',
								'$_POST[cabangid]',
								'$_POST[pic]',
								'$_POST[username]',
								'No')");
	// function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $count=count($_FILES["fupload"]["name"]);
	
for($a=0;$a<$count;$a++){
	
 
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	move_uploaded_file($_FILES["fupload"]["tmp_name"][$a], "files/".$_FILES['fupload']['name'][$a]);
	$nama_file   = $_FILES['fupload']['name'];
	
 }

		$namefile = $_POST['namefile'];
		 $metadata_file = $_POST['metadata_file'];
	     //$fupload = $_POST['fupload'];
		 $retentiondate = $_POST['retentiondate'];
		foreach ($namefile as $key => $j) {
		
								//foreach ($tahun as $key1 => $jj) {
									//echo "<p>" . $j . " : " . $dari[$key] . "   " . $tahun[$key] . "</p>";
								
		 mysql_query("INSERT INTO upload_d(nomtrak,
										filename,
										metadata,
										fileimage,
										retentiondate,
										inputtgl) 
								   VALUES('$_POST[nomtrak]',
										 '".$j."',
										 '".$metadata_file[$key]."',
										 '".$nama_file[$key]."',
										 '".$retentiondate[$key]."',
										 '$tgl_sekarang')");							
		
}								
	//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input No Kontrak $_POST[nomtrak]')");

echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil disimpan..!\");
  window.location = \"media.php?module=menu&act=detailcabang2&cabangid=$cabangid&statusid=$statusid\";
  </script>')";
  }  
   //edit file U
  elseif ($module=='menu' AND $act=='editfileU'){
//$docid=$_POST[docid];
$tampil=mysql_query("select * from upload where docid='$_POST[docid]'");
$r=mysql_fetch_array($tampil);
$tanggalid=$_POST[tanggalid];
$bulanid=$_POST[bulanid];
$tahunid=$_POST[tahunid];
$batchid=$_POST[batchid];
$cabangid=$_POST[cabangid];
 
  mysql_query("UPDATE upload SET nomtrak = '$_POST[nomtrak]',
                                namanasabah	 = '$_POST[namanasabah]',
								notransaksi = '$_POST[notransaksi]',
								pic		 = '$_POST[pic]',
								username = '$_POST[username]'
						  where docid = '$_POST[docid]' AND nomtrak='$_POST[nomtrakk]'");
 mysql_query("UPDATE upload_d SET nomtrak = '$_POST[nomtrak]'
						   where nomtrak='$_POST[nomtrakk]'");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update Data Nomor kontrak)");
  				  
echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil di edit..\");
  window.location = \"media.php?module=menu&act=detailfile&tanggalid=$tanggalid&bulanid=$bulanid&tahunid=$tahunid&batchid=$batchid&cabangid=$batchid\";
  </script>')";
  }   
  
    //edit file U detail
  elseif ($module=='menu' AND $act=='editfileU_db'){
//$docid=$_POST[docid];
$tampil=mysql_query("select * from upload where docid='$_POST[docid]'");
$r=mysql_fetch_array($tampil);
$statusid=$_POST[batchid];
$cabangid=$_POST[cabangid];
 
  mysql_query("UPDATE upload SET nomtrak = '$_POST[nomtrak]',
                                namanasabah	 = '$_POST[namanasabah]',
								notransaksi = '$_POST[notransaksi]',
								pic		 = '$_POST[pic]',
								username = '$_POST[username]'
						  where docid = '$_POST[docid]' AND nomtrak='$_POST[nomtrakk]'");
 mysql_query("UPDATE upload_d SET nomtrak = '$_POST[nomtrak]'
						   where nomtrak='$_POST[nomtrakk]'");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update Data Nomor kontrak)");
  				  
echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil di edit..\");
  window.location = \"media.php?module=menu&act=detailcabang2&cabangid=$cabangid&statusid=$statusid\";
  </script>')";
  }   
 elseif ($module=='menu' AND $act=='editfileU_detail_2'){
//$docid=$_POST[docid];
$tampil=mysql_query("select * from upload_d where docid_d='$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
$r=mysql_fetch_array($tampil); 
$nomtrak=$_POST[nomtrak];
$docid=$_POST[docid];
$nomkot=$_POST[nomkot];
$filename_d=$_POST[filename_d];
 function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

 }
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
	// Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    move_uploaded_file($lokasi_file,"files/$nama_file");
	UploadImage($nama_file);

$pass=$_POST[password];

  mysql_query("UPDATE upload_d SET filename = '$_POST[namefile]',
                                metadata = '$_POST[metadata_file]',
								fileimage = '$nama_file',
								inputtgl  = '$tgl_sekarang',
								retentiondate = '$_POST[retentiondate]'
						  where docid_d = '$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
	//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update Upload file=$nama_file')");
 unlink("files/$r[fileimage]");
  }
  else {
  mysql_query("UPDATE upload_d SET filename = '$_POST[namefile]',
                                metadata = '$_POST[metadata_file]',
								inputtgl  = '$tgl_sekarang',
								retentiondate = '$_POST[retentiondate]'
						  where docid_d = '$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update filename file=$_POST[filename]')");
  	}				  
echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil di edit ..!\");
  window.location = \"media.php?module=menu&act=detailfile_d&docid=$docid&nomtrak=$nomtrak\";
  </script>')";
  } 
  elseif ($module=='menu' AND $act=='editfileU_detail_2_d'){
//$docid=$_POST[docid];
$tampil=mysql_query("select * from upload_d where docid_d='$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
$r=mysql_fetch_array($tampil); 

$nomtrak=$_POST[nomtrak];
$docid=$_POST[docid];

$nomkot=$_POST[nomkot];
$filename_d=$_POST[filename_d];
 function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

 }
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
	// Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    move_uploaded_file($lokasi_file,"files/$nama_file");
	UploadImage($nama_file);
  mysql_query("UPDATE upload_d SET filename = '$_POST[namefile]',
                                metadata = '$_POST[metadata_file]',
								fileimage = '$nama_file',
								inputtgl  = '$tgl_sekarang',
								retentiondate = '$_POST[retentiondate]'
						  where docid_d = '$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
	//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update Upload file=$nama_file')");
 unlink("files/$r[fileimage]");
  }
  else {
  mysql_query("UPDATE upload_d SET filename = '$_POST[namefile]',
                                metadata = '$_POST[metadata_file]',
								inputtgl  = '$tgl_sekarang',
								retentiondate = '$_POST[retentiondate]'
						  where docid_d = '$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update filename file=$_POST[filename]')");
  	}				  
echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil di edit ..!\");
  window.location = \"media.php?module=menu&act=detailfile_d_b&docid=$docid&nomtrak=$nomtrak\";
  </script>')";
  } 
  elseif ($module=='menu' AND $act=='editfileU_detail_2_r'){
//$docid=$_POST[docid];
$tampil=mysql_query("select * from upload_d where docid_d='$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
$r=mysql_fetch_array($tampil); 
$nomtrak=$_POST[nomtrak];
$docid=$_POST[docid];
$nomkot=$_POST[nomkot];
$filename_d=$_POST[filename_d];
 function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "./files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

 }
    $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
	// Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    move_uploaded_file($lokasi_file,"files/$nama_file");
	UploadImage($nama_file);

$pass=$_POST[password];

  mysql_query("UPDATE upload_d SET filename = '$_POST[namefile]',
                                metadata = '$_POST[metadata_file]',
								fileimage = '$nama_file',
								inputtgl  = '$tgl_sekarang',
								retentiondate = '$_POST[retentiondate]'
						  where docid_d = '$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
	//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update history document')");
 unlink("files/$r[fileimage]");
  }
  else {
  mysql_query("UPDATE upload_d SET filename = '$_POST[namefile]',
                                metadata = '$_POST[metadata_file]',
								inputtgl  = '$tgl_sekarang',
								retentiondate = '$_POST[retentiondate]'
						  where docid_d = '$_POST[docid_d]' AND nomtrak='$_POST[nomtrak]'");
	mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Update filename file=$_POST[filename]')");
  	}				  
echo "<script Language=\"JavaScript\">
  window.alert (\"Data Berhasil di edit ..!\");
  window.location = \"media.php?module=historydocument\";
  </script>')";
  } 
// Hapus file detail
elseif ($module=='menu' AND $act=='hapusfileU_detail'){
$data=mysql_fetch_array(mysql_query("SELECT * FROM upload_d WHERE docid_d='$_GET[docid_d]' AND nomtrak='$_GET[nomtrak]'"));
   
    if ($data[fileimage]!=''){
     mysql_query("DELETE FROM upload_d WHERE docid_d='$_GET[docid_d]' AND nomtrak='$_GET[nomtrak]'");
     unlink("files/$_GET[fileimage]");      
  }
  else{
     mysql_query("DELETE FROM upload_d WHERE docid_d='$_GET[docid_d]' AND nomtrak='$_GET[nomtrak]'");
  }

  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Hapus fileimage=$_GET[fileimage]')");
 
 echo "<script Language=\"JavaScript\">
   window.location = \"media.php?module=menu&act=detailfile_d&docid=$_GET[docid]&nomtrak=$_GET[nomtrak]\";
  </script>')";
} 
// Hapus file detail
elseif ($module=='menu' AND $act=='hapusfileU_detail_d'){
$data=mysql_fetch_array(mysql_query("SELECT * FROM upload_d WHERE docid_d='$_GET[docid_d]' AND nomtrak='$_GET[nomtrak]'"));
   
    if ($data[fileimage]!=''){
     mysql_query("DELETE FROM upload_d WHERE docid_d='$_GET[docid_d]' AND nomtrak='$_GET[nomtrak]'");
     unlink("files/$_GET[fileimage]");      
  }
  else{
     mysql_query("DELETE FROM upload_d WHERE docid_d='$_GET[docid_d]' AND nomtrak='$_GET[nomtrak]'");
  }

  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Hapus fileimage=$_GET[fileimage]')");
 
 echo "<script Language=\"JavaScript\">
   window.location = \"media.php?module=menu&act=detailfile_d_b&docid=$_GET[docid]&nomtrak=$_GET[nomtrak]\";
  </script>')";
} 
 




  elseif ($module=='menu' AND $act=='tambahdokumen'){
	mysql_query("INSERT INTO dokumen(id_parent,nama_dokumen) 
							 VALUES('$_POST[id_parent]','$_POST[nama_dokumen]')");
	//   mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Input Folder=$_POST[nobatch]')");
	// break;					 
		  echo "<script Language=\"JavaScript\">
	window.location = \"media.php?module=menu\";
	</script>')";
	} 

	elseif ($module=='menu' AND $act=='tambahfile'){
		$docid=isset($_POST['docid']) ? $_POST['docid']:'';
		if($docid==""){
			echo "<script Language=\"JavaScript\">
			window.alert (\"Data Gagal disimpan ..!\");
			window.location = \"media.php?module=menu&act=tambahfile\";
			</script>')";
		}
		else{
		function UploadImage($fupload_name){
			//direktori gambar
			$vdir_upload = "./files/";
			$vfile_upload = $vdir_upload . $fupload_name;
		  
			//Simpan gambar dalam ukuran sebenarnya
			move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
		  
		   }
			//   $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
			  $lokasi_file = $_FILES['fupload']['tmp_name'];
			  $nama_file   = $_FILES['fupload']['name'];
			  UploadImage($nama_file);
		// $namafile   = $_FILES['fupload']['name'];
		$filename = $_POST['filename'];
		$metadata_file = $_POST['metadata'];
	     //$fupload = $_POST['fupload'];
		 $tgldokumen = $_POST['tgl_dokumen'];
		 $retentiondate = $_POST['tgl_expired'];
		 $keterangan = $_POST['keterangan'];
		 $komentar = $_POST['komentar'];
		 $pic = $_POST['pic'];
		 $iduser = $_POST['iduser'];
// break;
		 mysql_query("INSERT INTO dokumen_file(docid,
						filename,
						metadata,
						fileimage,
						tgl_dokumen,
						retentiondate,
						keterangan,
						komentar,
						departemenid,
						recmod,
						approve,
						pic,
						id_user) 
					VALUES('$_POST[docid]',
						'$_POST[filename]',
						'$_POST[metadata]',
						'$nama_file',
						'$_POST[tgl_dokumen]',
						'$_POST[tgl_expired]',
						'$_POST[keterangan]',
						'$_POST[komentar]',
						'$_POST[departemenid]',
						'$recmod',
						'1',
						'$_POST[pic]',
						'$_POST[id_user]')");		 
			 //level permission
					
			//  $docid=mysql_insert_id();
			//  $read =isset($_POST['read']) ? $_POST['read']:'0';
			//  $edit =isset($_POST['edit']) ? $_POST['edit']:'0';
			//  $delete =isset($_POST['delete']) ? $_POST['delete']:'0';
			//  $print =isset($_POST['print']) ? $_POST['print']:'0';
			//  $preview =isset($_POST['preview']) ? $_POST['preview']:'0';
			//  $download =isset($_POST['download']) ? $_POST['download']:'0';
			// //  $link =isset ($_POST['link']) ? $_POST['link']:'0';
			// //  $approve =isset ($_POST['approve']) ? $_POST['approve']:'0';
			// //  $refisi =isset ($_POST['refisi']) ? $_POST['refisi']:'0';
			// // echo $read;
			//  foreach ($_POST['iddepartemen'] as $key => $j) {
			// 	// echo $key;
			// 	// $docid1=mysql_insert_id();
			// 	$read1 =isset($read[$key]) ? $read[$key]:'0';
			// 	echo $read1;
			// 	$edit1 =isset($edit[$key]) ? $edit[$key]:'0';
			// 	$delete1 =isset($delete[$key]) ? $delete[$key]:'0';
			// 	$print1 =isset($print[$key]) ? $print[$key]:'0';
			// 	$preview1 =isset($preview[$key]) ? $preview[$key]:'0';
			// 	$download1 =isset($download[$key]) ? $download[$key]:'0';
		// break;
			//  mysql_query("INSERT INTO departemenpermission(`departemenid`,
			// 			 docid_d,
			// 			 `read`,
			// 			 `edit`,
			// 			 `delete`,
			// 			 `print`,
			// 			 `preview`,
			// 			 `download`) 
			// 		 VALUES('".$j."',
			// 			 '".$docid."',
			// 			 '".$read[$key]."',
			// 			 '".$edit[$key]."',
			// 			 '".$delete[$key]."',
			// 			 '".$print[$key]."',
			// 			 '".$preview[$key]."',
			// 			 '".$download[$key]."')"); 
			//  }
				//  break;
			  echo "<script Language=\"JavaScript\">
		window.location = \"media.php?module=menu\";
		</script>')";
		} 
	}

		elseif ($module=='menu' AND $act=='tambahfiledetail'){
				function UploadImage($fupload_name){
					//direktori gambar
					$vdir_upload = "./files/";
					$vfile_upload = $vdir_upload . $fupload_name;
				  
					//Simpan gambar dalam ukuran sebenarnya
					move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
				  
				   }
					  $lokasi_file = $_FILES['fupload']['tmp_name'];
					  $nama_file   = $_FILES['fupload']['name'];
					  UploadImage($nama_file);
				// $namafile   = $_FILES['fupload']['name'];
				 $filename = $_POST['filename'];
				 $metadata_file = $_POST['metadata'];
				 //$fupload = $_POST['fupload'];
				 $tgldokumen = $_POST['tgl_dokumen'];
				 $retentiondate = $_POST['tgl_expired'];
				 $keterangan = $_POST['keterangan'];
				 $komentar = $_POST['komentar'];
				 $pic = $_POST['pic'];
				 $iduser = $_POST['iduser'];
		// break;
		if($_SESSION['leveluser']=='admin'){
				 mysql_query("INSERT INTO dokumen_file(docid,
								filename,
								metadata,
								fileimage,
								tgl_dokumen,
								retentiondate,
								keterangan,
								komentar,
								departemenid,
								pic,
								recmod,
								approve,
								id_user) 
							VALUES('$_POST[docid]',
								'$_POST[filename]',
								'$_POST[metadata]',
								'$nama_file',
								'$_POST[tgl_dokumen]',
								'$_POST[tgl_expired]',
								'$_POST[keterangan]',
								'$_POST[komentar]',
								'$_POST[departemenid]',
								'$_POST[pic]',
								'$recmod',
								'1',
								'$_POST[id_user]')");
		}
		else{
			mysql_query("INSERT INTO dokumen_file(docid,
								filename,
								metadata,
								fileimage,
								tgl_dokumen,
								retentiondate,
								keterangan,
								komentar,
								departemenid,
								pic,
								recmod,
								id_user) 
							VALUES('$_POST[docid]',
								'$_POST[filename]',
								'$_POST[metadata]',
								'$nama_file',
								'$_POST[tgl_dokumen]',
								'$_POST[tgl_expired]',
								'$_POST[keterangan]',
								'$_POST[komentar]',
								'$_POST[departemenid]',
								'$_POST[pic]',
								'$recmod',
								'$_POST[id_user]')");
		}
								
					//level permission
					
					
					  echo "<script Language=\"JavaScript\">
				window.location = \"media.php?module=menu&act=listdokumen&docid=$_POST[docid]\";
				</script>')";
				} 
				elseif ($module=='menu' AND $act=='editfiledetail'){
					//$docid=$_POST[docid];
					$tampil=mysql_query("select * from dokumen_file where docid_d='$_POST[docid_d]' AND docid='$_POST[docid]'");
					$r=mysql_fetch_array($tampil); 
					
					$docid_d=$_POST['docid_d'];
					$docid=$_POST['docid'];
					
					 function UploadImage($fupload_name){
					  //direktori gambar
					  $vdir_upload = "./files/";
					  $vfile_upload = $vdir_upload . $fupload_name;
					
					  //Simpan gambar dalam ukuran sebenarnya
					  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
					
					 }
						$lokasi_file = $_FILES['fupload']['tmp_name'];
						$nama_file   = $_FILES['fupload']['name'];
						// Apabila ada gambar yang diupload
					  if (!empty($lokasi_file)){
						move_uploaded_file($lokasi_file,"files/$nama_file");
						UploadImage($nama_file);
					    mysql_query("UPDATE dokumen_file SET filename = '$_POST[filename]',
													metadata = '$_POST[metadata]',
													fileimage = '$nama_file',
													tgl_dokumen  = '$_POST[tgl_dokumen]',
													retentiondate = '$_POST[tgl_expired]',
													keterangan = '$_POST[keterangan]',
													komentar = '$_POST[komentar]',
													pic = '$_POST[pic]',
													recmod ='$recmod'
											  where docid_d = '$docid_d' AND docid='$docid'");
						//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
					 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$recmod','Update Upload file=$nama_file')");
					 unlink("files/$r[fileimage]");
					  }
					  else {
						mysql_query("UPDATE dokumen_file SET filename = '$_POST[filename]',
											metadata = '$_POST[metadata]',
											tgl_dokumen  = '$_POST[tgl_dokumen]',
											retentiondate = '$_POST[tgl_expired]',
											keterangan = '$_POST[keterangan]',
											komentar = '$_POST[komentar]',
											pic = '$_POST[pic]',
											recmod ='$recmod'
									where docid_d = '$docid_d' AND docid='$docid'");
						mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$recmod','Update filename file=$_POST[filename]')");
						  }	
					//role permission
					
				    $read =isset ($_POST['read']) ? $_POST['read']:'0';
				    $edit =isset ($_POST['edit']) ? $_POST['edit']:'0';
				    $delete =isset ($_POST['delete']) ? $_POST['delete']:'0';
				    $print =isset ($_POST['print']) ? $_POST['print']:'0';
				    $preview =isset ($_POST['preview']) ? $_POST['preview']:'0';
				    $download =isset ($_POST['download']) ? $_POST['download']:'0';
				    $link =isset ($_POST['link']) ? $_POST['link']:'0';
				    $approve =isset ($_POST['approve']) ? $_POST['approve']:'0';
				    $refisi =isset ($_POST['refisi']) ? $_POST['refisi']:'0';
					$permission=mysql_query("select count(docid_d) as jml from departemenpermission where docid_d='$_POST[docid_d]'");
					$p=mysql_fetch_array($permission); 
					$jml=$p['jml'];
					if($jml < 1 ){
					// mysql_query("INSERT INTO levelpermission(`level`,
					// 			docid_d,
					// 			`read`,
					// 			`edit`,
					// 			`delete`,
					// 			`print`,
					// 			`preview`,
					// 			`download`) 
					// 		VALUES('".$_POST['level']."',
					// 			'".$docid_d."',
					// 			'".$read."',
					// 			'".$edit."',
					// 			'".$delete."',
					// 			'".$print."',
					// 			'".$preview."',
					// 			'".$download."')");
							foreach ($_POST['iddepartemen'] as $key => $j) {
								// $docid1=mysql_insert_id();
								$read1 =isset($read[$key]) ? $read[$key]:'0';
								$edit1 =isset($edit[$key]) ? $edit[$key]:'0';
								$delete1 =isset($delete[$key]) ? $delete[$key]:'0';
								$print1 =isset($print[$key]) ? $print[$key]:'0';
								$preview1 =isset($preview[$key]) ? $preview[$key]:'0';
								$download1 =isset($download[$key]) ? $download[$key]:'0';
						// break;
							mysql_query("INSERT INTO departemenpermission(`departemenid`,
										docid_d,
										`read`,
										`edit`,
										`delete`,
										`print`,
										`preview`,
										`download`) 
									VALUES('".$j."',
										'".$docid_d."',
										'".$read1."',
										'".$edit1."',
										'".$delete1."',
										'".$print1."',
										'".$preview1."',
										'".$download1."')"); 
							}
					}
					else{
						foreach ($_POST['iddepartemen'] as $key => $j) {
							// $docid1=mysql_insert_id();
							$read1 =isset($read[$key]) ? $read[$key]:'0';
							$edit1 =isset($edit[$key]) ? $edit[$key]:'0';
							$delete1 =isset($delete[$key]) ? $delete[$key]:'0';
							$print1 =isset($print[$key]) ? $print[$key]:'0';
							$preview1 =isset($preview[$key]) ? $preview[$key]:'0';
							$download1 =isset($download[$key]) ? $download[$key]:'0';
						mysql_query("UPDATE departemenpermission SET `departemenid` = '".$j."', 
									docid_d = '".$docid_d."', 
									`read` = '".$read1."', 
									`edit` = '".$edit1."', 
									`delete` = '".$delete1."', 
									`print` = '".$print1."', 
									`preview` = '".$preview1."', 
									`download` = '".$download1."'
									where docid_d = '".$docid_d."' AND departemenid='".$j."'");
						}
					}
					echo "<script Language=\"JavaScript\">
					  window.alert (\"Data Berhasil di edit ..!\");
					  window.location = \"media.php?module=menu&act=listdokumen&docid=$docid\";
					  </script>";
						}
// Hapus file detail
elseif ($module=='menu' AND $act=='deletedokfile'){
	$data=mysql_fetch_array(mysql_query("SELECT * FROM dokumen_file WHERE docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'"));
	   
		if ($data['fileimage']!=''){
		 mysql_query("DELETE FROM dokumen_file WHERE docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'");
		 unlink("files/$_GET[fileimage]");      
	  }
	  else{
		 mysql_query("DELETE FROM dokumen_file WHERE docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'");
	  }
	
	  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Hapus fileimage=$_GET[fileimage]')");
	 
	 echo "<script Language=\"JavaScript\">
	   window.location = \"media.php?module=menu&act=listdokumen&docid=$_GET[docid]\";
	  </script>')";
	} 
	elseif ($module=='menu' AND $act=='deletewatermark'){
		$data=mysql_fetch_array(mysql_query("SELECT * FROM dokumen_file WHERE docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'"));
		   $namafile=str_replace('watermark_', '', $_GET['fileimage']);
		//    echo $namafile;
		//    break;
			if ($data['fileimage']!=''){
			 mysql_query("UPDATE dokumen_file SET fileimage='$namafile', watermark='0' WHERE docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'");
			 unlink("files/$_GET[fileimage]");      
		  }
		  else{
			 mysql_query("UPDATE dokumen_file SET fileimage='$namafile', watermark='0' WHERE docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'");
		  }
		  mysql_query("DELETE FROM dokumen_file_watermark WHERE docid_d='$_GET[docid_d]'");
		  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Hapus watermark=$_GET[fileimage]')");
		 
		 echo "<script Language=\"JavaScript\">
		   window.location = \"media.php?module=menu&act=listdokumen&docid=$_GET[docid]\";
		  </script>')";
		} 
	elseif ($module=='menu' AND $act=='refisifiledetail'){
		//$docid=$_POST[docid];
		$tampil=mysql_query("select * from dokumen_file where docid_d='$_POST[docid_d]' AND docid='$_POST[docid]'");
		$r=mysql_fetch_array($tampil); 
		
		//insert file lama ke table refisi
		mysql_query("INSERT INTO dokumen_file_refisi(docid_d,
								fileimage,
								recmod,
								id_user) 
							VALUES('$r[docid_d]',
								'$r[fileimage]',
								'$recmod',
								'$_POST[id_user]')");	

		//update dokumen file refisi ke table file
		$docid_d=$_POST['docid_d'];
		$docid=$_POST['docid'];
		
		 function UploadImage($fupload_name){
		  //direktori gambar
		  $vdir_upload = "./files/";
		  $vfile_upload = $vdir_upload . $fupload_name;
		
		  //Simpan gambar dalam ukuran sebenarnya
		  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
		
		 }
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$nama_file   = "refisi_".$_FILES['fupload']['name'];
			// Apabila ada gambar yang diupload
		  	move_uploaded_file($lokasi_file,"files/$nama_file");
			UploadImage($nama_file);
			mysql_query("UPDATE dokumen_file SET filename = '$_POST[filename]',
										metadata = '$_POST[metadata]',
										fileimage = '$nama_file',
										recmod ='$recmod'
								  where docid_d = '$docid_d' AND docid='$docid'");
			//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
		 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$recmod','Refisi Upload file=$nama_file')");
		 	  
		echo "<script Language=\"JavaScript\">
		  window.alert (\"Data Berhasil di edit ..!\");
		  window.location = \"media.php?module=menu&act=listdokumen&docid=$docid\";
		  </script>";
			}


			elseif ($module=='menu' AND $act=='linkfiledetail'){
				$docid_d=$_POST['docid_d'];
				$docid=$_POST['docid'];
				function UploadImage($fupload_name){
					//direktori gambar
					$vdir_upload = "./files/link/";
					$vfile_upload = $vdir_upload . $fupload_name;
				  
					//Simpan gambar dalam ukuran sebenarnya
					move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
				  
				   }
					  $lokasi_file = $_FILES['fupload']['tmp_name'];
					  $nama_file   = $_FILES['fupload']['name'];
					  UploadImage($nama_file);
				// $namafile   = $_FILES['fupload']['name'];
				 $filename = $_POST['filename'];
				 $metadata_file = $_POST['metadata'];
				 $tgldokumen = $_POST['tgl_dokumen'];
				 $retentiondate = $_POST['tgl_expired'];
				 $keterangan = $_POST['keterangan'];
				 $pic = $_POST['pic'];
				 $iduser = $_POST['iduser'];
		// break;
				 mysql_query("INSERT INTO dokumen_file_link(docid_d,
				 				docid,
								filename,
								metadata,
								fileimage,
								tgl_dokumen,
								retentiondate,
								keterangan,
								pic,
								recmod,
								id_user) 
							VALUES('$_POST[docid_d]',
								'$_POST[docid]',
								'$_POST[filename]',
								'$_POST[metadata]',
								'$nama_file',
								'$_POST[tgl_dokumen]',
								'$_POST[tgl_expired]',
								'$_POST[keterangan]',
								'$_POST[pic]',
								'$recmod',
								'$_POST[id_user]')");		 
					  echo "<script Language=\"JavaScript\">
				window.location = \"media.php?module=menu&act=linkdokfile&docid_d=$docid_d&docid=$docid\";
				</script>')";
				} 
				elseif ($module=='menu' AND $act=='editlinkfiledetail'){
					//$docid=$_POST[docid];
					$tampil=mysql_query("select * from dokumen_file_link where docid_link='$_POST[docid_link]' AND docid_d='$_POST[docid_d]' AND docid='$_POST[docid]'");
					$r=mysql_fetch_array($tampil); 
					
					$docid_link=$_POST['docid_link'];
					$docid_d=$_POST['docid_d'];
					$docid=$_POST['docid'];
					
					 function UploadImage($fupload_name){
					  //direktori gambar
					  $vdir_upload = "./files/";
					  $vfile_upload = $vdir_upload . $fupload_name;
					
					  //Simpan gambar dalam ukuran sebenarnya
					  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
					
					 }
						$lokasi_file = $_FILES['fupload']['tmp_name'];
						$nama_file   = $_FILES['fupload']['name'];
						// Apabila ada gambar yang diupload
					  if (!empty($lokasi_file)){
						move_uploaded_file($lokasi_file,"files/link/$nama_file");
						UploadImage($nama_file);
					    mysql_query("UPDATE dokumen_file_link SET filename = '$_POST[filename]',
													metadata = '$_POST[metadata]',
													fileimage = '$nama_file',
													tgl_dokumen  = '$_POST[tgl_dokumen]',
													retentiondate = '$_POST[tgl_expired]',
													keterangan = '$_POST[keterangan]',
													pic = '$_POST[pic]',
													recmod ='$recmod'
											  where docid_link = '$docid_link' AND docid_d='$_POST[docid_d]' AND docid='$docid'");
						//mysql_query("UPDATE jenisfile SET status2='1' where fileid='$_POST[fileid]'");		
					 mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$recmod','Update Upload link file=$nama_file')");
					 unlink("files/link/$r[fileimage]");
					  }
					  else {
						mysql_query("UPDATE dokumen_file_link SET filename = '$_POST[filename]',
											metadata = '$_POST[metadata]',
											tgl_dokumen  = '$_POST[tgl_dokumen]',
											retentiondate = '$_POST[tgl_expired]',
											keterangan = '$_POST[keterangan]',
											pic = '$_POST[pic]',
											recmod ='$recmod'
									where docid_link = '$docid_link' AND docid_d='$_POST[docid_d]' AND docid='$docid'");
						mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$recmod','Update filename link file=$_POST[filename]')");
						  }				  
					echo "<script Language=\"JavaScript\">
					  window.alert (\"Data Berhasil di edit ..!\");
					  window.location = \"media.php?module=menu&act=linkdokfile&docid_d=$docid_d&docid=$docid\";
					  </script>";
						}
	// Hapus file detail
elseif ($module=='menu' AND $act=='deletelinkdokfile'){
	$data=mysql_fetch_array(mysql_query("SELECT * FROM dokumen_file_link WHERE docid_link='$_GET[docid_link]' AND docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'"));
	   
		if ($data['fileimage']!=''){
		 mysql_query("DELETE FROM dokumen_file_link WHERE docid_link='$_GET[docid_link]' AND docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'");
		 unlink("files/link/$_GET[fileimage]");      
	  }
	  else{
		 mysql_query("DELETE FROM dokumen_file_link WHERE docid_link='$_GET[docid_link]' AND docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'");
	  }
	
	  mysql_query("INSERT INTO log (id_user, username, tgl_log, keterangan) values('$id_user','$namauser','$thn_jam_sekarang','Hapus fileimage=$_GET[fileimage] Link File')");
	 
	 echo "<script Language=\"JavaScript\">
	   window.location = \"media.php?module=menu&act=linkdokfile&docid_d=$_GET[docid_d]&docid=$_GET[docid]\";
	  </script>')";
	} 

	elseif ($module=='verifikasi' AND $act=='approve'){
					mysql_query("UPDATE dokumen_file SET approve ='1'
					where docid_d='$_GET[docid_d]' AND docid='$_GET[docid]'");
	 echo "<script Language=\"JavaScript\">
	 window.location = \"media.php?module=verifikasi\";
	</script>')";
	}
?>

