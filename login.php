<?php
$con = new PDO('mysql:host=localhost;dbname=registers', 'root', '');

$msg = "";
if (isset($_POST['submit'])){


    $sql = "SELECT * FROM `user` WHERE email = :email";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $con->prepare($sql);
    $stmt->execute(array(':email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['id'] > 0) {

        if (password_verify($password, $row['password'])) {
            $msg = "logged in";
        } else {
            $msg = "Pleas check the input";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3" align="center">

            <?php if ($msg != "") echo $msg . "<br><br>"; ?>

            <form method="post" action="login.php">
                <input class="form-control" name="email" placeholder="Email..."><br>
                <input class="form-control" minlength="5" name="password" type="password" placeholder="Password..."><br>
                <input class="form-control btn-primary w-25" name="submit" type="submit" placeholder="Login..."><br>
            </form>
        </div>
    </div>
</div>
</body>
</html>
