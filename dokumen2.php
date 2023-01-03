<?php
// function to create dynamic treeview menus
function createTreeView($parent, $menu) {
   $html = "";
   if (isset($menu['parents'][$parent])) {
      $html .= "
      <ol class='tree'>";
       foreach ($menu['parents'][$parent] as $itemId) {
          if(!isset($menu['parents'][$itemId])) {
             $html .= "<p><label for='subfolder2'>".$menu['items'][$itemId]['nama_dokumen']." <input type='radio' name='docid' value=".$menu['items'][$itemId]['docid']."/> </label></li>";
          }
          if(isset($menu['parents'][$itemId])) {
             $html .= "
             <p><label for='subfolder2'>".$menu['items'][$itemId]['nama_dokumen']."</a>  <input type='radio' name='docid' value=".$menu['items'][$itemId]['docid']."/>";
             $html .= createTreeView($itemId, $menu);
             $html .= "</label> </li>";
          }
       }
       $html .= "</ol>";
   }
   return $html;
}
?>