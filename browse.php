<!DOCTYPE html>
<html>
<head>
  <title>Ambazonian Genocide Watch</title>
  <?php $page = 'browse'; include 'header.php'; ?>
  <script src='submit.js'></script>

  <!-- Bootstrap core JS & CSS -->
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap/bootstrap.min.js"></script>

  <!-- Google Fonts API -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto"
  rel="stylesheet">

  <!-- CSS -->
  <link rel='stylesheet' href='style.css' />

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
  <script src='browse.js'></script>
</head>
<body>
  <div class='container'>
    <div class="row">
      <div class="col">

        <!-- TEXT -->
        <div style="text-align: right; padding-bottom: 2rem;">
          <h1>Browse the documents</h1>
          <h3>uploaded daily by the Ambazonians</h3>
          <h3>under siege by the Cameroonian</h3>
          <h3>government’s genocide</h3>
        </div>

        <!-- VIEW ALL DOCUMENTS -->
        <div class="form-group">
          <form action='results.php' action='get'>
            <input type="hidden" name="province" value="all" id="selector" />
            <input type="hidden" name="type" value="all" />
            <input class="form-control" type='submit' value='View All Documents' />
          </form>
        </div>

        <!-- SELECT BY DOCUMENTS -->
        <form action='results.php' action='get'>
          <input type="hidden" value="" name="province"
              id="prov-selector" />
          <input type="hidden" value="" name="type"
              id="type-selector" />
          <select class="form-control" id='doctype'
              onchange="submit_form(value, 'type-selector', this.form);">
            <option selected value='all'>Sort By Document</option>
          </select>
        </form>

      </div> <!-- col 1 -->

      <br>

      <div class="col">
        <img id='map' src='map.jpg' usemap='#bmap' />
        <map id='bmap' name='bmap'></map>
      </div> <!-- col 2 -->
    </div> <!-- row -->
  </div> <!-- container -->
</body>
</html>
