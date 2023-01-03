<script language="javascript">
//---------------------------------
function validasi(){
  if (tambah.id_user.value == ""){
    alert("Username masih kosong, harus di isi !!");
    tambah.id_user.focus();
    return (false);
  }
     
  if (tambah.password.value == ""){
    alert("Password masih kosong, harus di isi !!");
   tambah.password.focus();
    return (false);
  }

  if (tambah.nama_lengkap.value == ""){
    alert("Nama lengkap masih kosong, harus di isi !!");
    tambah.nama_lengkap.focus();
    return (false);
  }

  return (true);
}

//----------------------------------




</script>

<?php
$aksi="modul/mod_password/aksi";
switch($_GET[act]){
  // Tampil User
  default:
  
     echo "<h2>Change Password</h2>
          <form name='edit' method=POST action='./aksi.php?module=password&act=update'>";
          		
          echo "<table>";
		  $warn=$_GET[warning];
		  $err=$_GET[err];
				if($err=="salah")
				{
				echo "<center><img src=\"images/salah.gif\"><br><font color=red font size=2 face=arial><b>Password Lama Anda Salah</b></font><br></center>";
				}
				else if($warn=="kosong")
		      {
		echo "<center><img src=\"images/salah.gif\"><br><font color=red font size=2 face=arial><b>Nomor ID atau Password masih kosong</b></font><br></center>";
		}
		elseif($err=="sukses")
		{
		echo "<center><img src=\"images/yes.png\"><br><font color=blue font size=2 face=arial><b>Anda Telah sukses Keluar Sistem </center>";
		}
		  echo "<input type=hidden name='id_user' value=$_SESSION[userid] size=30>
		  
          <tr><td>Old Password</td>     <td> : <input type=text name='passwordlama' size=30></td></tr>
          <tr><td>New Password</td>     <td> : <input type=text name='password'> *) </td></tr>";
          

    echo  "<tr><td colspan=2 align=center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
}
?>
