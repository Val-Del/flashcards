<?php
$tables = Tables_Manager::selectAll();
// var_dump($tables);
// var_dump($tables);
echo '<form method=POST action="?page=creationFiles">';
echo'
<div class="grid-container ">
<div class="grid-item header-item">Table name</div>
<div class="grid-item header-item">Class/ Manager</div>
<div class="grid-item header-item">Back office</div>';

foreach ($tables as $table) {
     // if ($table->getName() != "gen__tables" && $table->getName() != "gen__parameters" && $table->getName() != "gen__foreign_key"  && $table->getName() != "gen__table_foreign_key") {
     if (substr($table->getName(), 0, 5 ) != "gen__") {
          echo '<div class="grid-item">';
          echo  ucFirst($table->getName()) ;
          echo '</div>';

          echo '<div class="grid-item">';
          echo '<input type="checkbox" name="'.$table->getId_table().'[_generation]">';
          echo '</div>';

          echo '<div class="grid-item">';
          echo '<input type="checkbox" name="'.$table->getId_table().'[_back]">';
          echo '</div>';
     }
}
  
echo'</div>';

  
echo '<br><button class=btn type=submit>Génération</button>';
echo '</form>';
