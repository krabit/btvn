<?php
session_start();
require_once ('database.php');
$database = new Database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
<?php
if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])){


?>
<div class="container">
    <h2>Giỏ hàng</h2>
    <p>Chi tiết giỏ hàng của bạn </p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Id sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá tiền</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa khỏi giỏ hàng</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total =0;
        foreach ($_SESSION["cart_item"] as $key_car => $val_cart_item) : ?>
        <tr>
            <td><?php echo $val_cart_item["id"]?></td>
            <td><?php echo $val_cart_item["product_name"]?></td>
            <td><img class="card-img-top" style="height: 25px; width: auto; display: block;" src="ima/<?php echo $val_cart_item["product_image"]?>" data-holder-rendered="true"></td>
            <td><?php echo number_format($val_cart_item["prices"],0,",",".") ?></td>
            <td><?php echo $val_cart_item["quantity"]?></td>
            <td><?php
                $total_item = $val_cart_item["prices"] *$val_cart_item["quantity"];
                echo $total_item?>VNĐ</td>
            <td>
                <form action="" name="remove<?php echo $val_cart_item["id"]?>" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $val_cart_item["id"]?>">
                    <input type="hidden" name="action" value="remove">
                    <input type="submit" name="submit" value="Xóa vào giỏ hàng" class="btn btn-sm btn-outline-secondary">
                </form>
                </td>
        </tr>
        <?php
        $total +=$total_item;
        endforeach;?>
        </tbody>
    </table>
    <div>
        Tổng hóa đơn thanh toán <strong><?php echo number_format($total,0,",",".");?>VNĐ</strong>
    </div>
</div>


<?php }else{ ?>
<div class="container">
    <h2>Giỏ hàng</h2>
    <p>Giỏ hàng bạn đang rỗng</p>

</div>
<?php ?>
<div class="container" style="margin-top: 50px">
    <div class="row">
        <?php
        $sql="SELECT * FROM product";
        $products = $database -> runQuery();

        ?>
        <?php if( !empty($products)): ?>
        <?php foreach ($products as $product) : ?>
        <div class="col-sm-6">
            <form action="process.php" name="product1<?php echo $product["id"]?>" method="post">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" style="height: 315px; width: 100%; display: block;" src="ima/<?php echo $product["image"]?>" data-holder-rendered="true">
                    <div class="card-body">
                        <p class="card-text" style="font-weight: bold;">Product <?php echo $product["product_name"]?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-line">
                                <input type="text" class="form-control" name="quantity" value="1"/>
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']    ?>">
                                <label style="margin-left:10px ">
                                    <input type="submit" name="submit" value="Thêm vào giỏ hàng" class="btn btn-sm btn-outline-secondary">

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
        <?php endforeach;?>
        <?php endif; ?>
</div>

</body>
</html>
