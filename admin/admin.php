<div>
	<div>
	<div><h2>ADMIN</h2><hr> 
		<?php 
			if ($_SESSION['sess_id']<3) {
		 ?>
		<a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahadmin">Tambah</a>
	<?php } ?>
	</div>
	<br>



		 <div style="height:400px;overflow-y: scroll; ">
		<?php 
			$ambil = $koneksi->query(
										"SELECT * 
										FROM admin "
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
	<div class="modal-dialog" role="document" style="width: 30%;"> 
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-header">
					<h2>DETAIL</h2>
				</div>
				<table><br>
					<tr>
						<td rowspan="3"><img  class="tampil_foto" id="" width="120px" height="160px" /></td>
						<td rowspan="3">&nbsp&nbsp&nbsp&nbsp&nbsp</td>
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
	<img src="../assets/img/profil/user.png" id="gambar_admin" width="120px" height="120px" alt="Preview Gambar" />
	<div class="form-group">
		<label>Gambar</label>
		<input type="file" class="form-control" name="foto_admin" id="preview_gambar_admin"/>
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



</div>