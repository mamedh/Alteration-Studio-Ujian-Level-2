<script src="../assets/js/wysihtml5-0.3.0.js"></script>
<script src="../assets/js/jquery-1.7.2.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap-wysihtml5.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-wysihtml5.css"></link>

<?php 
$barang_id = $_GET['id'];
$select_merk = mysqli_query($connection, "SELECT * FROM merk"); 
$select_jenis = mysqli_query($connection, "SELECT * FROM jenis");
$select_barang = mysqli_query($connection, "SELECT * FROM barang WHERE barang_id = $barang_id");

while ($row = mysqli_fetch_assoc($select_barang)) {
    $barang_id = $row['barang_id'];
    $barang_name = $row['barang_name'];
    $barang_merk = $row['barang_merk'];
    $barang_jenis = $row['barang_jenis'];
	$barang_stok = $row['barang_stok'];
    
}

// bikin buat update
if (isset($_POST['submit'])) {
    $barang_name = $_POST['barang_name'];
    $barang_merk = $_POST['barang_merk'];
    $barang_jenis = $_POST['barang_jenis'];
    $barang_stok = $_POST['barang_stok'];
	


    if ($barang_name == "" || empty($barang_name) || $barang_stok == "" || empty($barang_stok))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "UPDATE barang SET barang_name = '$barang_name', barang_merk = '$barang_merk', barang_jenis = '$barang_jenis', barang_stok = '$barang_stok' WHERE barang_id = $barang_id ");
        mysqli_stmt_bind_param($stmt, "sssi", $barang_name, $barang_merk, $barang_jenis, $barang_stok);
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
    	<label>Edit Barang</label>
    	<input type="text" class="form-control" name="barang_name" value="<?php echo $barang_name; ?>">
  	</div>
    <div class="form-group">
        <label for="category">Merk</label>
        <select class="form-control" name="barang_merk" id="barang_merk">
            <?php while ($row = mysqli_fetch_assoc($select_merk)): ?>
                <option value="<?php echo $row['merk_id']; ?>" <?php echo $barang_merk == $row['merk_id'] ? 'selected' : '' ?>><?php echo $row['merk_name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="category">Jenis</label>
        <select class="form-control" name="barang_jenis" id="barang_jenis">
            <?php while ($row = mysqli_fetch_assoc($select_jenis)): ?>
                <option value="<?php echo $row['jenis_id']; ?>" <?php echo $barang_jenis == $row['jenis_id'] ? 'selected' : '' ?>><?php echo $row['jenis_name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Stok</label>
        <input type="text" class="form-control" id="barang_stok" name="barang_stok" value="<?php echo $barang_stok; ?>">
    </div>
    
  	<div class="form-group">
  		<input class="btn btn-primary" type="submit" name="submit" value="Edit Barang">
  	</div>
	
</form>

