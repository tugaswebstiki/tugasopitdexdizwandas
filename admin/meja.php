<div>
<?php   date_default_timezone_set('Asia/Kuala_Lumpur');
	$waktu_pesan = date('Y-m-d H:i:s', time());
?>
	<div><h2>MEJA</h2><hr></div>
	<div class="lebar80">
		<a href="#tambahmeja" data-toggle="modal" class="btn btn-success">Tambah</a> 
		<a href="#hapusmeja" data-toggle="modal" class="btn btn-danger floatright">Hapus</a> 
		
	</div>

	<br>

	

<div style="height:400px;overflow-y: scroll; ">
	<div class="col-md-12">

<?php   
					$ambil = $koneksi->query("SELECT * FROM meja ORDER BY nama_meja ASC");
				?>
		 


					<?php 

					while($pecah = $ambil->fetch_assoc()){ 	
					if ($pecah['id_status']==1) {
					?>
						<form method="post">
							<div class="lebar128">
								<a href="index.php?halaman=pesan&nama_meja=<?php echo $pecah['id_meja'] ?>" 
									data-id="<?php echo $pecah['id_meja'];?>" class="noeffect button_noeffect" id="cek_meja">
									<div class="thumbnail fotomeja mejapenuh" style="border: 0px !important;">	
										<div class="nomeja">
										<?php 
											echo " $pecah[nama_meja] ";
										 ?>
										</div>
									</div>
								</a>
							</div>	
						</form>				
										<?php }
											else{
										?>

						<form method="post">
							<div class="lebar128">
							<input type="hidden" name="id_meja" value="<?php echo $pecah['id_meja'];?>">
							<input type="hidden" id="id_meja" value="<?php echo $pecah['id_meja'];?>">
							<input type="hidden" name="id_admin" value="<?php echo $_SESSION['sess_id'];?>">
							<input type="hidden" name="id_pelanggan" value="1">
							<input type="hidden" name="waktu_pesanan" value="<?php echo $waktu_pesan;?>">
								<button class="noeffect button_noeffect" name="pesan">
									<div class="thumbnail fotomeja" style="border: 0px !important;">	
										<div class="nomeja">
											<?php 
												echo " $pecah[nama_meja] ";
											 ?>
										</div>
									</div>
								</button>
							</div>
						</form>						
										<?php
											}
										 } ?>
	</div>
</div>
	<?php 
	if (isset($_POST['pesan'])){
					$koneksi->query("INSERT INTO pesanan
									(id_admin,id_pelanggan,id_meja,waktu_pemesanan,id_status) 
									VALUES('$_POST[id_admin]',1,'$_POST[id_meja]','$_POST[waktu_pesanan]',1)
										");
					$koneksi->query("UPDATE meja
									SET id_status = 1
									WHERE id_meja ='$_POST[id_meja]'
										");
					echo "<meta http-equiv='refresh' content='0;url=index.php?halaman=pesan&nama_meja=$_POST[id_meja]'>";	
	
								}
	
								?>
										

				<script type="text/javascript">
					$(document).on('click','#cek_meja',function(e){
					e.preventDefault();
					var id = $(this).data('id');
					window.location.href="index.php?halaman=pesan&nama_meja="+id; });
				</script>
										
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

				<form method="post" enctype="multipart/form-data" autocomplete="off">
	<div class="form-group">
		<label>No Meja</label>
		<input type="text" class="form-control" name="nama">
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
								{	icon : "warning",
									className : "sweetalertmn",
									button: false,
									timer: 1000
								});
							</script><?php
							echo "<meta http-equiv='refresh' content='1;url=index.php'>";
				}
			else{

			$koneksi->query("	INSERT INTO meja
								(nama_meja,id_status) 
								VALUES('$_POST[nama]',2);
							");
							?><script type="text/javascript">
								swal({
										className : "sweetalertmn",
  										icon: "success",
  										button: false,
  										timer: 1000
									});
							</script><?php	
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

				<form method="post" enctype="multipart/form-data" autocomplete="off">
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
								{ icon :"warning",
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
