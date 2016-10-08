<!DOCTYPE html>
<?php
    require('admin/config.php');
    $dbh = new PDO('mysql:host=localhost;dbname=lmscountdown', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $query = $dbh->exec("SELECT datecd FROM countdown");
?>
<html lang="FR-fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Les mots SEO">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/mb-comingsoon-iceberg.min.css">
    <link href="assets/images/les_mots_seo_original.ico" rel='icon' type='img/ico' />
    <title>Les Mots SEO</title>
  </head>
  <body>
    <section class="main_container">
      <header class="main_header">
        <img class="main_logo" src="assets/images/les_mots_seo.png" alt="Les Mots SEO" title="Les Mots SEO" />
        <h1 class="main_title">
          arrivent très bientôt!
          <img src="assets/images/one_drive.png" alt="Soon" title="Soon"/>
        </h1>
      </header>
      <div id="myCounter"></div>
    </section>
    <script src="assets/js/jquery-2.2.0.min.js"></script>
    <script src="assets/js/jquery.mb-comingsoon.js"></script>
    <script type='text/javascript'>
    $('#myCounter').mbComingsoon({
        expiryDate: new Date(2016, 5, 12, 9),
        //$('#myCounter').mbComingsoon(new Date(2016, 5, 12, 9)) //Expires
        speed: 100,
        callBack: function () {
            var today = new Date();
            var tomorrow = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 3);
            $('#myCounter').mbComingsoon({expiryDate: tomorrow})
        },
    });
    </script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
