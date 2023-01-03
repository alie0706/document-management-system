 <link rel="stylesheet" href="style.css" /> 
 <script type="text/javascript">

 

function yesnoCheck() {

    if (document.getElementById('adminCheck').checked) {

        document.getElementById('ifNo').style.display = 'none';

    }

	else {
	document.getElementById('ifNo').style.display = 'block';
	}
}

function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

</script>
 <?php
 session_start();

switch($_GET['act']){
  // Tampil user
  default:
  if($_SESSION[leveluser]=='admin'){?>
  <div class="card-body">
    <a class="btn btn-primary" href="?module=user&act=tambahuser" role="button">Tambah Data</a></div>
	<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Master User</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>No</th><th>username</th><th>name</th><th>level</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM user WHERE username !='admin' ORDER BY id_user");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
		     <td>$r[nama_lengkap]</a></td>
			 <td>$r[level]</td>
             <td><a href=?module=user&act=edituser&id=$r[id_user]><i class='menu-icon fa fa-edit' border=0 border=0 title='edit'></i></a> | 
	             <a href='./aksi.php?module=user&act=hapus&id=$r[id_user]' onClick=\"return confirm('Anda yakin akan menghapus data dari tabel ini?')\">
			     <i class='menu-icon fa fa-trash-o' border=0 title='hapus'></i></a> 
             </td></tr>";
      $no++;
    }
	}
	else{
	echo "Maaf Anda tidak punya hak";
	}
    echo "</fieldset>";?>
	</tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
			<?php
	
		
    break;
  
  case "tambahuser":
    echo "<form name='tambah' method=POST action='./aksi.php?module=user&act=input' onSubmit=\"return validasi()\">";?>
		  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Tambah User</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
          <tr><td>Username</td>     <td>  <input type=text name='username' class='form-control' onBlur='validate(this)'></td></tr>
          <tr><td>Password</td>     <td>  <input type=password name='password' class='form-control'></td></tr>
		  <tr><td>Complete name</td> <td>  <input type=text name='nama_lengkap' class='form-control'></td></tr>
		  <tr><td>Email</td> <td>  <input type=text name='email' class='form-control'></td></tr>
		  <tr><td>No Telephone</td> <td>  <input type=text name='no_tlp'class='form-control'></td></tr>
          <?php
          echo "<tr><td> Departemen <td>  <select name='departemenid' class='form-control'>";
					echo "<option value='0'> Silahkan Pilih Departemen </option>";
					$prov = mysql_query("SELECT * FROM masterdepartemen order by departemenid asc");
					while($hasil = mysql_fetch_array($prov)){
					echo "<option value='$hasil[departemenid]'>$hasil[namadepartemen]</option>";
					}
					
					echo "</select></td>";
                    ?>
		   <tr><td>Level</td>     	<td>  <input type=radio onclick="javascript:yesnoCheck();" name='level' value='admin' id='adminCheck'>Administrator
											<input type=radio onclick="javascript:yesnoCheck();" name='level' value='user' id='usrCheck'>User
											</td></tr>
		<?php			
				echo "<table  id='ifNo' style='display:none' class='table table-striped table-bordered'>
                <tr><td>No</td><td>Keterangan</td><td>Status</td><td><input type='checkbox' onclick='toggle(this);' />Check all?</tr>";
                
                  echo "<tr><td align='center'>1 </td><td>Create </td><td><input type='checkbox' name='create' value='1'> </td>
                        <tr><td align='center'>2 </td><td>Read </td><td><input type='checkbox' name='read' value='1'> </td>
                        <tr><td align='center'>3 </td><td>Update </td><td><input type='checkbox' name='edit' value='1'> </td>
                        <tr><td align='center'>4 </td><td>Delete </td><td><input type='checkbox' name='delete' value='1'> </td>
                        <tr><td align='center'>5 </td><td>Link </td><td><input type='checkbox' name='link' value='1'> </td>
                        <tr><td align='center'>5 </td><td>Approve </td><td><input type='checkbox' name='approve' value='1'> </td>
                        <tr><td align='center'>6 </td><td>Watermark </td><td><input type='checkbox' name='watermark' value='1'> </td>
                        <tr><td align='center'>7 </td><td>Refisi </td><td><input type='checkbox' name='refisi' value='1'> </td>
                        <tr><td align='center'>7 </td><td>Preview </td><td><input type='checkbox' name='preview' value='1'> </td>
                        <tr><td align='center'>7 </td><td>Download </td><td><input type='checkbox' name='download' value='1'> </td>";
                   
                echo "</tr></table>";
							
			echo "</td></tr>
                    <tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
                    <i class='fa fa-dot-circle-o'></i> Submit
                    </button>
                    <button type='reset' class='btn btn-danger btn-sm'>
                    <i class='fa fa-ban'></i> Reset
                    </button>
                    <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
                    <i class='fa fa-ban'></i> Back
                    </button></td></tr>
          </table></form></div></div>
          </div>
          </div>
          </div></div>";
     break;
    
  case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name='ganti' method=POST action='./aksi.php?module=user&act=update' onSubmit=\"return edit()\">";?>
		 <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Edit User</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
		<?php		  
		  echo "<input type=hidden name='id_user' value='$r[id_user]'>
		  <tr><td>username</td>     <td> : <input type=text name='username' value='$r[username]' onBlur='validate(this)'></td></tr>
          <tr><td>Password</td>     <td> : <input type=password name='password'></td></tr>
		  <tr><td>Nama Lengkap</td>     <td> : <input type=text name='nama_lengkap' value='$r[nama_lengkap]' ></td></tr>
		  <tr><td>Email</td>     <td> : <input type=text name='email' value='$r[email]'></td></tr>
		  <tr><td>No. Telp</td>     <td> : <input type=text name='no_tlp' value='$r[no_tlp]' ></td></tr>";
          echo "<tr><td> Departemen <td>  <select name='departemenid' class='form-control'>";
					$prov = mysql_query("SELECT * FROM masterdepartemen order by departemenid asc");
					while($hasil = mysql_fetch_array($prov)){
                        if($r['departemenid']==$hasil['departemenid']){
					        echo "<option value='$hasil[departemenid]' selected>$hasil[namadepartemen]</option>";
                        }
                        else{
                            
					        echo "<option value='$hasil[departemenid]'>$hasil[namadepartemen]</option>";
                        }
					}
					
					echo "</select></td>";
