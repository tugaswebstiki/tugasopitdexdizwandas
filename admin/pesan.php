<div class="container">
<div class="container judul"><h2>PESAN</h2></div>

<?php
	$idadm = "test id";
?>

<form >

<div class="container">		

		<div class="col-md-2 ubah">
			<div class="form-group">
				<label for="nama">Nama Pemesan:</label>
				<input type="text" class="form-control" id="nama">
			</div>
		</div>
		<div class="col-md-2 ubah2">
			<div class="form-group">
				<label for="alamat">Alamat Pemesan:</label>
				<input type="text" class="form-control" id="alamat">
			</div>	
		</div>
		<div class="col-md-2 ubah3">
			<div class="form-group">
				<button type="submit" class="btn btn-primary form-control " name="cari">Cari</button>
			</div>	
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="alamat">Id Admin:</label>
				<div class="form-control" id="idadm"><?php echo $idadm ;?></div>
			</div>	
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="alamat">No Meja</label>
				<?php   
					$ambil = $koneksi->query("SELECT * FROM meja ORDER BY nama_meja ASC");
				?>
		 

				<select class="form-control" name="kategori">

					<option>Pilih Meja</option>

					<?php $kat=1;

					while($pecah = $ambil->fetch_assoc()){ 	
						if ($pecah['id_status']==2) {
							


						?>

					<option value="<?php echo$kat; ?>">   <?php echo('Meja no.'); echo$pecah['nama_meja']; ?>   </option>

					<?php }$kat++; } ?>

		
                </select>
			</div>	
		</div>

		
</div>

	<button type="submit" class="btn btn-primary">Simpan</button>


	

	

</form>






<a type="button" class="btn btn-success" data-toggle="modal" data-target="#carimenu">Cari Menu</a>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Foto</th>
			<th>Nama Menu</th>
			<th>Harga Jual</th>
			<th>Jumlah Beli</th>
			<th>Kalkulasi</th>
			<th class="lebar18">Aksi</th>
		</tr>
	</thead>
	<tbody>

		

	</tbody>
</table>



<div class="modal fade" id="carimenu" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content">
			<div class="modal-body">
	
	<div class="modal-header">
		<h2>CARI DAFTAR MENU</h2>
	</div>

	<div class="col-lg-12" >
	<div class="row">
	<?php   
					$ambil = $koneksi->query("SELECT * FROM menu WHERE id_status = '1'");
				?>
		 

					<?php $kat=1;

					while($pecah = $ambil->fetch_assoc()){ 	
						// if ($pecah['id_status']==2) {
							


						?>
		<!-- post -->
		<a href="#" title="">
			<div class="col-md-3">
			<div class="row ">
			  <div class="col-sm-12 col-md-12 produk">
			    <div class="thumbnail">
			      <img src="ICON/<?= $data['fotomenu']; ?>" alt="..." style="width:100%">
			      <!-- <div class="caption">
			        <h4><b><?= $data['br_nm']; ?></b></h4>
			        <p><?= $data['br_hrg']; ?></p>
			     
			      </div> -->
			    </div>
			  </div>
			</div>
			</div>
		</a>
		<?php }$kat++;  ?>

	</div>
</div>

	<!-- <form method="post" enctype="multipart/form-data">
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
	<div class="form-group">
		<label>Gambar</label>
		<input type="file" class="form-control" name="foto_produk" />
	</div>

<hr>
	<button class="btn btn-success" name="save">Simpan</button>

	<?php 

		if (isset($_POST['save'])) 
		{	

							$nama_foto = $_FILES['foto_produk']['name'];
							$tempat_foto = $_FILES['foto_produk']['tmp_name'];
							move_uploaded_file($tempat_foto,"../assets/img/produk/".$nama_foto);


			$koneksi->query("	INSERT INTO menu
								(nama_menu,id_kategori,fotomenu,harga_menu,id_status) 
								VALUES('$_POST[nama]','$_POST[kategori]','$nama_foto','$_POST[harga]',1)
							");
			
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=menu'>";?>
		
			<script type="text/javascript"> alert('Menu baru berhasil di simpan'); </script>
			<?php
		}

		 ?>


</form> -->

		
	
			</div>	
		</div>	
	</div>
</div>
<!--   
================================================TAMBAH MENU======================================================
  -->








</div>