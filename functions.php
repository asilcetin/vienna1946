<?php
/**
 * Basic CRUD functions for the application
 *
 * Asil Cetin
 */

$damageLevels = array("Total Damage","Burned","Heavy Damage","Light Damage","Bomb Hit","Bombardment");

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

//Add new artwork meta data
function addAnnotationData($formData) {
  $file = file_get_contents("annotations.json");
  $data = json_decode($file, true);
  $latestId = $data["latestId"];
  $newId = $latestId + 1;

  //Check if artwork with this title exists
  foreach($data["annotations"] as $annotation) {
    if ($annotation["title"] == $formData["title"]) {
      return "Annotation exists";
    }
  }

  $data["latestId"] = $newId;
  $coordinates = explode(',', $formData["coordinates"]);
  array_push($data["annotations"], array('id' => $newId, 'title' => $formData["title"], 'coordinates' => array((float)$coordinates[0],(float)$coordinates[1]), 'damage' => $formData["damage"], 'current-status' => $formData["current-status"], 'image' => $formData["image"], 'image-source' => $formData["image-source"], 'text' => $formData["text"], 'text-source' => $formData["text-source"], 'added-by' => $formData["added-by"]));
  $new_data = json_encode($data, JSON_NUMERIC_CHECK);
  if (file_put_contents("annotations.json", $new_data) === false){
    unset($new_data);
    return false;
  } else {
    unset($new_data);
    return "Annotation data added.";
  }
}





?>