if($r['level']=='admin'){			
			echo "<tr><td>Level</td>     	<td> : <input type=radio onclick='javascript:yesnoCheck();' name='level' value='admin' id='yesCheck' checked>Administrator
											        <input type=radio onclick='javascript:yesnoCheck();' name='level' id='noCheck' value='user'>User
											</td></tr>";
			}

else{
			echo "<tr><td>Level</td>     	<td> :<input type=radio onclick='javascript:yesnoCheck();' name='level' value='admin'  id='yesCheck'>Administrator
													<input type=radio onclick='javascript:yesnoCheck();' name='level' value='user' id='noCheck' checked>User
											</td></tr>";
			}								
			// echo "<tr><td><td id='ifNo' style='display:block'>  : <select name='ceck'>";
            $role=mysql_query("SELECT * FROM roleuser WHERE id_user='$r[id_user]'");
            $ro=mysql_fetch_array($role);
            echo "<table  id='ifNo' style='display:block' class='table table-striped table-bordered'>
            <tr><td>No</td><td>Keterangan</td><td>Status</td><td><input type='checkbox' onclick='toggle(this);' />Check all?</tr>";
            
              if($ro['create']=='1'){echo "<tr><td align='center'>1 </td><td>Create </td><td><input type='checkbox' name='create' value='$ro[create]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>1 </td><td>Create </td><td><input type='checkbox' name='create' value='1'> </td>";
              }

              if($ro['read']=='1'){echo "<tr><td align='center'>2 </td><td>Read </td><td><input type='checkbox' name='read' value='$ro[read]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>2 </td><td>Read </td><td><input type='checkbox' name='read' value='1'> </td>";
              }
              if($ro['edit']=='1'){echo "<tr><td align='center'>3 </td><td>Update </td><td><input type='checkbox' name='edit' value='$ro[edit]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>3 </td><td>Update </td><td><input type='checkbox' name='edit' value='1'> </td>";
              }
              if($ro['delete']=='1'){echo "<tr><td align='center'>4 </td><td>Delete </td><td><input type='checkbox' name='delete' value='$ro[delete]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>4 </td><td>Delete </td><td><input type='checkbox' name='delete' value='1'> </td>";
              }
              if($ro['link']=='1'){echo "<tr><td align='center'>5 </td><td>Link </td><td><input type='checkbox' name='link' value='$ro[link]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>5 </td><td>Link </td><td><input type='checkbox' name='link' value='1'> </td>";
              }
              if($ro['approve']=='1'){echo "<tr><td align='center'>6 </td><td>Approve </td><td><input type='checkbox' name='approve' value='$ro[approve]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>6 </td><td>Approve </td><td><input type='checkbox' name='approve' value='1'> </td>";
              }
              if($ro['watermark']=='1'){echo "<tr><td align='center'>6 </td><td>Watermark </td><td><input type='checkbox' name='watermark' value='$ro[watermark]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>6 </td><td>Watermark </td><td><input type='checkbox' name='watermark' value='1'> </td>";
              }
              if($ro['refisi']=='1'){echo "<tr><td align='center'>7 </td><td>Refisi </td><td><input type='checkbox' name='refisi' value='$ro[refisi]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>7 </td><td>Refisi </td><td><input type='checkbox' name='refisi' value='1'> </td>";
              }
              if($ro['preview']=='1'){echo "<tr><td align='center'>7 </td><td>Preview </td><td><input type='checkbox' name='preview' value='$ro[preview]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>7 </td><td>Preview </td><td><input type='checkbox' name='preview' value='1'> </td>";
              }
              if($ro['download']=='1'){echo "<tr><td align='center'>7 </td><td>Download </td><td><input type='checkbox' name='download' value='$ro[download]' checked> </td>";
              }
              else{
                  echo "<tr><td align='center'>7 </td><td>Download </td><td><input type='checkbox' name='download' value='1'> </td>";
              }

                  
            echo "</tr></table>";

echo "<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
                  <tr><td colspan=2 align='center'><button type='submit' class='btn btn-primary btn-sm'>
                    <i class='fa fa-dot-circle-o'></i> Submit
                    </button>
                    <button type='reset' class='btn btn-danger btn-sm'>
                    <i class='fa fa-ban'></i> Reset
                    </button>
                    <button type='button' onclick=self.history.back() class='btn btn-warning btn-sm'>
                    <i class='fa fa-ban'></i> Back
                    </button></td></tr>
          </table></form></div></div>
          </div>
          </div>
          </div></div>";
    break;  
}
?>
