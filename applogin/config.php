<?php
define("DB_SERVER","localhost");

define("DB_SERVER_USERNAME","root");

define("DB_SERVER_PASSWORD","");

define("DB_SERVER_NAME","demoapplogin");

$connection = mysqli_connect(DB_SERVER,DB_SERVER_USERNAME ,DB_SERVER_PASSWORD,DB_SERVER_NAME );

if ($connection== false){
    die("ERROR Không thể kết nối đến CSDL".mysqli_connect_error());

}
