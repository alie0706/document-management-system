 <?php
 session_start();

switch($_GET[act]){
  // Tampil user
  default:
  if($_SESSION[leveluser]=='admin'){?>
  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">History Log</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>No</th><th>Username</th><th>Action</th></tr>"; 
    $tampil=mysql_query("SELECT DISTINCT(username) FROM log where username !='' ORDER BY logid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
		     <td align=center><a href=?module=history&act=detail&name=$r[username]><i class='menu-icon fa fa-list'></i></a> |
			 <a href='./aksi.php?module=history&act=hapusfile&username=$r[username]' onClick=\"return confirm('You wish to vanish this data?')\">
			 <i class='menu-icon fa fa-trash-o' border=0 border=0 title='Delete'></i></a> 
				
		     </td></tr>";
      $no++;
    }
	}
	else{
	echo "Maaf Anda tidak punya hak";
	}
    echo "</fieldset></table></div></div></div></div>";
	
		
    break;
	
	case "detail":
	$tampilan=mysql_query("SELECT * FROM log where username='$_GET[name]' ORDER BY logid");
	$c=mysql_fetch_array($tampilan);
	 if($_SESSION[leveluser]=='admin'){?>
	<div style='overflow-y:scroll;overflow-x:scroll; height:500px;width:100%;scroll-color:hidden;'>
  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">History Log</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
					<?php
          echo "<tr><th>no</th><th>username</th><th>name</th><th>Date</th><th>Description</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM log,user where log.id_user=user.id_user AND log.username='$_GET[name]' ORDER BY logid");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
		     <td>$r[nama_lengkap]</a></td>
			 <td>$r[tgl_log]</a></td>
			 <td>$r[keterangan]</td>
            </td></tr>";
      $no++;
    }
	}
	else{
	echo "Maaf Anda tidak punya hak";
	}
    echo "</fieldset></table></div></div></div></div></div></div>";
	
		
    break;
  
 }
?>
