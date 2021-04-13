<?php
include 'inc/header.php';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

	$insertCustomers = $cs->insert_customers($_POST);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

	$login_Customers = $cs->login_customers($_POST);
}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			
			<form action="" method="post">
				<input class="form-control" type="text" name="email" class="field" placeholder="Enter Email....">
				<input class="form-control" type="password" name="password" class="field" placeholder="Enter Password....">
				<div class="buttons-input">
					<div><input class="btn btn-success" type="submit" name="login" class="grey" value="Sign In"></div>
				</div>
			</form>
			<?php
			if (isset($login_Customers)) {
				echo $login_Customers;
			}
			?>
		</div>
		<?php

		?>
		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($insertCustomers)) {
				echo $insertCustomers;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input class="form-control" type="text" name="name" placeholder="Enter Name...">
								</div>

								<div>
									<input class="form-control" type="text" name="city" placeholder="Enter City...">
								</div>

								<div>
									<input class="form-control" type="text" name="address" placeholder="Enter Address...">
								</div>
							

							</td>
							<td>
								<div>
									<input class="form-control" type="text" name="email" placeholder="Enter Email...">

								</div>
								<div>
									<input class="form-control" type="text" name="phone" placeholder="Enter Phone...">
								</div>

								<div>
									<input class="form-control" type="password" name="password" placeholder="Enter Password...">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div>
					<div><input class="btn btn-primary" type="submit" name="submit" class="grey" value="Create Account"></div>
				</div>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>