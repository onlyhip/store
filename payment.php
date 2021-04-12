<?php
include 'inc/header.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}

?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>

                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Chọn phương thức thanh toán</h3>
                    <a href="offlinepayment.php">Offline Payment</a>
                    	<a href="onlinepayment.php">Online Payment</a><br><br><br>
                    <a style="background:grey" href="cart.php">
                         Quay về</a>
                </div>
            </div>

        </div>
    </div>
    <?php
    include 'inc/footer.php';

    ?>