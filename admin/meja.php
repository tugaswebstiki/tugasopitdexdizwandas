<div>

	<div><h2>DAFTAR MEJA</h2><hr></div>
	<div class="lebar80">
		<a href="#tambahmeja" data-toggle="modal" class="btn btn-success">Tambah</a> 
		<a href="#hapusmeja" data-toggle="modal" class="btn btn-danger floatright">Hapus</a> 
		
	</div>

	<br>

	



<?php   
					$ambil = $koneksi->query("SELECT * FROM meja ORDER BY nama_meja ASC");
				?>
		 


					<?php 

					while($pecah = $ambil->fetch_assoc()){ 	
					if ($pecah['id_status']==1) {
					?>

				
							<div class="col-md-2">
								<a class="noeffect" href="index.php?halaman=pesan&id=<?php echo $pecah['id_meja']; ?>">
								<div class="thumbnail fotomeja mejapenuh" style="border: 0px !important;">	
									<div class="nomeja">
									<?php 
										echo " $pecah[nama_meja] ";
									 ?>
									</div>
								</div>
								</a>
							</div>					

										<?php }
											else{
										?>


							<div class="col-md-2">
								<a class="noeffect" href="index.php?halaman=pesan&id=<?php echo $pecah['id_meja']; ?>">
								<div class="thumbnail fotomeja" style="border: 0px !important;">	
									<div class="nomeja">
									<?php 
										echo " $pecah[nama_meja] ";
									 ?>
									</div>
								</div>
							</a>
							</div>	
															
										<?php
											}
										?>
								
					<?php } ?>

	<!--   
===============================================TAMBAH MEJA======================================================
-->

<div class="modal fade" id="tambahmeja" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">



				<div class="modal-header">
					<h2>TAMBAH MEJA</h2>
				</div>

				<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>No Meja</label>
		<input type="text" class="form-control" name="nama">
	</div>
	
	<div class="form-group">
		<label>Jumlah Kursi</label>
		<input type="text" class="form-control" name="jk">
	</div>
<hr>
	<button class="btn btn-success" name="save">Simpan</button>

</form>

		<?php 

		if (isset($_POST['save'])) {

			$name_check = 	mysqli_num_rows(
							mysqli_query($koneksi,
							"SELECT * FROM meja WHERE nama_meja ='$_POST[nama]' "));

			if ($name_check>0) {
							?><script type="text/javascript">
								swal("Sudah ada", 
								{
									className : "sweetalertmn",
									button: false,
									timer: 1000
								});
							</script><?php
							echo "<meta http-equiv='refresh' content='1;url=index.php'>";
				}
			else{

			$koneksi->query("	INSERT INTO meja
								(nama_meja,jumlah_kursi,id_status) 
								VALUES('$_POST[nama]','$_POST[jk]',2);
							");
			
			echo "<div class='alert-info alert'> Data Tersimpan </div>";
			echo "<meta http-equiv='refresh' content='1;url=index.php'>";	

				}
			}
			
		 ?>



						</div>	
					</div>	
				</div>
			</div>
<!--   
================================================TAMBAH MEMBER======================================================
-->
</div>
	<!--   
===============================================HAPUS MEJA======================================================
-->

<div class="modal fade" id="hapusmeja" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">



				<div class="modal-header">
					<h2>HAPUS MEJA</h2>
				</div>

				<form method="post" enctype="multipart/form-data">
	<div class="form-group">
						<label>Meja yang ingin dihapus</label>
						<?php   $ambil = $koneksi->query(	"SELECT * 
							FROM meja ORDER BY nama_meja ASC");
							?>
							<select class="form-control" name="kategori">

								<option>Pilih Meja</option>

								<?php
								while($pecah = $ambil->fetch_assoc()){ 		?>
							
									<option value="<?php echo $pecah['id_meja']; ?>">
									
										<?php echo $pecah['nama_meja']; ?></option>

									<?php  } ?>


								</select>
							</div>
	
	
<hr>
	<button class="btn btn-success" name="delete">Hapus</button>

</form>

		<?php 

		if (isset($_POST['delete'])) {

			$cari = $koneksi->query("SELECT * FROM meja WHERE id_meja='$_POST[kategori]'");
			$bagi = $cari->fetch_assoc();
			$hmmm = $bagi['id_status'];

			if ($hmmm==1) {
							?>
							
							<script type="text/javascript">
								swal("Meja Sedang ada Pelanggan", 
								{
								  button: false,
								});
							</script>

							<?php
							echo "<meta http-equiv='refresh' content='1;url=index.php'>";
			}
			else{	
							$koneksi->query("DELETE FROM meja WHERE id_meja='$_POST[kategori]'");
									

									echo "<div class='alert-info alert'> Data Tersimpan </div>";
									echo "<meta http-equiv='refresh' content='1;url=index.php'>";
			}

			}
		 ?>



						</div>	
					</div>	
				</div>
			</div>
<!--   
================================================HAPUS MEMBER======================================================
-->
</div>

