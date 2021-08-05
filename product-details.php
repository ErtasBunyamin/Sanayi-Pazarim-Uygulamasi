<?php 
include 'sqlConnection.php';
include 'DatabaseFunctions.php';

session_start();
$id = $_GET['product'];
if (!$_GET['product'] && isset($_SESSION['productId'])) {
	$id = $_SESSION['productId'];
	echo "----------/---------------";
}else {
	$_SESSION['productId'] = $id;
	echo "--------------*--------------";
}

$product = getProductFromId($id);
$category = getCategoryFromId($product['categoryId']);
$offers = getOffersOfProduct($id);
$maxOffer = getMaxOffer($id);
include 'offerCheck.php';
echo "category: ".($category['category']);



include 'header.php';
 ?>
<section>
		<div class="container">
			<div class="col">
				<?php include 'category.php'; ?>
				<div class="row-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="row-sm-7">
							<div class="view-product">
								<img src="<?php echo $product['productImage'];?>" onload="this.src='images/shop/default_product_image.png'" onerror="this.onerror=null; this.src='images/shop/default_product_image.png'" alt=""  height="250"/>
							</div>
							

						</div>
						<div class="row-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2><?php echo $product['productName']; ?></h2>
								<span>
									<span><?php echo $maxOffer ? "En yüksek teklif : ".$maxOffer['offerValue']." TL" : "Teklif bulunmamakta!";?></span>
									<a type="button" href="#reviews"  class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Teklif Ver
									</a>
								</span>
								<p><b>Kategori:</b> Hırdavat</p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Detaylar</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Teklifler (<?php echo $offers ? $offers->num_rows : 0; ?>)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="product-information"><!--/product-information-->
									<h3><?php echo $product['productName']; ?></h2>
									<h2><?php echo $product['productDescription']; ?></h3>
									<p><b>Kategori:</b><?php echo $category['category'];?></p>
									<p><b>Ürün teklif olusturulma tarihi:</b> <?php echo $product['offerCreateTime']; ?> </p>
									<p><b>Ürün teklif bitiş tarihi:</b> <?php echo $product['offerFinishedTime']; ?> </p>
									<span>
										<span><?php echo $maxOffer ? "En yüksek teklif : ".$maxOffer['offerValue']." TL" : "Teklif bulunmamakta!";?></span>
									</span>
									
								</div>
							</div>
							
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<?php 
										if (!$offers) {
											echo "<p>Bu ürün için teklif bulunmamakta.</p>";
										}else {
											while ($row = $offers->fetch_assoc()) {
												$user = getUserFromId($row['userId']);
												$date = date_create($row['offerCreateTime']);
												echo '<ul>
														<li><a href=""><i class="fa fa-user"></i>'.$user['NAME'].'</a></li>
														<li><a href=""><i class="fa fa-money"></i>'.$row['offerValue'].' TL</a></li>
														<li><a href=""><i class="fa fa-calendar-o"></i>'.date_format($date,'d/F/Y').'</a></li>
													</ul>
													<p><b>Açıklama : </b>'.$row['offerHead'].'</p>
													<br>';
											}
										}

									 ?>
									
									<p><b>Teklifinizi Yapın</b></p>
									
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
										<span>
											<input type="number" name="offerValue" placeholder="Teklif Değerinizi giriniz." required />
											<?php echo "<p>".!empty($offerValue_err) ? $offerValue_err :""."</p>"; ?>
											<input type="text" name="offerDescription" placeholder="Açıklamanız." required />
											<?php echo "<p>".!empty($offerDescription_err) ? $offerDescription_err :""."</p>"; ?>
										</span>
										<button type="Submit" class="btn btn-default">
											Submit
										</button>
									</form>
									<?php 
								        if(!empty($offer_err)){
								            echo '<div class="alert alert-danger">' . $offer_err . '</div>';
								        }        
							        ?>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
				</div>
			</div>
		</div>
	</section>
 <?php 
 include 'footer.php';
  ?>