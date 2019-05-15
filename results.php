<?php
// Generate page-level attributes
$province = isset($_POST['province']) ? $_POST['province'] : 'all';
if ($province === '')
  $province = 'all';
$type = isset($_POST['type']) ? $_POST['type'] : 'all';
if ($type === '')
  $type = 'all';
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase.js"></script>
  <script src='submit.js'></script>
  <title>Ambazonian Genocide Watch</title>

  <?php include 'header.php'; ?>

  <!-- Bootstrap core JS & CSS -->
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap/bootstrap.min.js"></script>

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
  <script src='results.js'></script>
</head>

<body>
  <div class='container'>
    <form action='results.php' method='post'>

      <!-- Select By Document Type -->
      <input type="hidden" value="<?php echo $province; ?>"
          name="province" id="prov-selector" />
      <input type="hidden" value="<?php echo $type; ?>"
          name="type" id="type-selector"/>
      <select class="btn btn-outline-dark" id='doctype'
          onchange="submit_form(value, 'type-selector', this.form);">
        <option value='Sort By Document'>Sort By Document</option>
      </select>

      <!-- Select By Province -->
      <select class="btn btn-outline-dark" id='province'
          onchange="submit_form(value, 'prov-selector', this.form);">
        <option value="all">Sort By Provinces</option>
      </select>
    </form>
    <div style="padding-bottom: 3rem;"></div>
  </div> <!-- container -->
  <div class='container' id='ui-container'></div>
  <!-- We run the contents of the rendering script here to ensure it sees the
       necessary dom elements -->
  <script>run();</script>
</body>
</html>
