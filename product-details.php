<?php 
include 'sqlConnection.php';
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
								<img src="images/product-details/1.jpg" alt="" />
							</div>
							

						</div>
						<div class="row-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2>Anne Klein Sleeveless Colorblock Scuba</h2>
								<span>
									<span>En yüksek teklif : $59</span>
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Teklif Ver
									</button>
								</span>
								<p><b>Kategori:</b> Hırdavat</p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Detaylar</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Teklifler (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="product-information"><!--/product-information-->
									<h3>Ürün Adı</h2>
									<h2>ürün açıklaması!</h3>
									<p><b>Kategori:</b> Hırdavat</p>
									<p><b>Ürün teklif olusturulma tarihi:</b> 12.10.20 </p>
									<p><b>Ürün teklif bitiş tarihi:</b> 12.12.20 </p>
									<span>
										<span>En yüksek teklif : $59</span>
									</span>
									
								</div>
							</div>
							
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-money"></i>500 TL</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Teklifinizi Yapın</b></p>
									
									<form action="#">
										<span>
											<input type="number" placeholder="Teklif Değerinizi giriniz."/>
											<input type="text" placeholder="Açıklamanız."/>
										</span>
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
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