<?php 
include_once 'sqlConnection.php';
//Product veri tabani fonksiyonlari
function getProductFromId($productId)
{
	$conn = OpenCon();
	$sql = "SELECT * FROM products where id =".$productId;
	$result = $conn->query($sql);

	if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		return $row;
	}else {
		echo "Ürün bulunamadı";
		return null;
	}
	CloseCon($conn);
}
//Category veri tabani fonksiyonlari
function getCategoryFromId($categoryId)
{
	$conn = OpenCon();
	$sql = "SELECT * FROM productcategories where id =".$categoryId;
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		return $row;
	}else {
		echo "Kategori bulunamadı";
		return null;
	}
	CloseCon($conn);
}
//Offers veri tabani fonksiyonlari
function getOffersOfProduct($productId)
{
	$conn = OpenCon();
	$sql = "SELECT * FROM offers where productId =".$productId." order by offerValue desc";
	$result = $conn->query($sql);
	if ($result->num_rows >0) {
		return $result;
	}else {
		return NULL;
	}
	CloseCon($conn);
}
function getMaxOffer($productId){
	$conn = OpenCon();
	$sql = "SELECT * FROM offers where productId =".$productId." order by offerValue desc limit 1";
	$result = $conn->query($sql);
	if ($result->num_rows  == 1) {
		$row = $result->fetch_assoc();
		return $row;
	}else {
		echo "teklif yokk";
		return NULL;
	}
	CloseCon($conn);
}
function getOffersFromId($offerId)
{
	$conn = OpenCon();
	$sql = "SELECT * FROM offers where id =".$offerId;
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		return $row;
	}else {
		echo "Teklif bulunamadı";
		return null;
	}
	CloseCon($conn);
}
//Users veri tabani fonksiyonlari
function getUserFromId($userId)
{
	$conn = OpenCon();
	$sql = "SELECT * FROM users where ID =".$userId;
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		return $row;
	}else {
		echo "Kullanici bulunamadı";
		return null;
	}
	CloseCon($conn);
}
?>