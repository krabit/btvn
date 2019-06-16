<?php
session_start();
if (!isset($_SESSION["loggedin"]) || ($_SESSION["loggedin"]!=true)) {
header('Location: login.php');
exit;
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
<div class="container">
    <div class="row">
        <div class="c0l-md-12">
            <h1>Đăng nhập thành công</h1>
            <p>Tên người dùng :<?php echo $_SESSION["username"]?> </p>
            <a href="lock-out.php">Đăng xuất</a>
        </div>
    </div>
</div>
</body>
</html>