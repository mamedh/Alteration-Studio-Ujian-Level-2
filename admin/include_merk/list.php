<?php 
$select_merk = mysqli_query($connection, "SELECT * FROM merk");


 ?>

 	<a href="?source=add"><button type="button" class="btn btn-info">Add Merk</button></a>
	<hr>
	<table class="table">
		
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>MERK</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php while ($row = mysqli_fetch_assoc($select_merk)): ?>
	      <tr>
	        <td><?php echo $merk_id = $row['merk_id']; ?></td>
	        <td><?php echo $merk_name = $row['merk_name']; ?></td>
	        <td>
	        	<a href="?source=edit&id=<?php echo $merk_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
	        	<a href="?source=delete&id=<?php echo $merk_id; ?>" onClick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger">Delete</button></a>
	        	
	        </td>
	      </tr>
	      <?php endwhile; ?>
	      
	    </tbody>
	</table>