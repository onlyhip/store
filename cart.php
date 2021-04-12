<?php
include 'inc/header.php';
?>
<?php
if (isset($_GET['cartid'])) {
	$cartid = $_GET['cartid'];
	$delcart = $ct->del_product_cart($cartid);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
	if ($quantity <= 0) {
		$delcart = $ct->del_product_cart($cartId);
	}
}
?>
<?php
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<?php
				if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				}
				?>
				<?php
				if (isset($delcart)) {
					echo $delcart;
				}
				?>
				<table class="tblone">
					<tr>

						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$get_product_cart = $ct->get_product_cart();
					if ($get_product_cart) {
						$subtotal = 0;
						$qty = 0;
						while ($result = $get_product_cart->fetch_assoc()) {
					?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
								<td><?php echo $fm->format_currency($result['price']) . " " . "VNĐ" ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
										<input type="number" name="quantity" min="1" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php
									$total = $result['price'] * $result['quantity'];
									echo $fm->format_currency($total) . " " . "VNĐ";
									?></td>
								<td><a onclick="return confirm('Bạn có muốn xóa không?');" href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
							</tr>
					<?php
							$subtotal += $total;
							$qty = $qty + 1;
						}
					}
					?>

				</table>
				<?php
				$check_cart = $ct->check_cart();
				if ($check_cart) {
				?>
					<table class="tblone" >
						<tr>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Sub Total : </td>
							
							<td><?php
								echo $fm->format_currency($subtotal) . " " . "VNĐ";
								Session::set('sum', $subtotal);
								Session::set('qty', $qty);
								?></td>
						</tr>
						<tr>
							<td>VAT : </td>
							<td>10%</td>
						</tr>
						<tr>
							<td>Grand Total :</td>
							<td><?php

								$vat = $subtotal * 0.1;
								$gtotal = $subtotal + $vat;
								echo $fm->format_currency($gtotal) . " " . "VNĐ";
								?></td>
						</tr>
					</table>
				<?php
				} else {
					echo 'Your Cart is Empty ! Please Shopping Now';
				}
				?>


			</div>
			<?php
			$check_cart = $ct->check_cart();
			if (Session::get('customer_id') == true && $check_cart) {
			?>
				<a class="muahang" style="text-align: right;" href="payment.php"> Thanh toán</a>

		</div>
	<?php
			} else {
	?>
		<a class="muahang" style="text-align: right;" href="login.php"> Mua hàng</a>
	<?php
			}
	?>
	</div>
	<style type="text/css">
		a.muahang {
			float: right;
			padding: 10px 20px;
			border: 1px solid #ddd;
			background: #414045;
			color: #fff;
			cursor: pointer;
		}
	</style>
	<div class="clear"></div>
</div>
</div>
<?php
include 'inc/footer.php';

?>