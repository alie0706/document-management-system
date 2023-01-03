<script src="./js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<link href="./js/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript"> 
      $(document).ready(function(){
        $("#tgla").datepicker({
					dateFormat : "yy-mm-dd",  
					defaultDate: "+0w",
           changeYear  : true,
		  changeMonth : true
        });
		
      });
    </script> 
	<script language="javascript">  
      function addRow2(tableID) {  
      
       var table = document.getElementById(tableID);  
       var rowCount = table.rows.length;  
       var row = table.insertRow(rowCount);  
      
       var cell1 = row.insertCell(0);  
       var element1 = document.createElement("input");  
       element1.type = "checkbox";  
       element1.name="chkbox[]";  
       cell1.appendChild(element1);  
      
     
      
       var cell3 = row.insertCell(1);  
       var element2 = document.createElement("input");  
       element2.type = "text";  
       element2.name = "namefile[]";
	   element2.size = "25";  	   
       cell3.appendChild(element2); 
	   
	   var cell4 = row.insertCell(2);  
       var element1 = document.createElement("input");  
       element1.type = "text";  
       element1.name = "metadata_file[]";
	   element1.size = "25";  	   
       cell4.appendChild(element1); 
	   
	   var cell5 = row.insertCell(3);  
       var element3 = document.createElement("input");  
       element3.type = "file";  
       element3.name = "fupload[]";
	   element3.size = "25";  	   
       cell5.appendChild(element3);
	   
	   var cell6 = row.insertCell(4);  
       var element4 = document.createElement("input");  
       element4.type = "text";  
       element4.name = "retentiondate[]";
       element4.id = "tgla";
	    element4.size = "15";  	   
       element4.placeholder = "dddd-mm-yy";  	   
       cell6.appendChild(element4);
      }  
      
      function deleteRow2(tableID) {  
       try {  
       var table = document.getElementById(tableID);  
       var rowCount = table.rows.length;  
      
       for(var i=0; i<rowCount; i++) {  
        var row = table.rows[i];  
        var chkbox = row.cells[0].childNodes[0];  
        if(null != chkbox && true == chkbox.checked) {  
         table.deleteRow(i);  
         rowCount--;  
         i--;  
        }  
      
      
       }  
       }catch(e) {  
        alert(e);  
       }  
      }  
      
     </script>  
	

</head> 
<body> 


<div style="padding: 0px 0px 0px 0px;">  
     <table id="dataTable2"  class='table table-striped table-bordered' style="border-bottom: 1px solid #F00; border-left: 1px solid #F00; border-right: 1px solid #F00; border-top: 1px solid #F00; width: 500px;">  
    <tr> <th>@</th> <th>Nama File</th><th>Metadata File </th><th>Upload File </th><th>Tanggal Expired </th><th><input onclick="addRow2('dataTable2')" type="button" value="Tambah" />  <input onclick="deleteRow2('dataTable2')" type="button" value="Hapus" />   </tr>
	
   
    </div>  
