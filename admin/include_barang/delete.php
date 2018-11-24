<?php 
$barang_id = $_GET['id'];
$select_barang = mysqli_query($connection, "DELETE FROM barang WHERE barang_id = $barang_id");
header("Location: barang.php");
 ?>