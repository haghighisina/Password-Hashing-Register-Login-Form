<?php
$msg = "";

if (isset($_POST['submit'])){
    $db = new PDO('mysql:host=localhost;dbname=registers', 'root', '');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password != $cpassword){
        $msg = "Pls Check your Password";
    }else{

        $hash = password_hash($password,PASSWORD_BCRYPT);
        $sql = "INSERT INTO `user` (name,email,password) VALUES (:name, :email, :password)";

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':name' => $name, ':email' => $email, ':password' => $hash));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $msg = "Registered";
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
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <?php if ($msg != "") echo $msg . "<br><br>";?>
            <div class="col-md-6 col-md-offset-3" align="center">
                <form method="post" action="registration.php">
                    <input class="form-control" minlength="3" name="name" placeholder="Name..."><br>
                    <input class="form-control" name="email" placeholder="Email..."><br>
                    <input class="form-control" minlength="5" name="password" type="password" placeholder="Password..."><br>
                    <input class="form-control" minlength="5" name="cpassword" type="password" placeholder="Confirm Password..."><br>
                    <input class="form-control btn-primary w-25" name="submit" type="submit" placeholder="Register..."><br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
