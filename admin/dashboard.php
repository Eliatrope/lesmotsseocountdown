<?php
    session_start();
    require('config.php');
    if (isset($_SESSION['username']) && isset($_SESSION['password']))
    {
        try
        {
            $dbh = new PDO('mysql:host=localhost;dbname=lmscountdown', $user, $pass);
            if (isset($_POST['datecd']))
            {
                var_dump($_POST);
                $datecd = $_POST['datecd'];
                $dbh->exec("UPDATE countdown SET datecd =".$datecd." WHERE id=1");
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
        <link href="/assets/images/favicon/logopufrweb.ico" rel='icon' type='img/ico' />
    </head>
    <body>
        <input id="datetimepicker" type="text"/>
        <form action="" method="POST">
            <input id="truedate" type="hidden" name="datecd"/>
            <input type="submit" value="change"/>
        </form>
    </body>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-dateFormat.min"></script>
    <script src="assets/js/build/jquery.datetimepicker.full.min.js"></script>
    <script type='text/javascript'>
        $('#datetimepicker').datetimepicker();
        $('#datetimepicker').on('change', function()
        {
            var d = new Date($('#datetimepicker').val()).getTime();
             $('#truedate').val(DateFormat.format.date(d, "yyyy, d, M, h"));
        });
    </script>
</html>
