<?php
    session_start();
    require('config.php');
    if(isset($_POST['logout']))
    {
      session_destroy();
      header('Location:index.php');
    }
    if (isset($_SESSION['username']) && isset($_SESSION['password']))
    {
        try
        {
            $dbh = new PDO('mysql:host=localhost;dbname=lmscountdown', $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($_POST['datecd']))
            {
                $datecd = $_POST['datecd'];
                $stmt = $dbh->prepare("UPDATE countdown SET datecd = :datecd");
                $stmt->execute(array(":datecd" => $datecd));
            }
        }
        catch (Exception $e)
        {
            echo "can't connect to database, please contact admin@admin.fr";
            exit(0);
        }
    }
    else
        header('Location:index.php');
?>
<!DOCTYPE html>
<html lang="FR-fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/js/jquery.datetimepicker.css"/ >
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/ >
        <meta name="description" content="Les mots SEO">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="assets/images/les_mots_seo_original.ico" rel='icon' type='img/ico' />
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <title>Admin Les Mots SEO</title>
    </head>
    <body>
      <section class="dashboard_container">
        <header class="dashboard_header">
          <a href="../index.php"><img class="main_logo" src="assets/images/les_mots_seo.png" alt="Les Mots SEO" title="Les Mots SEO" /></a>
        </header>
        <form action="" method="POST" class="dashboard_datepicker_form">
            <input id="datetimepicker" type="text" placeholder="Cliquer pour ouvrir le calendrier"/>
            <input id="truedate" type="hidden" name="datecd"/>
            <input type="submit" value="Changer la date de lancement"/>
        </form>
        <form class="form_deco" action="" method="POST">
          <input type="submit" value="BYE o/" name="logout"/>
        </form>
      </section>
    </body>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-dateFormat.min"></script>
    <script src="assets/js/build/jquery.datetimepicker.full.min.js"></script>
    <script type='text/javascript'>
        $('#datetimepicker').datetimepicker();
        $('#datetimepicker').on('change', function()
        {
            var d = new Date($('#datetimepicker').val()).getTime();
             $('#truedate').val(DateFormat.format.date(d, "E MMM dd yyyy HH:mm:ss"));
        });
    </script>
</html>
