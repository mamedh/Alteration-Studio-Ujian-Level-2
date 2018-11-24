<script src="../assets/js/wysihtml5-0.3.0.js"></script>
<script src="../assets/js/jquery-1.7.2.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/bootstrap-wysihtml5.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-wysihtml5.css"></link>

<?php
/*GET CATEGORY*/

$select_merk = mysqli_query($connection, "SELECT * FROM merk"); 
$select_jenis = mysqli_query($connection, "SELECT * FROM jenis"); 


if (isset($_POST['submit']))
{
    $barang_name = $_POST['barang_name'];
    $barang_merk = $_POST['barang_merk'];
    $barang_jenis = $_POST['barang_jenis'];
    $barang_stok = $_POST['barang_stok'];
    $merk_baru = $_POST['merk_baru'];
    $jenis_baru = $_POST['jenis_baru'];



    
    if (!empty($merk_baru) AND !empty($barang_name) AND !empty($barang_stok)) {
        $stmt_merk = mysqli_prepare($connection, "INSERT INTO merk(merk_name) VALUES(?) ");
        mysqli_stmt_bind_param($stmt_merk, "s", $merk_baru);
        mysqli_stmt_execute($stmt_merk);
        if (!$stmt_merk)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        
        mysqli_stmt_close($stmt_merk);
        
    }
        
    if (!empty($jenis_baru) AND !empty($barang_name) AND !empty($barang_stok)) {
        $stmt_jenis = mysqli_prepare($connection, "INSERT INTO jenis(jenis_name) VALUES(?) ");
        mysqli_stmt_bind_param($stmt_jenis, "s", $jenis_baru);
        mysqli_stmt_execute($stmt_jenis);
        if (!$stmt_jenis)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        
        mysqli_stmt_close($stmt_jenis);
        
    }

    $select_merk_baru = mysqli_query($connection, "SELECT * FROM merk WHERE merk_name = '$merk_baru'"); 
    $row_merk = mysqli_fetch_assoc($select_merk_baru);
    $merk_baru_id = $row_merk['merk_id'];
    $select_jenis_baru = mysqli_query($connection, "SELECT * FROM jenis WHERE jenis_name = '$jenis_baru'"); 
    $row_jenis = mysqli_fetch_assoc($select_jenis_baru);
    $jenis_baru_id = $row_jenis['jenis_id'];


    if ((!empty($merk_baru) OR !empty($jenis_baru)) AND !empty($barang_name) AND !empty($barang_stok)) {
        $stmt = mysqli_prepare($connection, "INSERT INTO barang(barang_name, barang_merk, barang_jenis, barang_stok) VALUES(?,?,?,?) ");
        mysqli_stmt_bind_param($stmt, "sssi", $barang_name, $merk_baru_id, $jenis_baru_id, $barang_stok);
        mysqli_stmt_execute($stmt);
        if (!$stmt)
        {
            die('QUERY FAILED' . mysqli_error($connection));
        }
        
        mysqli_stmt_close($stmt);
        header("Location: barang.php");
    }
    elseif ($barang_name == "" || empty($barang_name) || $barang_stok == "" || empty($barang_stok))
    {
        echo "This Field should not be empty";
    }
    else
    {
        $stmt = mysqli_prepare($connection, "INSERT INTO barang(barang_name, barang_merk, barang_jenis, barang_stok) VALUES(?,?,?,?) ");
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

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
        <div class="col-md-2">
            <label for="title">Nama Barang :</label>
        </div>
    	<div class="col-md-10">
            <input type="text" class="form-group" id="barang_name" name="barang_name">    
        </div>
  	</div>
    <div class="form-group">
        <div class="form-group col-md-2">
            <label for="category">Merk :</label>    
        </div>
        <div class="form-group col-md-10">
            <input type="radio" class="pilih_merk_terdaftar" name="pilih_merk"> Merk Sudah Terdaftar <br>
            <input type="radio" class="pilih_merk_baru" name="pilih_merk" checked="true"> Merk Baru <br>
            
            <div class="tampil_merk_baru">
                <input type="text" name="merk_baru" id="merk_baru">
            </div>

            <div class="tampil_merk_terdaftar">
            <select class="form-group" name="barang_merk" id="barang_merk">
            <?php while ($row = mysqli_fetch_assoc($select_merk)): ?>
                <option value="<?php echo $row['merk_id']; ?>"><?php echo $row['merk_name']; ?></option>
            <?php endwhile; ?>
            </select>    
            </div>
        </div>
        
    </div>
    <div class="form-group">
        <div class="form-group col-md-2">
            <label for="category">Jenis :</label>    
        </div>
        <div class="form-group col-md-10">
            <input type="radio" class="pilih_jenis_terdaftar" name="pilih_jenis"> Jenis Sudah Terdaftar <br>
            <input type="radio" class="pilih_jenis_baru" name="pilih_jenis" checked="true"> Jenis Baru <br>
            <div class="tampil_jenis_baru">
                <input type="text" name="jenis_baru" id="jenis_baru">    
            </div>
            <div class="tampil_jenis_terdaftar">                
            <select class="form-group" name="barang_jenis" id="barang_jenis">
                <?php while ($row = mysqli_fetch_assoc($select_jenis)): ?>
                    <option value="<?php echo $row['jenis_id']; ?>"><?php echo $row['jenis_name']; ?></option>
                <?php endwhile; ?>
            </select>
            </div>
        </div>
        
            
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label for="author">Stok Awal :</label>    
        </div>
        <div class="col-md-10">
            <input type="text" class="form-group" id="barang_stok" name="barang_stok">    
        </div>
        
    </div>
    

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="submit" value="Add Barang">
	</div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('.tampil_merk_terdaftar').hide()
        $('.pilih_merk_baru').click(function() {
            $('.tampil_merk_baru').show();
            $('.tampil_merk_terdaftar').hide();
        });
        $('.pilih_merk_terdaftar').click(function() {
            $('.tampil_merk_baru').hide();
            $('.tampil_merk_terdaftar').show();
        });
    })
    $(document).ready(function() {
        $('.tampil_jenis_terdaftar').hide()
        $('.pilih_jenis_baru').click(function() {
            $('.tampil_jenis_baru').show();
            $('.tampil_jenis_terdaftar').hide();
        });
        $('.pilih_jenis_terdaftar').click(function() {
            $('.tampil_jenis_baru').hide();
            $('.tampil_jenis_terdaftar').show();
        });
    })

</script>