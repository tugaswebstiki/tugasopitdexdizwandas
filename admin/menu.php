<div>

	

	<div><h2>DAFTAR MENU</h2><hr>
		<a type="button" class="btn btn-success"  data-toggle="modal" data-target="#tambahmenu">Tambah</a>
	</div>
	<br>
<div style="height:360px;overflow-y: scroll; ">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>No</th>
				<th>Foto</th>
				<th>Nama</th>
				<th>Kategori</th>
				<th>Harga</th>
				<th>Status</th>
				<th class="lebar18">Aksi</th>
			</tr>
		</thead>
		<tbody>
			
			
			<?php   $no=1;
			$ambil = $koneksi->query(
				"SELECT * 
				FROM kategori_makanan 
				INNER JOIN(menu INNER JOIN status
				ON menu.id_status=status.id_status)
				ON menu.id_kategori=kategori_makanan.id_kategori"
			);
			?>
			<?php while($pecah = $ambil->fetch_assoc()){ 		?>

			
				<tr>
					<td><?php echo $no; ?></td>
					<td><img class="img-rounded" width="80px" height="80px" src="../assets/img/produk/<?php echo $pecah['fotomenu'] ?>" ></td>
					<td><?php echo $pecah['nama_menu']; ?></td>
					<td><?php echo $pecah['nama_kategori']; ?></td>
					<td><?php echo $pecah['harga_menu']; ?></td>
					<td><?php echo $pecah['status']; ?></td>
					<td>
						<a id="ubah" type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubahmenu" 
						 data-backdrop="static" data-keyboard="false"
						data-id="<?php echo $pecah['id_menu'];?>" 
						data-foto="<?php echo $pecah['fotomenu'] ?>" 
						data-nama="<?php echo $pecah['nama_menu']; ?>" 
						data-kategori="<?php echo $pecah['id_kategori']; ?> " 
						data-harga="<?php echo $pecah['harga_menu']; ?>" 
						data-status="<?php echo $pecah['id_status']; ?>">Ubah</a>
						<a id="hapus" type="button" class="btn btn-danger" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#hapusmenu" data-id="<?php echo $pecah['id_menu'];?>">Hapus</a>
					</td>
				</tr>

				<?php
				$no++;
			}
			?>
			
		</tbody>
		<script>
			$(function(){
				$(document).on('click','#hapus',function(e){
					e.preventDefault();
					var id = $(this).data('id');
					$('.idyangingindihapus').val(id);
			});
				
				$(document).on('click','#ubah',function(e){
					e.preventDefault();
					var id = $(this).data('id');
					var foto = $(this).data('foto');
					var nama = $(this).data('nama');
					var kategori = $(this).data('kategori');
					var harga = $(this).data('harga');
					var status = $(this).data('status');
					$('.idyangingindiubah').val(id);
					$('.ubah_foto').attr('src','../assets/img/produk/'+foto);
					$('.ubah_nama').val(nama);
					$('.ubah_kategori option[value='+kategori+']').attr('selected','selected');
					$('.ubah_harga').val(harga);
					$('.ubah_status option[value='+status+']').attr('selected','selected');
					
			});
				
});
		
	</script>
</table></div>

<!--   
===============================================TAMBAH MENU======================================================
-->

