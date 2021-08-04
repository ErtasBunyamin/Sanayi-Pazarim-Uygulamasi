<?php 
include 'sqlConnection.php';
include 'header.php';
if(isset ($_GET['category'])){
	$category = $_GET['category'];
	$categoryName = $_GET['categoryName'];
} else {
	$category = 0;
	$categoryName = "Tüm Ürünler";
}
if (!isset ($_GET['page']) ) {  
	$currentPage = 1;  
} else {  
	$currentPage = $_GET['page'];  
}   
$results_per_page = 9;  
$page_first_result = ($currentPage-1) * $results_per_page;  
?>
	<section>
		<div class="container">
			<div class="row">				
				<?php include 'category.php'; ?>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?php echo $categoryName;?></h2>
						<?php 
							$sql = $category == 0 ? "SELECT * FROM `products`":"SELECT * FROM products where categoryId =".$category;
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$number_of_result = $result->num_rows; 
								$number_of_page = ceil ($number_of_result / $results_per_page);  
							    // her bir satırı döker
							    $sql = "SELECT * FROM products LIMIT ".$page_first_result.','.$results_per_page;
							    $result = $conn->query($sql);
								while($row = $result->fetch_assoc()) {
						?>
							        <div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
														<img src="<?php echo $row['productImage'];?>" onload="this.src='images/shop/default_product_image.png'" onerror="this.onerror=null; this.src='images/shop/default_product_image.png'" alt=""  height="250"/>
													<h2><?php echo $row['id']; ?> TL</h2>
													<p><?php echo $row['productName']; ?></p>
													<p style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
														<?php echo $row['productSubDescription']; ?>
													</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Teklif Ver</a>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<h2>$56</h2>
														<p><?php echo $row['productName']; ?></p>
														<a href="product-details.php" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Teklif Ver</a>
													</div>
												</div>
											</div>
										</div>
									</div>	    
						<?php
								}

							} else {

							    echo "0 results";

							}?>
						
						
					</div><!--features_items-->

					<div class="text-center"><!--pagination-->
						<ul class="pagination">
							<?php for ($page=1; $page <= $number_of_page; $page++) {
								$isActive = ($page == $currentPage) ? "active" : "" ; 
								echo '<li class='.$isActive.'><a href="index.php?page='.$page.'">'.$page.'</a></li>';
							}?>
						</ul>
					</div><!--pagination-->
				</div>
			</div>
		</div>
	</section>

<?php include 'footer.php';?>