<?php 
$merk_id = $_GET['id'];

$select_merk = mysqli_query($connection, "SELECT * FROM merk WHERE merk_id = $merk_id");

while ($row = mysqli_fetch_assoc($select_merk)) {
	$merk_id = $row['merk_id'];
	$merk_name = $row['merk_name'];
}

// bikin buat update
if (isset($_POST['submit'])) {
	$merk_name = $_POST['merk_name'];
    
    if ($merk_name == "" || empty($merk_name))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "UPDATE merk SET merk_name = '$merk_name' WHERE merk_id = $merk_id ");
        mysqli_stmt_bind_param($stmt, "s", $merk_name);
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
		
		mysqli_stmt_close($stmt);
        header("Location: merk.php");
    }
}

 ?>

<form action="" method="post">
	<div class="form-group">
    	<label>Edit Merk</label>
    	<input type="text" class="form-control" name="merk_name" value="<?php echo $merk_name; ?>">
  	</div>
  	<div class="form-group">
  		<input class="btn btn-primary" type="submit" name="submit" value="Edit Merk">
  	</div>
	
</form>