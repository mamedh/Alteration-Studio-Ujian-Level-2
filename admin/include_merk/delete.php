<?php 

$merk_id = $_GET['id'];
$select_barang = mysqli_query($connection, "SELECT * FROM barang WHERE barang_id = $merk_id");

while ($row = mysqli_fetch_assoc($select_barang)) {
    $barang_merk = $row['barang_merk'];
       
}
 
if ($merk_id == $barang_merk) {
	echo "Masih ada barang yang memiliki merk ini";
} else {
	$select_categories = mysqli_query($connection, "DELETE FROM merk WHERE merk_id = $merk_id");
	header("Location: merk.php");
}

 ?>