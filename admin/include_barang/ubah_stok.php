<script src="../assets/js/wysihtml5-0.3.0.js"></script>
<script src="../assets/js/jquery-1.7.2.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap-wysihtml5.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-wysihtml5.css"></link>

<?php 
$barang_id = $_GET['id'];
$select_barang = mysqli_query($connection, "SELECT * FROM barang WHERE barang_id = $barang_id");

while ($row = mysqli_fetch_assoc($select_barang)) {
    $barang_id = $row['barang_id'];
    $barang_name = $row['barang_name'];
	$barang_stok = $row['barang_stok'];
}

// bikin buat update
if (isset($_POST['submit'])) {
    $barang_stok = $_POST['barang_stok'];
	
    if ($barang_name == "" || empty($barang_name))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "UPDATE barang SET barang_stok = '$barang_stok' WHERE barang_id = $barang_id ");
        mysqli_stmt_bind_param($stmt, "i", $barang_stok);
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
		
		mysqli_stmt_close($stmt);
        header("Location: barang.php");
    }
}

 ?>

<form action="" method="post">
	<div class="form-group">
        <label>Kode Barang : <?php echo $barang_id; ?></label>
    </div>
    <div class="form-group">
        <label>Nama Barang : <?php echo $barang_name; ?></label>
    </div>
    <div class="form-group">
    	<label>Stok Barang : <input type="text" name="barang_stok" value="<?php echo $barang_stok; ?>"></label>
    </div>
    <div class="form-group">
  		<input class="btn btn-primary" type="submit" name="submit" value="Ubah Stok">
  	</div>
</form>

