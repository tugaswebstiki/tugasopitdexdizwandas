<div>
	<h2>TAMBAH PELANGGAN</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" class="form-control" name="alamat">
	</div>

	<div class="form-group">
		<label>No Telp</label>
		<input type="text" class="form-control" name="notel">
	</div>

	
<hr>
	<button class="btn btn-success" name="ubah">Simpan</button>

</form>

		<?php 

		if (isset($_POST['ubah'])) {	


			$koneksi->query("	INSERT INTO pelanggan
								(nama_pelanggan,alamat_pelanggan,no_telp_pelanggan) 
								VALUES('$_POST[nama]','$_POST[alamat]','$_POST[notel]');
							");
			
			echo "<div class='alert-info alert'> Data Tersimpan </div>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=member'>";		
			}
			
		 ?>
		

</div>


