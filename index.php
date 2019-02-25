<?php
  /**
   * Main page for the application
   *
   * Asil Cetin
   */
  include("functions.php");
  $annotations = getAnnotations("all");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A map-based experimental web application to investigate war damaged buildings of Vienna from 1946.">
    <meta name="author" content="Asil Cetin">
    <title>Vienna 1946 - War Damaged Buildings</title>
    <link rel="canonical" href="https://vienna1946.asilcetin.com">
    <!-- CSS files -->
    <link rel="stylesheet" href="includes/leaflet/leaflet.css"/>
    <link rel="stylesheet" href="includes/leaflet/plugins/leaflet-geocoder/Control.Geocoder.css"/>
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css" >
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm" id="topNavbar">
      <a class="navbar-brand" href="/"><b>vienna1946</b></a>
      <div class="color-legend">
        <div class="legend-item" style="background-color:#DFA62F;">Totalschaden</div>
        <div class="legend-item" style="background-color:#D54024;">Ausgebrant</div>
        <div class="legend-item" style="background-color:#182B32;">Schwerer Schaden</div>
        <div class="legend-item" style="background-color:#6E9452;">Leichter Schaden</div>
        <div class="legend-item bomben-treffer">Bomben Treffer</div>
        <div class="legend-item beschuss">Beschuss</div>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbarItems" aria-controls="topNavbarItems" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavbarItems">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="container-fluid">
      <div class="row main-row">
        <div class="col-md-9 pl-0 pr-0">
          <div id="mainMap" class="w-100 h-100"></div>
        </div>
        <div class="col-md-3 pt-3 annotation-content-block">
          <div id="annotation-back-btn" style="display:none;">Back to the List</div>
          <h3 id="annotation-list-heading">Annotated Damages</h3>
          <?php foreach ($annotations as $annotation) { ?>
            <div id="annotation-list-<?php echo $annotation["id"]; ?>" class="annotation-list" data-annotationID="<?php echo $annotation["id"]; ?>">
              <img class="content-img d-inline pr-2" src="<?php echo $annotation["image"]; ?>"/>
              <div class="d-inline">
                <h4><?php echo $annotation["title"]; ?></h4>
                <span class="meta-data d-block"><i data-feather="flag"></i> <?php echo $annotation["current-status"]; ?></span>
                <span class="meta-data d-block"><i data-feather="target"></i> <?php echo $damageLevels[$annotation["damage"]-1]; ?></span>
              </div>
            </div>
          <?php } ?>
          <?php foreach ($annotations as $annotation) { ?>
            <div id="annotation-detail-<?php echo $annotation["id"]; ?>" class="annotation-detail" data-annotationID="<?php echo $annotation["id"]; ?>" style="display:none;">
              <h2><?php echo $annotation["title"]; ?></h2>
              <img class="content-img" src="<?php echo $annotation["image"]; ?>"/>
              <?php echo $annotation["text"]; ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </main><!-- /.container -->
    <!-- JS files -->
    <script src="includes/leaflet/leaflet.js"></script>
    <script src="includes/leaflet/plugins/leaflet-geocoder/Control.Geocoder.js"></script>
    <script src="includes/leaflet/plugins/leaflet-side-by-side/leaflet-side-by-side.min.js"></script>
    <script src="includes/jquery/jquery.min.js" ></script>
    <script src="includes/bootstrap/js/bootstrap.bundle.min.js" ></script>
    <script src="includes/feather/feather.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
