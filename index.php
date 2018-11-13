<?php
        session_start();
        
        //connect to database 
        $db = mysqli_connect("localhost", "root", "", "authentication");

        echo $db ? 'conected' : 'not conected';

        if(isset($_POST['register_btn'])) {
            // session_start();

            $username = mysqli_real_escape_string($db, $_POST['username']);
            $userlastname = mysqli_real_escape_string($db, $_POST['userlastname']);
            $city = mysqli_real_escape_string($db, $_POST['city']);
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
            $password2 = mysqli_real_escape_string($db, $_POST['password2']);

            if($password == $password2) {
            //     //create user
                $password = md5($password); //to secure password with hash
                $sql = "INSERT INTO users(username, userlastname, city, email, password) VALUES('$username', '$userlastname', '$city', '$email', '$password')";
                // mysqli_query($db, $sql);
                if (!mysqli_query($db,$sql)) {
                    die('Error: ' . mysqli_error($db));
                  }
                  
                $_SESSION['message'] = "Jesteś zalogowany";
                $_SESSION['username'] = $username;
                header("location: home.php"); //redirect to home page
            } else {
                //failed
                $_SESSION['message'] = "Podane hasła nie są takie same, popraw i zapisz";
            }
            mysqli_close($db);
        }
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Zapisz się dziś!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="simple-grid/simple-grid.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <section class="section-intro header">
            <div class="container">
                <h1>Cześć!</h1>
                <h2>Dopisz się do listy startowej!</h2>
            </div>
            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
                    unset($_SESSION['message']);
                }
            ?>
        </section>
        <section class="section-registration-form">
            <div class="container">
                <form method="post" action="" class="form">
                    <div class="row">
                        <div class="col-6">
                            <label for="username">Imię</label>
                            <input type="text" name="username" placeholder="Imię">
                        </div>
                        <div class="col-6">
                            <label for="userlastname">Nazwisko</label>
                            <input type="text" name="userlastname" placeholder="Nazwisko">
                        </div>
                        <!-- <div class="col-6">
                            <label for="yearofbirth">Data urodzenia</label>
                            <input type="date" name="yearofbirth">
                        </div> -->
                        <div class="col-6">
                            <label for="city">Miasto</label>
                            <input type="text" name="city" placeholder="Miasto">
                        </div>
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="col-6">
                            <label for="password">Hasło</label>
                            <input type="password" name="password" placeholder="Hasło">
                        </div>
                        <div class="col-6">
                            <label for="password2">Powtórz hasło</label>
                            <input type="password" name="password2" placeholder="Hasło">
                        </div>
                        <div class="col-12">
                            <input class="btn-submit" type="submit" name="register_btn" value="Zapisz się!">
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
    </body>
</html>