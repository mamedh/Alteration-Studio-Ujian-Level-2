<?php 

$jenis_id = $_GET['id'];
$select_barang = mysqli_query($connection, "SELECT * FROM barang WHERE barang_id = $jenis_id");

while ($row = mysqli_fetch_assoc($select_barang)) {
    $barang_jenis = $row['barang_jenis'];
       
}
 
if ($jenis_id == $barang_jenis) {
	echo "Masih ada barang yang memiliki jenis ini";
} else {
	$select_categories = mysqli_query($connection, "DELETE FROM jenis WHERE jenis_id = $jenis_id");
	header("Location: jenis.php");
}

 ?>