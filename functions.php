<?php
/**
 * Basic CRUD functions for the application
 *
 * Asil Cetin
 */

function getAnnotations($annotationID) {
  $file = file_get_contents("annotations.json");
  $data = json_decode($file, true);
  if ($annotationID == "all") {
    return $data["annotations"];
  }
  foreach($data["annotations"] as $annotation) {
    if ($annotation["id"] == $annotationID) {
      return $annotation;
    }
  }
}

$damageLevels = array("Total Damage","Burned","Heavy Damage","Light Damage","Bomb Hit","Bombardment");


?>