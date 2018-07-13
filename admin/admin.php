<div>
	<div>
	<div><h2>ADMIN</h2><hr> 
		<?php 
			if ($_SESSION['sess_jbt']==1) {
		 ?>
		<a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahadmin">Tambah</a>
		<a type="button" class="btn btn-danger floatright" data-toggle="modal" data-target="#hapusadmin">Hapus</a>
	<?php } ?>
	</div>
	<br>



		 <div style="height:400px;overflow-y: scroll;" class="col-md-12">
		<?php 
			$ambil = $koneksi->query(
										"SELECT * 
										FROM admin INNER JOIN jabatan
										ON admin.id_jabatan=jabatan.id_jabatan"
									);
										
			while($pecah = $ambil->fetch_assoc()){ 		?>
		 	
			<div class="col-md-3">
			<table class="table">
				<tr align="center">
					<td ><img class="img-rounded"  width="120px" height="160px" src="../assets/img/profil/<?php echo $pecah['foto_admin'] ?>" ></td>
				</tr>
				<tr>
					<td align="center"><a id="tampildetail" data-toggle="modal" data-target="#detail" 
						data-foto="<?php echo $pecah['foto_admin'] ?>"
						data-nama=	"Nama&nbsp : <?php echo $pecah['nama_admin']; ?>"
						data-alamat="Asal&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $pecah['alamat']; ?>"
						data-notel=	"No.telp&nbsp: <?php echo $pecah['no_telp_admin']; ?>"
						style="width: 90%;" class="btn btn-default">
						<?php  echo $pecah['nama_admin']; ?></a></td>
				</tr>
				
			</table>
			</div>
			
		<?php
			
			}
		?>
	</div>

	</div>
<script type="text/javascript">
	$(function(){
				$(document).on('click','#tampildetail',function(e){
					e.preventDefault();
					var foto = $(this).data('foto');
					$('.tampil_foto').attr('src','../assets/img/profil/'+foto);
					var nama = $(this).data('nama');
					$('.namayanginginditampilkan').val(nama);
					var alamat = $(this).data('alamat');
					$('.alamatyanginginditampilkan').val(alamat);
					var notel = $(this).data('notel');
					$('.notelyanginginditampilkan').val(notel);
					});
			});

</script>
	

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document"> 
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-header">
					<h2>DETAIL</h2>
				</div>
				<table><br>
					<tr>
						<td rowspan="4"><img  class="tampil_foto" id="" width="120px" height="160px" /></td>
						<td rowspan="4">&nbsp&nbsp&nbsp&nbsp&nbsp</td>
						<td><input  readonly class="detail namayanginginditampilkan" type="text"></td>
					</tr>
					<tr>
						<td><input  readonly class="detail alamatyanginginditampilkan" type="text"></td>
					</tr>
					<tr>
						<td><input  readonly class="detail notelyanginginditampilkan" type="text"></td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>
</div>

<!--   
===============================================TAMBAH ADMIN======================================================
-->

