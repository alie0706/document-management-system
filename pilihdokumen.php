<body>
<link rel="stylesheet" href="treeview.css" />
	<!-- <script type="text/javascript" src="jquery.min.js"></script> -->
	<!-- <script src="inc/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script> -->
	<link href="inc/default.css" rel="stylesheet">
  <!-- <script type="text/javascript" src="inc/artDialog.js"></script> -->
  <table id="bootstrap-data-table" class="table table-striped table-bordered"  style="height: 300px; overflow-y: scroll;">
                    <thead>
                      <tr><td>Silahkan Pilih Dokumen
<?php
include_once("dokumen2.php");
include_once("./inc/inc.koneksi.php");

$sql = "SELECT * FROM dokumen ORDER BY docid";
$result = mysql_query($sql);
// Create an array to conatin a list of items and parents
$menus = array(
  'items' => array(),
  'parents' => array()
);
// Builds the array lists with data from the SQL result
while ($items = mysql_fetch_assoc($result)) {
  // Create current menus item id into array
  $menus['items'][$items['docid']] = $items;
  // Creates list of all items with children
  $menus['parents'][$items['id_parent']][] = $items['docid'];
}
// Print all tree view menus 
echo createTreeView(0, $menus);

?>
</table>
</div>
</body>
</html>