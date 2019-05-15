<!DOCTYPE html>
<html>
<head>
  <title>Ambazonian Genocide Watch</title>
  <?php $page = 'home'; include 'header.php'; ?>

  <!-- Bootstrap core JS & CSS -->
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap/bootstrap.min.js"></script>

  <!-- Google Fonts API -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto"
  rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="style.css">

  <!-- Firebase API -->
  <script
      src='https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js'>
  </script>
  <script
      src='https://www.gstatic.com/firebasejs/6.0.2/firebase-firestore.js'>
  </script>
  <script
      src='https://www.gstatic.com/firebasejs/6.0.2/firebase-storage.js'>
  </script>

  <!-- Media rendering -->
  <script src='home.js'></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-8" style="text-align: center;">
        <button id='deathcount' type='button'
            class='btn btn-outline-danger'></button>
        <br>
        <div id='social-media-container'></div>
      </div>
    </div>

    <div class="row">
      <div class="col" style="text-align: right;">
        <h1>The Ambazonian Genocide</h1>
        <h4>the extensive documentation of the</h4>
        <h4>genocide that has been hidden from</h4>
        <h4>the world by an oppressive government</h4>
        <div style="padding-top: 1rem;"></div>
        <h5>photos, videos, and audio are uploaded daily</h5>
        <h5>by the Ambazonians victims of the mass murder</h5>
        <h5>designed by the Cameroonian government</h5>
      </div>
      <div class="col">
        <img id='home-page-img' style='width: 500px; height: 300px;'></img>
      </div>
    </div>

    <div class="row">
      <div id='pdf-container' class="col-sm-8"
          style="text-align: center;"></div>
    </div>
  </div>
</body>
</html>
