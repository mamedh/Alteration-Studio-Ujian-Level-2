<?php 
$select_barang = mysqli_query($connection, "SELECT * FROM barang");
$select_merk = mysqli_query($connection, "SELECT * FROM merk"); 
$select_jenis = mysqli_query($connection, "SELECT * FROM jenis");
 ?>
<?php 

if (isset($_POST['submit'])) {
	$filter_barang = $_POST['filter_barang'];
	$filter_merk = $_POST['filter_merk'];
	$filter_jenis = $_POST['filter_jenis'];
} else{
	$filter_barang = '';
	$filter_merk = '';
	$filter_jenis = '';
}
$a = " WHERE ";
$b = "barang_name LIKE '%$filter_barang%'";
$c = "barang_merk = '$filter_merk'";
$d = "barang_jenis = '$filter_jenis'";
$query = "SELECT * FROM barang";

if ($filter_barang OR $filter_merk OR $filter_jenis) {
	$query = $query.$a;

	$condition = [];
	if ($filter_barang) {
		$condition[] = $b;
	}

	if ($filter_merk) {
		$condition[] = $c;
	} 

	if ($filter_jenis) {
		$condition[] = $d;
	}

	$query = $query . implode(" AND ", $condition);
}

$select_barang = mysqli_query($connection, $query);

 ?>


	
<a href="?source=add"><button type="button" class="btn btn-info">Add Barang</button></a>
<hr>
<h3>Filter</h3><?php echo $query; ?>
<form name="form_search" action="" method="POST">
	<div class="form-group">
		<div class="form-row">
			<div class="form-group col-md-1">
			<label>Nama :</label>
			</div>
			<div class="form-group col-md-11">
				<input type="text" name="filter_barang" id="filter_barang">
			</div>
			
		</div>
	</div>
	<div class="form-group">
		<div class="form-row">
			<div class="form-group col-md-1">
				<label>Merk :</label>
			</div>
			<div class="form-group col-md-11">
				<select class="form-group" name="filter_merk" id="filter_merk">
				<option value="">Select Option</option>
			<?php while ($row = mysqli_fetch_assoc($select_merk)): ?>
                <option value="<?php echo $row['merk_id']; ?>"><?php echo $row['merk_name']; ?></option>
            <?php endwhile; ?>
			</select>	
			</div>
		</div>
	</div>
	<div class="form-group">
		<form name="form_search" action="" method="POST">
		<div class="form-row">
			<div class="form-group col-md-1">
			<label>Jenis :</label>
			</div>
			<div class="form-group col-md-11">
				<select class="form-group" name="filter_jenis" id="filter_jenis">
				<option value="">Select Option</option>
				<?php while ($row = mysqli_fetch_assoc($select_jenis)): ?>
                    <option value="<?php echo $row['jenis_id']; ?>"><?php echo $row['jenis_name']; ?></option>
                <?php endwhile; ?>
			</select>
			</div>
		</div>
	</div>
	<div class="form-group">
		<button class="btn btn-success" type="submit" name="submit">
			Apply
		</button>
	</div>
</form>
<hr>
<table class="table">
	
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Merk</th>
        <th>Jenis</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    	<?php while ($row = mysqli_fetch_assoc($select_barang)):
    		$merk_id = $row['barang_merk'];
    		$jenis_id = $row['barang_jenis'];
    			    		
    		$select_merk = mysqli_query($connection, "SELECT * FROM merk WHERE merk_id = $merk_id");
    		$row_merk = mysqli_fetch_assoc($select_merk);
    		$merk_name = $row_merk['merk_name'];
    		
    		$select_jenis = mysqli_query($connection, "SELECT * FROM jenis WHERE jenis_id = $jenis_id");
			$row_jenis = mysqli_fetch_assoc($select_jenis);
    		$jenis_name = $row_jenis['jenis_name'];
    		
    	 ?>
      <tr>
        <td><?php echo $barang_id = $row['barang_id']; ?></td>
        <td><?php echo $barang_name = $row['barang_name']; ?></td>
        <td><?php echo $merk_name; ?></td>
        <td><?php echo $jenis_name; ?></td>
        <td><?php echo $barang_stok = $row['barang_stok']; ?></td>
        <td>
        	<a href="?source=ubah_stok&id=<?php echo $barang_id; ?>"><button type="button" class="btn btn-success">Ubah Stok</button></a>
        	<a href="?source=edit&id=<?php echo $barang_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
        	<a href="?source=delete&id=<?php echo $barang_id; ?>" onClick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger">Delete</button></a>
        	
        </td>
      </tr>
      <?php endwhile; ?>
      
    </tbody>
</table>