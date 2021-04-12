<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLastestIp = $product->getLastestIphone();
			if ($getLastestIp) {
				while ($resultIphone = $getLastestIp->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="preview.php"> <img src="admin/uploads/<?php echo $resultIphone['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>IPHONE</h2>
							<p><?php echo $resultIphone['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $resultIphone['productId'];?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLastestSs = $product->getLastestSamsung();
			if ($getLastestSs) {
				while ($resultss = $getLastestSs->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="preview.php"><img src="admin/uploads/<?php echo $resultss['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Samsung</h2>
							<p><?php echo $resultss['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $resultss['productId'];?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="section group">
		<?php
			$getLastestOp = $product->getLastestOppo();
			if ($getLastestOp) {
				while ($resultOp = $getLastestOp->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="preview.php"><img src="admin/uploads/<?php echo $resultOp['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Oppo</h2>
							<p><?php echo $resultOp['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $resultOp['productId'];?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLastestVv = $product->getLastestVivo();
			if ($getLastestVv) {
				while ($resultVv = $getLastestVv->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="preview.php"><img src="admin/uploads/<?php echo $resultVv['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Vivo</h2>
							<p><?php echo $resultVv['productName'] ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $resultVv['productId'];?>">Chi tiết</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>