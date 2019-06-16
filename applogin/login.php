<?php
session_start();
if (isset($_SESSION["loggedin"]) &&($_SESSION["loggedin"]==true) ){
    header('Location: index.php');
    exit;
}

include_once "config.php";
$erron=array();

if (isset($_POST) && !empty($_POST)){
        if (!isset($_POST["username"]) || empty($_POST["username"])){
            $erron[]="Chưa nhập username";
        }
        if ( !isset($_POST["username"]) ||empty($_POST["password"])){
            $erron[]="Chưa nhập password";
        }
        if (is_array($erron) && empty($erron)){
            $username=$_POST["username"];
            $password=$_POST["password"];
            $sqlLogin="SELECT * FROM users WHERE username = ? AND password = ?";

            $stmt = $connection->prepare($sqlLogin);

            $stmt->bind_param("ss", $username, $password  );

            $stmt->execute();

            $res = $stmt ->get_result();

            $row = $res->fetch_array(MYSQLI_ASSOC);
                if (isset($row['id'])&& $row["id"] > 0){
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $row["username"];
                    header('Location: index.php');
                    exit;

                    } else{
                    $erron[]="Dữ liệu đăng nhập không đúng";
                    }
        }

}
if (is_array($erron)&& !empty($erron)){
    $erron_string = implode("<br>", $erron);
    echo "<div class='alert alert-danger'>";
    echo $erron_string;
    echo"</div>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-sm-12">
            <h1>Đăng nhập</h1>
            <form name="login" action="" method="post">
                <div class="form-group">
                    <label >Username</label>
                    <input type="text" name="username" class="form-control"  placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control"   placeholder="Password">
                </div>
                <div class="form-group form-check">
                    <p><a href="register.php">Đăng ký</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>