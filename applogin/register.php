<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php
include_once "config.php";
if (isset($_POST) && !empty($_POST)){
    $erron=array();
    if (!isset($_POST["username"])|| empty($_POST["username"])){
         $erron[]="Username không hợp lệ";
    }
    if (!isset($_POST["password"])|| empty($_POST["password"])){
        $erron[]= "Password không hợp lệ";
    }
    if (!isset($_POST["confirm_password"])|| empty($_POST["confirm_password"])){
        $erron[]= "Confirm Password không hợp lệ";

    if (($_POST["confirm_password"])!== ($_POST["confirm_password"])){
        $erron[]= "Confirm Password khác password";
    }
    if (!empty($erron)){
            $username=$_POST["username"];
            $password=md5($_POST["password"]);
            $created_at= date("Y-m-d H:m:s");
        $sqlInsert="INSERT INTO users (username, password, created_at) VALUES (?,?,?)";
        $stmt = $connection->prepare($sqlInsert);
        $stmt->bind_param("sss", $username, $password, $created_at);
        $stmt->execute();
        $stmt->close();
        echo "<div class=''alert alert-success>";
        echo "Đăng kí người dùng mới thành công. Đăng nhập<a href='login.php'>Đăng nhập tại đây</a>";
        echo"</div>";
    }else{
       $erron_string =implode("<br>", $erron);

       echo "<div class=''alert alert-danger>";
       echo $erron_string;
       echo"</div>";
    }
}
?>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-sm-12">
            <h1>Đăng kí người dùng</h1>
            <form name="register" action="" method="post">
                <div class="form-group">
                    <label >Username</label>
                    <input type="text" name="username" class="form-control"  placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control"   placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control"   placeholder="Confirm password">
                </div>

                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>