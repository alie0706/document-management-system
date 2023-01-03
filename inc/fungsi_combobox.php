<?php
function combotgl($awal, $akhir, $var, $terpilih){
  echo "<select name=$var>";
  for ($i=$awal; $i<=$akhir; $i++){
    $lebar=strlen($i);
    switch($lebar){
      case 1:
      {
        $g="0".$i;
        break;     
      }
      case 2:
      {
        $g=$i;
        break;     
      }      
    }  
    if ($i==$terpilih)
      echo "<option value=$g selected>$g</option>";
    else
      echo "<option value=$g>$g</option>";
  }
  echo "</select> ";
}


function combobln($awal, $akhir, $var, $default){
include "./inc/library.php";
echo "<select name=$var>";
echo "<option value=0 selected>BULAN</option>";
for ($bln=$awal; $bln<=$akhir; $bln++){
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}
function combothn($awal, $akhir, $var, $terpilih){
include "../inc/library.php";
echo "<select name=$var>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$terpilih)
      echo "<option value=$i selected>$i</option>";
    else
      echo "<option value=$i>$i</option>";
  }
  echo "</select> ";
}

function combonamabln($awal, $akhir, $var, $terpilih){
  $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");
  echo "<select name=$var>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
  }
  echo "</select> ";
}
function combotgl2($awal, $akhir, $var, $terpilih){
echo "<select name=$var>";
for ($i=$awal; $i<=$akhir; $i++){
if ($i==$terpilih)
  echo "<option value=$i selected>$i</option>";
else
  echo "<option value=$i>$i</option>";
}
echo "</select> ";
}

function combobln2($awal, $akhir, $var, $terpilih){
include "../inc/library.php";
echo "<select name=$var>";
for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
}
echo "</select> ";
}

function tanggal() {
		$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
		$bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
		$waktu[0] = $hari[date("w", time())];
		$waktu[1] = date("d", time());
		$waktu[2] = date("n", time());
		$waktu[3] = date("Y", time());
		$waktu[4] = date("H", time());
		$waktuJam = $waktu[4];
		if($waktuJam=="00") {
			$waktuJam=23;
		}
		else if ($waktuJam=="1") {
			$waktuJam="00";
		}
		else {
			$waktuJam=$waktu[4];
		}
		$waktu[5] = date("i", time());
		
		$hasil=$waktu[0] .", ". $waktu[1] ." ". $bulan[$waktu[2]-1] ." ". $waktu[3] ."&nbsp;&nbsp;";
		echo $hasil;
	}

?>
