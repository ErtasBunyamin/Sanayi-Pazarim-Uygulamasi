<!--initialize php--> 
<?php 
  include '../Database/DatabaseFunctions.php';
  $products = getProducts();
 ?>
<!------------------->
<?php 
  include 'header.php';
  ?>
<table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Ürün adı</th>
            <th class="text-center">Teklif Oluşturma Zamanı</th>
            <th class="text-center">Teklif Bitiş Zamanı</th>
            <th class="text-center">Teklif Sayısı</th>
            <th class="text-center">Işlemler</th>
        </tr>
    </thead>
    <tbody>
    <?php
      while ($product = $products->fetch_assoc()) {
        $offerCount = getOfferCount($product['id']);
        $category = getCategoryFromId($product['categoryId']);
        $categoryName = $category['category'];
        $toOfferPage = "offers.php?product=".$product['id'];
        $toProductDetailPage = "product.php?product=".$product['id'];
        echo '<tr>
                <td class="text-center">'.$product['id'].'</td>
                <td class="text-center">'.$categoryName.'</td>
                <td class="text-center">'.$product['productName'].'</td>
                <td class="text-center">'.$product['offerCreateTime'].'</td>
                <td class="text-center">'.$product['offerFinishedTime'].'</td>
                <td class="text-center">'.$offerCount.'</td>
                <td class="">
                  <a type="button" href="'.$toOfferPage.'" rel="tooltip" class="btn btn-info btn-icon btn-sm text-center" data-original-title="" title="">
                    <i class="ni ni-circle-08 pt-1">  Teklifler</i> 
                  </a>
                  <a type="button" href="'.$toProductDetailPage.'" rel="tooltip" class="btn btn-success btn-icon btn-sm text-center" data-original-title="" title="">
                    <i class="ni ni-settings-gear-65 pt-1">    Detay</i>
                  </a>
                </td>
              </tr>';
      }
    ?>
    </tbody>
  </table>    
<?php 
  include 'footer.php';
?>
