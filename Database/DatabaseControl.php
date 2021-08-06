<?php 
include_once 'sqlConnection.php';

$sqlControl = "select * from users";
$sqlDropOffer = "drop table offers";
$sqlOffer = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = \"+00:00\";
CREATE TABLE `offers` (
  `id` int(11) NOT NULL COMMENT 'Teklif Id si',
  `productId` int(11) DEFAULT NULL COMMENT 'Ürün Id si',
  `userId` int(11) DEFAULT NULL COMMENT 'Kullanici Id si',
  `offerHead` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'Teklif açıklaması',
  `offerValue` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'Teklif para değeri',
  `offerCreateTime` datetime DEFAULT NULL COMMENT 'Teklif Oluşturulma Tarihi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `productId` (`productId`) USING BTREE,
  ADD KEY `userId` (`userId`) USING BTREE;
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Teklif Id si', AUTO_INCREMENT=27;
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;";




$sqlUser = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = \"+00:00\";
CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `PERMISSION_LEVEL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
INSERT INTO `users` (`ID`, `NAME`, `EMAIL`, `PASSWORD`, `PERMISSION_LEVEL`) VALUES
(1, 'admin', 'admin@mail.com', '\$2y\$10\$RgRgUoWYaLIHrUWgdUyBh.JxFwID3cBbOIwEz73m5M1i4C52SOjX6', 1);
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;
";




$conn = OpenCon();
$result = mysqli_query($conn, $sqlControl);

//users tablosunun var olup olmadigina bakiliyor
//sistemde hata olmasini onlemek icin
$a = mysqli_fetch_assoc($result);
if(!$a){
	$sqlsUser=explode(";", $sqlUser);
	foreach($sqlsUser as $sql){
		$conn->query($sql.";");
	}
	$conn->query($sqlDropOffer);
	$sqlsOffer=explode(";", $sqlOffer);
	foreach($sqlsOffer as $sql){
		$conn->query($sql.";");
	}
	echo "Database Değişiklikleri Başarıyla gerçekleştirildi";
}

CloseCon($conn);
?>