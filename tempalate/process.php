<?php
session_start();
require_once ('database.php');
$database = new Database();


if (isset($_POST) && !empty($_POST)){
    if (isset($_POST['action'])){
        switch ($_POST['action']){
            case 'add';
            if (isset($_POST['quantity']) && isset($_POST['product_id']) ){
                $sql = "SELECT * FROM products WHERE id=" .(int)$_POST['product_id'];
                $product = $database -> runQuery();
                $product = current($product);
                $product_id= $product["id"];
                if (isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])){

                   if (isset($_SESSION["cart_item"][$product_id])) {
                        $exit_cart_item = $_SESSION['cart_item'][$product_id];
                        $exit_quantity = $exit_cart_item['quantity'];
                        $cart_item[]=array();
                        $cart_item["id"]=$product["id"];
                        $cart_item["product_name"]=$product["product_name"];
                        $cart_item["product_image"]=$product["product_image"];
                        $cart_item["prices"]=$product["prices"];
                        $cart_item["quantity"]=$exit_quantity + $_POST["quantity"];
                        $_SESSION["cart_item"][$product_id]= $cart_item;
                    } else{
                       $cart_item[]=array();
                       $cart_item["id"]=$product["id"];
                       $cart_item["product_name"]=$product["product_name"];
                       $cart_item["product_image"]=$product["product_image"];
                       $cart_item["prices"]=$product["prices"];
                       $cart_item["quantity"]=$exit_quantity + $_POST["quantity"];
                       $_SESSION["cart_item"][$product_id]= $cart_item;
                   }



                } else{
                    $_SESSION["cart_item"] = array();

                    $cart_item[]=array();
                    $cart_item["id"]=$product["id"];
                    $cart_item["product_name"]=$product["product_name"];
                    $cart_item["product_image"]=$product["product_image"];
                    $cart_item["prices"]=$product["prices"];
                    $cart_item["quantity"]=$_POST["quantity"];
                    $_SESSION["cart_item"][$product_id]= $cart_item;
                }
            }
            break;
            case 'remove':
                if (isset($_POST["product_id"])){
                $product_id=$_POST['product_id'];
                if (isset($_SESSION["cart_item"]["product_id"])){
                    unset($_SESSION["cart_item"]["product_id"]);
                }
                }
            break;
            default:
                echo"Action không tồn tại ";


            die;
        }
    }


}
header("Location: http://http://localhost/btvn/tempalate/index.php");
die();



