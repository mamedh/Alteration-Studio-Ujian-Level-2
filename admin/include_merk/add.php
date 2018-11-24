<?php
if (isset($_POST['submit']))
{
    $merk_name = $_POST['merk_name'];
    
    if ($merk_name == "" || empty($merk_name))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "INSERT INTO merk(merk_name) VALUES(?) ");
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
    	<label for="merk_name">Add Merk</label>
    	<input type="text" class="form-control" id="merk_name" name="merk_name">
  	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="submit" value="Add Merk">
	</div>
</form>