<div class="modal fade" id="tambahadmin" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content">
			<div class="modal-body">



				<div class="modal-header">
					<h2>TAMBAH ADMIN</h2>
				</div>

				<form method="post" enctype="multipart/form-data" autocomplete="off">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" required="">
	</div>
	<div class="form-group">
						<label>Jabatan</label>
						<?php   $ambil = $koneksi->query(	"SELECT * 
							FROM jabatan");
							?>
							<select class="form-control" name="jabatan" required="">

								<option>Pilih Jabatan</option>

								<?php 
								while($pecah = $ambil->fetch_assoc()){ 		?>

									<option value="<?php echo $pecah['id_jabatan']; ?>"><?php echo $pecah['nama_jabatan']; ?></option>

									<?php  } ?>

								</select>
							</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" required="">
	</div>
	
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="pass1" required="">
	</div>

	<div class="form-group">
		<label>Masukkan Pasword sekali lagi</label>
		<input type="password" class="form-control" name="pass2" required="">
	</div>
	
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" class="form-control" name="alamat" required="">
	</div>

	<div class="form-group">
		<label>No Telp</label>
		<input type="text" class="form-control" name="notel" required="">
	</div>
	<img src="../assets/img/profil/user.png" id="gambar_admin" width="120px" height="120px" alt="Preview Gambar" />
	<div class="form-group">
		<label>Gambar</label>
		<input type="file" class="form-control" name="foto_admin" id="preview_gambar_admin" required=""/>
		<script type="text/javascript">
								$("#preview_gambar_admin").change(function(){

									bacaGambaradmin(this);

								});
							</script>
	</div>
	
<hr>
	<button class="btn btn-success" name="save">Simpan</button>

</form>

		<?php 

		if (isset($_POST['save'])) {	

			if ("$_POST[nama]"==""||"$_POST[username]"==""||"$_POST[pass1]"==""||"$_POST[pass2]"==""||"$_POST[alamat]"==""||"$_POST[notel]"=="") {
			
										?><script type="text/javascript">
											swal("Data harus lengkap",
												{
													className : "sweetalertmn",
			  										icon: "error",
			  										button: false,
			  										timer: 1000
												});
										</script><?php	
										echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=admin'>";
			
			}
			else{



						if ("$_POST[pass1]"=="$_POST[pass2]") {

							if ($_FILES['foto_admin']['size'] == 0){

								$koneksi->query("	INSERT INTO admin
											(nama_admin,username,password,alamat,no_telp_admin,foto_admin) 
											VALUES('$_POST[nama]','$_POST[username]','$_POST[pass1]','$_POST[alamat]','$_POST[notel]','user.png');
										");
						echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=admin'>";	
							}
							

							else{


							$nama_foto = $_FILES['foto_admin']['name'];
							$tempat_foto = $_FILES['foto_admin']['tmp_name'];
							move_uploaded_file($tempat_foto,"../assets/img/profil/".$nama_foto);


						$koneksi->query("	INSERT INTO admin
											(nama_admin,username,password,alamat,no_telp_admin,foto_admin) 
											VALUES('$_POST[nama]','$_POST[username]','$_POST[pass1]','$_POST[alamat]','$_POST[notel]','$nama_foto');
										");
						echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=admin'>";		
								}

										?><script type="text/javascript">
											swal({
													className : "sweetalertmn",
			  										icon: "success",
			  										button: false,
			  										timer: 1000
												});
										</script><?php	

							}
						else{
										?><script type="text/javascript">
											swal("Password Salah",
												{
													className : "sweetalertmn",
			  										icon: "error",
			  										button: false,
			  										timer: 1000
												});
										</script><?php
										echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=admin'>";
						}

				}
			
		}

		 ?>



						</div>	
					</div>	
				</div>
			</div>
<!--   
================================================TAMBAH ADMIN======================================================
-->

<!--   
===============================================HAPUS ADMIN======================================================
-->

<div class="modal fade" id="hapusadmin" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">



				<div class="modal-header">
					<h2>HAPUS ADMIN</h2>
				</div>

				<form method="post" enctype="multipart/form-data" autocomplete="off">
	<div class="form-group">
						<?php   $ambil = $koneksi->query(	"SELECT * 
							FROM admin ORDER BY id_admin ASC");
							?>
							
							<select class="form-control" name="korbanadmin">

								<option>Pilih Admin</option>

								<?php
								while($pecah = $ambil->fetch_assoc()){ 		


									if ($pecah['id_jabatan']!=1) {
									?>
							
									<option value="<?php echo $pecah['id_admin']; ?>">
									
										<?php echo $pecah['nama_admin']; ?></option>

									<?php  }
										} ?>

								</select>
							</div>
								

	
	
<hr>
	<button class="btn btn-success" name="delete">Hapus</button>

</form>

		<?php 

		if (isset($_POST['delete'])) {

							$koneksi->query("DELETE FROM admin WHERE id_admin='$_POST[korbanadmin]'");				

									echo "<meta http-equiv='refresh' content='0;url=index.php?halaman=admin'>";
			

			}
		 ?>



						</div>	
					</div>	
				</div>
			</div>
<!--   
================================================HAPUS ADMIN======================================================
-->

</div>