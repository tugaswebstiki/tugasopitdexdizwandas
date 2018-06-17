<div>
	<h2>TAMBAH ADMIN</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	
		<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username">
	</div>
	
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="pass1">
	</div>

	<div class="form-group">
		<label>Masukkan Pasword sekali lagi</label>
		<input type="password" class="form-control" name="pass2">
	</div>
	
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" class="form-control" name="alamat">
	</div>

	<div class="form-group">
		<label>No Telp</label>
		<input type="text" class="form-control" name="notel">
	</div>
	<div class="form-group">
		<label>Gambar</label>
		<input type="file" class="form-control" name="foto_admin" />
	</div>
	
<hr>
	<button class="btn btn-success" name="save">Simpan</button>

</form>

		<?php 

		if (isset($_POST['save'])) {	

			if ("$_POST[nama]"==""&&"$_POST[username]"==""&&"$_POST[pass1]"==""&&"$_POST[pass2]"==""&&"$_POST[alamat]"==""&&"$_POST[notel]"=="") {
			
			echo "<div class='alert-danger alert'> Semua Data Harus Isi ! </div>";	
			
			}
			else{



						if ("$_POST[pass1]"=="$_POST[pass2]") {

							$nama_foto = $_FILES['foto_admin']['name'];
							$tempat_foto = $_FILES['foto_admin']['tmp_name'];
							move_uploaded_file($tempat_foto,"../assets/img/profil/".$nama_foto);


						$koneksi->query("	INSERT INTO admin
											(nama_admin,username,password,alamat,no_telp_admin,foto_admin) 
											VALUES('$_POST[nama]','$_POST[username]','$_POST[pass1]','$_POST[alamat]','$_POST[notel]','$nama_foto');
										");
						
						echo "<div class='alert-info alert'> Data Tersimpan </div>";
						echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=admin'>";		
						}
						else{
						echo "<div class='alert-danger alert'> Password Salah </div>";
						}

				}
			
		}

		 ?>
		

</div>


