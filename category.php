<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Kategoriler</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<?php 
			$sql = "SELECT * FROM productcategories";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
		 ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title active"><a href="index.php?category=<?php echo $row['id']; ?>&categoryName=<?php echo $row['category'];?>"><?php echo $row['category']; ?></a></h4>
				</div>
			</div>
		<?php
				}

			} else {
				echo "0 results";
			}
		?>
		</div><!--/category-products-->
	</div>
</div>