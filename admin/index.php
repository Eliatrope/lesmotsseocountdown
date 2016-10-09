<?php
    session_start();
    require('config.php');
    require('PasswordHash.php');
    $t_hasher = new PasswordHash(8, FALSE);
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
            $stmt = $dbh->prepare("SELECT password FROM users WHERE username = :username");
            $stmt->bindParam(":username", $_POST['username'], PDO::PARAM_STR);
            $stmt->execute();
            if ($password = $stmt->fetch())
            {
                if ($t_hasher->CheckPassword($_POST['password'], $password[0]))
                {
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password'];
                    header('Location:dashboard.php');
                }
                else
                    header('Location:index.php');
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
