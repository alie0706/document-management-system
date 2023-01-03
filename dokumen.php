<?php
// function to create dynamic treeview menus
function createTreeView($parent, $menu) {
   $html = "";
   if (isset($menu['parents'][$parent])) {
      $html .= "
      <ul>";
       foreach ($menu['parents'][$parent] as $itemId) {
          if(!isset($menu['parents'][$itemId])) {
             $html .= "<li><span class='folder'><a href='media.php?module=menu&act=listdokumen&docid=$itemId[docid]'>".$menu['items'][$itemId]['nama_dokumen']."</a></span> </li>";
          }
          if(isset($menu['parents'][$itemId])) {
             $html .= "
             <li><span class='folder'><a href='media.php?module=menu&act=listdokumen&docid=$itemId[docid]'>".$menu['items'][$itemId]['nama_dokumen']."</a></span> ";
             $html .= createTreeView($itemId, $menu);
             $html .= "</li>";
          }
       }
       $html .= "</ul>";
   }
   return $html;
}
?>