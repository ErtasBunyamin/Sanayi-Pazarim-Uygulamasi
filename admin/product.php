<!--initialize php--> 
<?php 
  include '../Database/DatabaseFunctions.php';
  include 'Controllers/SessionControl.php';
  if($_GET['product']){
    $product = getProductFromID($_GET['product']);
    $offerStart = date_create($product['offerCreateTime']);
    $offerEnd = date_create($product['offerFinishedTime']);
    $countOfOffers = getOfferCount($product['id']);
  }else{
    header("location: landing.php");  
  }
  
 ?>
<!------------------->
<?php 
  include 'header.php';
  ?>
    <section class="section bg-secondary">
      <div class="container">
          <div class="p-4">
            <div class="row justify-content-center">
              <div class="">
                <div class="card-profile-image">
                  <div class="shadow bg-primary text-center text-white" style="width: 250px; height: 250px;">
                    <img src="<?php echo $product['productImage']; ?>" onerror="this.onerror=null; this.src='../images/shop/default_product_image.png';" alt=""  height="250">
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-5">
              
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i><?php echo $product['productName']; ?></div>
              <div><i class="ni education_hat mr-2"></i><?php echo date_format($offerStart,'d-F-Y')." / ".date_format($offerEnd,'d-F-Y'); ?></div>
              <div><i class="ni education_hat mr-2"></i>Teklif Sayısı:<?php echo " ".$countOfOffers; ?></div>
              <div><i class="ni education_hat mr-2"></i>Ürün Id:<?php echo " ".$product['id']; ?></div>
            </div>
            <div class="mt-5 py-2 text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <p><?php echo $product['productDescription']; ?></p>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
<?php 
  include 'footer.php';
?>
