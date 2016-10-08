<?php
    session_start();
    require('config.php');
    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=lmscountdown', $user, $pass);
    }
    catch (Exception $e)
    {
        echo "can't connect to database, please contact admin@admin.fr";
        exit(0);
    }

    if (!isset($_SESSION['username']) && !(isset($_SESSION['password'])))
    {
        if (isset($_POST['username']) && isset($_POST['password']))
        {
            $query = $dbh->prepare("SELECT username, password FROM users WHERE username = :username AND password = :password");
            $query->bindParam(":username", $_POST['username'], PDO::PARAM_STR);
            $query->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() == 1)
            {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                header('Location:dashboard.php');
            }
            else
                header('Location:index.php');
        }
        else
            require('login.html');
    }
    else
        header('Location:dashboard.php');
?>