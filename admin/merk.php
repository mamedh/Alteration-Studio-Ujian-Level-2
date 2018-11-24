<?php include "../config/db.php"; ?>
<?php include "include/admin_header.php"; ?>

	<div id="wrapper">

		<!-- Navigation -->
		<?php include "include/admin_navigation.php"; ?>

		<div id="page-wrapper">

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							MERK
							<small>Merk</small>
						</h1>
						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
							</li>
							<li class="active">
								<i class="fa fa-file"></i> Merk
							</li>
						</ol>
						<div class="content">
							<?php 
							if (isset($_GET['source'])) {
							 	$source = $_GET['source'];
							 } else {
							 	$source = '';
							 }
							 
							 switch ($source) {
							 	case 'add':
							 		include ('include_merk/add.php');
							 		break;
							 	case 'edit':
							 		include ('include_merk/edit.php');
							 		break;
							 	case 'delete':
							 		include ('include_merk/delete.php');
							 		break;
							 	
							 	default:
							 		include ('include_merk/list.php');
							 		break;
							 }
							  ?>
						</div>						
					</div>
				</div>
				<!-- /.row -->

			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

<?php include "include/admin_footer.php"; ?>