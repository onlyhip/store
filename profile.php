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
                    <h3>Profile Customers</h3>
                </div>
                <div class="clear"></div>
            </div>

            <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if ($get_customers) {
                    while ($result = $get_customers->fetch_assoc()) {

                ?>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><?php echo $result['city'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $result['phone'] ?></td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td><?php echo $result['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Update Profile</a></td>

                        </tr>

                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>