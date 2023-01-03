 <link rel="stylesheet" href="style.css" /> 
 <?php
 session_start();

switch($_GET[act]){
  // Tampil user
  default:
  if($_SESSION[leveluser]=='admin'){
    echo "<fieldset><legend><b>Master User</b></legend><br>
	<a href='?module=user&act=tambahuser'><img src=images/add2.gif></a><p>
		  <table>
          <tr><th>no</th><th>username</th><th>name</th><th>level</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM user ORDER BY id_user");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
		     <td>$r[nama_lengkap]</a></td>
			 <td>$r[level]</td>
             <td><a href=?module=user&act=edituser&id=$r[id_user]><img src=images/icon_edit.gif border=0 border=0 title='edit'></a> | 
	             <a href='./aksi.php?module=user&act=hapus&id=$r[id_user]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
			     <img src=images/icon_delete.gif border=0 title='hapus'></a> 
             </td></tr>";
      $no++;
    }
	}
	else{
	echo "Maaf Anda tidak punya hak";
	}
    echo "</fieldset></table>";
	
		
    break;
  
  case "tambahuser":
    echo "<h2>Tambah user</h2>
          <form name='tambah' method=POST action='./aksi.php?module=user&act=input' onSubmit=\"return validasi()\">
          <fieldset><legend> Please fill truly </legend>
		  <table>
          <tr><td>Username</td>     <td> : <input type=text name='username' onBlur='validate(this)'></td></tr>
          <tr><td>Password</td>     <td> : <input type=password name='password'></td></tr>
		  <tr><td>Complete name</td> <td> : <input type=text name='nama_lengkap'></td></tr>
		  <tr><td>Email</td> <td> : <input type=text name='email'></td></tr>
		  <tr><td>No Telephone</td> <td> : <input type=text name='no_tlp'></td></tr>
		  <tr><td>Level</td>     	<td> : <input type=radio name='level' value=admin>Administrator
											<input type=radio name='level' value=user>User
											</td></tr>";
			echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit user</h2>
          <form name='ganti' method=POST action='./aksi.php?module=user&act=update' onSubmit=\"return edit()\">
          <fieldset><legend> Please fill truly </legend>
		  <table>
		  <input type=hidden name='id_user' value='$r[id_user]'>
		  <tr><td>username</td>     <td> : <input type=text name='username' value='$r[username]' onBlur='validate(this)'></td></tr>
          <tr><td>Password</td>     <td> : <input type=password name='password' value='$r[password]'></td></tr>
		  <tr><td>Nama Lengkap</td>     <td> : <input type=text name='nama_lengkap' value='$r[nama_lengkap]' ></td></tr>
		  <tr><td>Email</td>     <td> : <input type=text name='email' value='$r[email]'></td></tr>
		  <tr><td>No. Telp</td>     <td> : <input type=text name='no_tlp' value='$r[no_tlp]' ></td></tr>";
if($r[level]=='admin'){			
			echo "<tr><td>Level</td>     	<td> : <input type=radio name='level' value='admin' checked>Administrator
													<input type=radio name='level' value=user>User
											</td></tr>";
			}
else{
			echo "<tr><td>Level</td>     	<td> :<input type=radio name='level' value=admin>Administrator
				  <input type=radio name='level' value='user' checked>User
											</td></tr>";
			}								
			

echo "<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
