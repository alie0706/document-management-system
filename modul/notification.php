 <link rel="stylesheet" href="style.css" /> 
 <?php
 session_start();

switch($_GET[act]){
  // Tampil notification
  default:
  if($_SESSION[leveluser]=='admin'){
    ?>
  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Notification</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>No</th><th>Month</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM notification ORDER BY id ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[day] / Month</td>
             <td align=center><a href=?module=notification&act=editnotification&id=$r[id]><img src=images/icon_edit.gif border=0 border=0 title='edit'></a>
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
  
  case "tambahnotification":
    echo "<h2>Tambah notification</h2>
          <form name='tambah' method=POST action='./aksi.php?module=notification&act=input' onSubmit=\"return validasi()\">
          <fieldset><legend> Silahkan isi dengan benar </legend>
		  <table>
          <tr><td>Month</td>     <td> : <input type=text name='day' onBlur='validate(this)'></td></tr>
          ";
			echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editnotification":
    $edit=mysql_query("SELECT * FROM notification WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name='ganti' method=POST action='?module=notification&act=update' onSubmit=\"return edit()\">";?>
    <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Edit Notification</strong>
                        </div>
                        <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
		 echo "<input type=hidden name='id' value='$r[id]'>
		 <tr><td>Month</td>     <td> : <input type=text name='day' value='$r[day]' onBlur='validate(this)'></td></tr>
          ";
			echo "</td></tr>
			<tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form></div></div>
          </div>
          </div>
          </div></div>";
    break;  
	
	case "update":
	$day=$_POST[day];
	mysql_query("UPDATE notification SET day='$day' where id='$_POST[id]'");	
	echo "<script Language=\"JavaScript\">
  window.location = \"media.php?module=notification\";
  </script>')";
	break;
}
?>
