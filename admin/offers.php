<!--initialize php--> 
<?php 
  include '../Database/DatabaseFunctions.php';
  include 'Controllers/SessionControl.php';
  if($_GET['product']){
    $offers = getOffersOfProduct($_GET['product']);
  }else{
    header("location: landing.php");  
  }
  
 ?>
<!------------------->
<?php 
  include 'header.php';
  
  ?>
<div class="container-fluid">
<table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Kullanıcı Adı</th>
            <th class="text-center">Kullanıcı Eposta</th>
            <th class="text-center">Ürün adı</th>
            <th class="text-center">Teklif Açıklama</th>
            <th class="text-center">Teklif Değeri</th>
            <th class="text-center">Teklif Oluşturulma Zamanı</th>
        </tr>
    </thead>
    <tbody>
    <?php
      if ($offers->num_rows <= 0) {
          echo "<p>Teklif bulunmuyor!</p>";
      }else{
        while ($offer = $offers->fetch_assoc()) {
          $product = getProductFromId($offer['productId']);
          $user = getUserFromId($offer['userId']);
          $userName = $user['NAME'];
          $userEmail = $user['EMAIL'];

          echo '<tr>
                  <td class="text-center">'.$offer['id'].'</td>
                  <td class="text-center">'.$userName.'</td>
                  <td class="text-center">'.$userEmail.'</td>
                  <td class="text-center">'.$product['productName'].'</td>
                  <td class="text-center">'.$offer['offerHead'].'</td>
                  <td class="text-center">'.$offer['offerValue'].'</td>
                  <td class="text-center">'.$offer['offerCreateTime'].'</td>
                </tr>';
        }
      }
      
    ?>
    </tbody>
  </table> 
  </div>   
<?php 
  include 'footer.php';
?>
