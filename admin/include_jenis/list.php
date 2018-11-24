<?php 
$select_jenis = mysqli_query($connection, "SELECT * FROM jenis");


 ?>

 	<a href="?source=add"><button type="button" class="btn btn-info">Add Jenis</button></a>
	<hr>
	<table class="table">
		
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>JENIS</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php while ($row = mysqli_fetch_assoc($select_jenis)): ?>
	      <tr>
	        <td><?php echo $jenis_id = $row['jenis_id']; ?></td>
	        <td><?php echo $jenis_name = $row['jenis_name']; ?></td>
	        <td>
	        	<a href="?source=edit&id=<?php echo $jenis_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
	        	<a href="?source=delete&id=<?php echo $jenis_id; ?>" onClick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger">Delete</button></a>
	        	
	        </td>
	      </tr>
	      <?php endwhile; ?>
	      
	    </tbody>
	</table>