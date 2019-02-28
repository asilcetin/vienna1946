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
        <div class="legend-item total-damage" style="background-color:#b88d1d;">Total Damage</div>
        <div class="legend-item burned" style="background-color:#D54024;">Burned</div>
        <div class="legend-item heavy-damage" style="background-color:#182B32;">Heavy Damage</div>
        <div class="legend-item light-damage" style="background-color:#6E9452;">Light Damage</div>
        <div class="legend-item bomben-treffer">Bomb Hit</div>
        <div class="legend-item beschuss">Bombardment</div>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavbarItems" aria-controls="topNavbarItems" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavbarItems">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#addAnnotationModal">Add Annotation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#creditsModal">Credits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://github.com/asilcetin/vienna1946">Source Code</a>
          </li>
        </ul>
      </div>
    </nav>

    <?php
    // Handle the response if a new annotation is submitted
    if ( isset( $_POST["damage"] ) ) {
      addAnnotationData( $_POST );
      echo '
        <div class="alert alert-success mb-0 text-center" role="alert">
          The new annotation is successfully submitted!
        </div>
        <script type="text/javascript">
          setTimeout(function() {
            window.location.replace(location.pathname);
          }, 2000);
        </script>';
    }
    ?>

    <!-- Add Annotation Modal -->
    <div class="modal fade" id="addAnnotationModal" tabindex="-1" role="dialog" aria-labelledby="addAnnotationModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Annotation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
              <div class="form-group">
                <label for="title">Building Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter building title, e.g: Philipphof" required>
              </div>
              <div class="form-group">
                <label for="coordinates">Building Coordinates</label>
                <input type="text" class="form-control" name="coordinates" placeholder="Enter building coordinates, e.g: [48.20467, 16.36911]" required>
              </div>
              <div class="form-group">
                <label for="damage">Damage Level</label>
                <select class="form-control" name="damage">
                  <option value="1">Total Damage</option>
                  <option value="2">Burned</option>
                  <option value="3">Heavy Damage</option>
                  <option value="4">Light Damage</option>
                  <option value="5">Bomb Hit</option>
                  <option value="6">Bombardment</option>
                </select>
              </div>
              <div class="form-group">
                <label for="current-status">Current Status</label>
                <input type="text" class="form-control" name="current-status" placeholder="Enter current status of the building, e.g: Repaired" required>
              </div>
              <div class="form-group">
                <label for="image">Image URL</label>
                <input type="url" class="form-control" name="image" placeholder="Enter an image URL for the building" required>
              </div>
              <div class="form-group">
                <label for="image-source">Image Source</label>
                <input type="text" class="form-control" name="image-source" placeholder="Enter image source for copyright reasons">
              </div>
              <div class="form-group">
                <label for="text">Description</label>
                <textarea class="form-control" name="text" placeholder="Enter the description of this annotations" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="text-source">Description Source</label>
                <input type="url" class="form-control" name="text-source" placeholder="Enter description source for copyright reasons">
              </div>
              <div class="form-group">
                <label for="added-by">Added By</label>
                <input type="text" class="form-control" name="added-by" placeholder="Enter your name as the creator of this annotation">
              </div>
              <button type="submit" name="action" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Credits Modal -->
    <div class="modal fade" id="creditsModal" tabindex="-1" role="dialog" aria-labelledby="creditsModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Credits</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Open Government Data provided by the City of Vienna: <a href="https://www.data.gv.at/katalog/dataset/87282445-a02d-4f7f-9bf6-196d73d9b3a9">https://www.data.gv.at/katalog/dataset/87282445-a02d-4f7f-9bf6-196d73d9b3a9</a></p>
            <p>Bootstrap 4: <a href="https://getbootstrap.com/">https://getbootstrap.com/</a></p>
            <p>Leaflet: <a href="https://leafletjs.com/">https://leafletjs.com/</a></p>
            <p>Feather Icons: <a href="https://feathericons.com/">https://feathericons.com/</a></p>
            <div>Icons made by <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/"title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
          </div>
        </div>
      </div>
    </div>

    <main role="main" class="container-fluid">
      <div class="row main-row">
        <div class="col-md-9 pl-0 pr-0">
          <div id="mainMap" class="w-100 h-100"></div>
        </div>
        <div class="col-md-3 annotation-content-block">
          <h3 id="annotation-list-heading">Annotated Damages</h3>
          <?php foreach ($annotations as $annotation) { ?>
            <div id="annotation-list-<?php echo $annotation["id"]; ?>" class="annotation-list <?php echo str_replace(' ','',$damageLevels[$annotation["damage"]-1]); ?>" data-annotationID="<?php echo $annotation["id"]; ?>">
              <img class="content-img d-inline pr-2" src="<?php echo $annotation["image"]; ?>"/>
              <div class="d-inline">
                <h4><?php echo $annotation["title"]; ?></h4>
                <span class="meta-data d-block"><i data-feather="flag"></i> <?php echo $annotation["current-status"]; ?></span>
                <span class="meta-data d-block"><i data-feather="target"></i> <?php echo $damageLevels[$annotation["damage"]-1]; ?></span>
              </div>
            </div>
          <?php } ?>
          <?php foreach ($annotations as $annotation) { ?>
            <div id="annotation-detail-<?php echo $annotation["id"]; ?>" class="annotation-detail <?php echo str_replace(' ','',$damageLevels[$annotation["damage"]-1]); ?>" data-annotationID="<?php echo $annotation["id"]; ?>" style="display:none;">
              <div class="annotation-back-btn">Back to the List</div>
              <h2><?php echo $annotation["title"]; ?></h2>
              <img class="content-img" src="<?php echo $annotation["image"]; ?>"/>
              <div class="d-block mb-2">
                <span class="meta-data d-block"><i data-feather="info"></i> <a target="_blank" href="<?php echo $annotation["image-source"]; ?>">Image Source</a></span>
                <span class="meta-data d-block"><i data-feather="flag"></i> <?php echo $annotation["current-status"]; ?></span>
                <span class="meta-data d-block"><i data-feather="target"></i> <?php echo $damageLevels[$annotation["damage"]-1]; ?></span>
              </div>
              <?php echo $annotation["text"]; ?>
              <span class="meta-data mt-2 d-block"><i data-feather="link"></i> <a target="_blank" href="<?php echo $annotation["text-source"]; ?>">Read more about this damage from the source</a></span>
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
