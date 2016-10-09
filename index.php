<!DOCTYPE html>
<?php
    require('admin/config.php');
    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=lmscountdown', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $query = $dbh->query("SELECT datecd FROM countdown");
        $datecd = $query->fetch();
        $dbh = null;
    }
    catch(Exception $e)
    {
        echo "can't connect to database, please contact admin@admin.fr";
        exit(0);
    }
    if (isset($_POST['email']))
    {
        $email = $_POST['email'];
        $dbh = new PDO('mysql:host=localhost;dbname=lmscountdown', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $query = $dbh->query("SELECT email FROM newsletter");
        $all_mail = $query->fetchAll();
        foreach($all_mail as $key => $mail)
        {
            if (strtolower($email) == strtolower($mail[0]))
                $already_ex = true;
        }
        if (isset($already_ex))
            echo '<div class="main_denied">Email déjà enregistré <span class="main_close"></span></div>';
        else
        {
            $stmt = $dbh->prepare("INSERT INTO newsletter (email) VALUES (:email)");
            $stmt->execute(array(":email" => $email));
            echo '<div class="main_confirmation">Email enregistré avec succès! <span class="main_close"></span></div>';
        }
    }
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
      <h2 class="second_title">...Pour patienter, <br /> Je m'abonne à la newsletter</h2>
      <form action="" method="POST" class="form_newsletter">
        <input type="email" name="email" placeholder="moi@lesmotsseo.fr" />
        <input type="submit" value="Envoyer" name="submit"/>
      </form>
    </section>
    <script src="assets/js/jquery-2.2.0.min.js"></script>
    <script src="assets/js/jquery.mb-comingsoon.js"></script>
    <script type='text/javascript'>
    var datecd = "<?php echo $datecd[0]; ?>";
    $('#myCounter').mbComingsoon({
        expiryDate: new Date(datecd)
    });
    </script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