<div class="modal fade" id="tambahmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content">
		
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2>TAMBAH MENU</h2>
				</div>
				
			<div class="modal-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama">
					</div>

					<div class="form-group">
						<label>Kategori</label>
						<?php   $ambil = $koneksi->query(	"SELECT * 
							FROM kategori_makanan");
							?>
							<select class="form-control" name="kategori">

								<option>Pilih Kategori</option>

								<?php $kat=1;
								while($pecah = $ambil->fetch_assoc()){ 		?>

									<option value="<?php echo$kat; ?>"><?php echo $pecah['nama_kategori']; ?></option>

									<?php $kat++; } ?>

								</select>
							</div>

							<div class="form-group">
								<label>Harga</label>
								<input type="number" class="form-control" name="harga">
							</div>

							<img src="../assets/img/produk/default.png" id="gambar_nodin" width="120px" height="120px" alt="Preview Gambar" />

							<div class="form-group">
								<label>Gambar</label>
								<input type="file" class="form-control" name="foto_produk" id="preview_gambar" />
							</div>

							<script type="text/javascript">
								$("#preview_gambar").change(function(){

									bacaGambar(this);

								});
							</script>

							<hr>
							<button class="btn btn-success" name="save">Simpan</button>

							<?php 

							if (isset($_POST['save'])) 
							{	

								if ($_FILES['foto_produk']['size'] == 0)
								{
								    $koneksi->query("INSERT INTO menu
										(nama_menu,id_kategori,fotomenu,harga_menu,id_status) 
										VALUES('$_POST[nama]','$_POST[kategori]','default.png','$_POST[harga]',1)
										");
								}
								else{
									$nama_foto = $_FILES['foto_produk']['name'];
									$tempat_foto = $_FILES['foto_produk']['tmp_name'];
									move_uploaded_file($tempat_foto,"../assets/img/produk/".$nama_foto);


									$koneksi->query("	INSERT INTO menu
										(nama_menu,id_kategori,fotomenu,harga_menu,id_status) 
										VALUES('$_POST[nama]','$_POST[kategori]','$nama_foto','$_POST[harga]',1)
										");
									
								}


									?>

									
									<?php
									
									echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=menu'>";
								}

								?>


							</form>



						</div>	
					</div>	
				</div>
			</div>
<!--   
================================================TAMBAH MENU======================================================
-->

<!--   
================================================UBAH MENU======================================================
-->

<div class="modal fade" id="ubahmenu" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content">
			<div class="modal-body">



				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2>UBAH MENU</h2>
				</div>

				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" class="idyangingindiubah">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control ubah_nama" name="nama">
					</div>

					<div class="form-group">
						<label>Kategori</label>
						<?php   $ambil = $koneksi->query(	"SELECT * 
															FROM kategori_makanan");
							?>
							<select class="form-control ubah_kategori" name="kategoribaru">

									<option class=""></option>

								<?php $kat=1;
								while($pecah = $ambil->fetch_assoc()){ 		?>

									<option value="<?php echo$kat; ?>"><?php echo $pecah['nama_kategori']; ?></option>

									<?php $kat++; } ?>

								</select>
							</div>

							<div class="form-group">
								<label>Harga</label>
								<input type="number" class="form-control ubah_harga" name="harga">
							</div>
							<?php   $ambil = $koneksi->query(	"SELECT * 
															FROM menu");
							?>
							<img  class="ubah_foto" id="gambar_baru" width="120px" height="120px" alt="Preview Gambar" />

							<div class="form-group">
								<label>Gambar</label>
								<input type="file" class="form-control " name="foto_produk" id="preview_gambar_baru" />
							</div>

							<script type="text/javascript">
								$("#preview_gambar_baru").change(function(){

									bacaGambarbaru(this);

								});
							</script>
							<?php   $ambil = $koneksi->query(	"SELECT * 
															FROM status");
							?>
							<label>Status</label>
							<select class="form-control ubah_status" name="status">

									<option class=""></option>

								<?php $kat=1;
								while($pecah = $ambil->fetch_assoc()){ 		?>

									<option value="<?php echo$kat; ?>"><?php echo $pecah['status']; ?></option>

									<?php $kat++; } ?>

								</select>

							<hr>
							<button class="btn btn-success simpan_update" name="update">Simpan</button>
							</form>
							<?php 

							if (isset($_POST['update'])) 
							{	
								
								$id = $_POST['id'];
								$nama_foto = $_FILES['foto_produk']['name'];
								$tempat_foto = $_FILES['foto_produk']['tmp_name'];
								
								if (!empty($tempat_foto)) 
								{
								
										move_uploaded_file($tempat_foto,"../assets/img/produk/".$nama_foto);

										$koneksi->query("UPDATE menu
														SET nama_menu='$_POST[nama]',id_kategori='$_POST[kategoribaru]',harga_menu='$_POST[harga]',fotomenu='$nama_foto',id_status='$_POST[status]'
														WHERE id_menu='$id'
											");

								}

								else {
										$koneksi->query("UPDATE menu
														SET nama_menu='$_POST[nama]',id_kategori='$_POST[kategoribaru]',harga_menu='$_POST[harga]',id_status='$_POST[status]'
														WHERE id_menu='$id'
										");
									}
								echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=menu'>";		
							}

								?>


							



						</div>	
					</div>	
				</div>
			</div>


<!--   
================================================UBAH MENU======================================================
-->
<!--   
================================================HAPUS MENU======================================================
-->

<div class="modal fade" id="hapusmenu" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">

					<input type="hidden" name="id" class="idyangingindihapus">
					<h4 align="center"><b>Yakin ingin dihapus ?</b></h4><hr>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-danger col-md-3 delete_aja_gpp" name="ya" >YA</button>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-success col-md-3 hapusmenu_close" name="tidak">TIDAK</button>
					<div class="col-md-2"></div>
					<hr><br>
				<?php 
				if (isset($_GET['delete'])) 
					{		
						$id = $_GET['delete'];
						$ambil= $koneksi->query("SELECT * FROM menu WHERE id_menu='$id'");
						$pecah= $ambil->fetch_assoc();
						$foto_menu=$pecah['fotomenu'];

						if (file_exists("../assets/img/produk/$foto_menu")) {
							unlink("../assets/img/produk/$foto_menu");
						}


						$koneksi->query("DELETE FROM menu WHERE id_menu='$id'");


						
						echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=menu'>";

						
					}
				 ?>

			</div>
		</div>
	</div>
</div>


<!--   
================================================HAPUS MENU======================================================
-->

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.hapusmenu_close').click(function(){
			$('#hapusmenu').modal('toggle');
		});
		$('.delete_aja_gpp').click(function(){
			var url = "index.php?halaman=menu";
			var id = $('.idyangingindihapus').val();
			window.location.href= url+'&delete='+id;
		});
	});

</script>