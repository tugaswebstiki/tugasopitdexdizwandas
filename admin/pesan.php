<div class="col-md-12">
<div class="container judul col-md-12"><h2>PESAN</h2></div>


<form >

<div >		

		<div class="col-md-4">
			<div class="form-group">
				<label for="nama">Nama Pemesan:</label>
				<div>
					<a type="button" class="btn btn-default lebar100" data-toggle="modal" data-target="#carimember" >
						<?php 
							echo "REGULER";
						 ?>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="alamat">Admin:</label>
				<div class="form-control" ><?php echo $_SESSION['sess_nama'];?></div>
			</div>	
		</div>
		<div class="col-md-2">
			<div class="form-group">


				<?php   
					$id_meja=$_GET['id'];
				?>
		 
				<label>No Meja:</label>
				<div class="form-control" id="no_meja"><?php echo "Meja ";echo $id_meja;?></div>
			</div>	
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label>&nbsp</label>
				<a type="" class="btn btn-primary form-control ">Simpan</a>
			</div>	
		</div>
		
</div>

	


	

	

</form>




<div>
	<div class="col-md-8 paddingbutton">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#carimenu">Tambah</button>
	</div>
	<div class="col-md-2 paddingbutton">
	<button type="button" class="btn lebar100" data-toggle="modal" data-target="#">Cetak Nota</button>
	</div>
	<div class="col-md-2 paddingbutton">
	<button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#">Selesai</button>
	</div>
</div>

<div class="col-md-12">
	<div class="table table-bordered" style="height:360px;overflow-y: scroll; background-color: #F3F3F3">
	<table class="table table-bordered table-hover ">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Qty</th>
			<th>Jumlah</th>
			<th class="lebar18">Aksi</th>
		</tr>
	</thead>
	<tbody>

		

	</tbody>
</table>
</div>
</div>
</div>








<div id="carimember" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pilih Menu</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">

					<div class="container col-md-12">
						<form method="POST">Cari :</label>
							<input type="text" name="cari" class=" ubahcari ">
							<input type="submit" class="btn btn-primary " value="Cari">
						</form>
					</div>

					<?php 
					if(isset($_GET['cari'])){
						$cari = $_GET['cari'];

						$ambil = $koneksi->query("SELECT * FROM pelanggan where nama_pelanggan like '%".$cari."%', alamat_pelanggan like '%".$cari."%' ");				
					}else{
						$ambil = $koneksi->query("SELECT * FROM pelanggan ");		
					}
					?>


					<div class="cotainer">
						<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>No Telepon</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>

							 
							<?php   $no=1;
								$ambil = $koneksi->query(
															"SELECT * 
															FROM pelanggan "
														);
															?>
							<?php while($pecah = $ambil->fetch_assoc()){ 		?>
							 

							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $pecah['nama_pelanggan']; ?></td>
								<td><?php echo $pecah['alamat_pelanggan']; ?></td>
								<td><?php echo $pecah['no_telp_pelanggan']; ?></td>
								<td><a id="pilih" type="button" class="btn btn-success" data-id="<?php echo $pecah['id_pelanggan'];?>">Pilih</a></td>
							</tr>

							<?php
								$no++;
								}
							?>

						</tbody>
					</table>
					</div>
					
				</div>
			</div>
		</div>
	</div>







<div id="carimenu" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pilih Menu</h4>
				</div>
				<!-- body modal -->
				<div class="">
					<?php   
						$ambil = $koneksi->query("SELECT * FROM menu WHERE id_status = '1'");
					?>
					 

					<?php $kat=1;

						while($pecah = $ambil->fetch_assoc()){ 	
					?>
						<!-- post -->
						<a data-toggle="modal" data-target="#pilihmenu" style="cursor: pointer;">
							<div class="col-md-3">
							
							  
							    <div class="thumbnail">
							      <img src="../assets/img/produk/<?php echo $pecah['fotomenu'] ?>" alt="..." style="width:100%">
							      <div class="caption">
							      
							     
							   
							    
							  		</div>
								</div>
							</div>
						</a>
					<?php }$kat++;  ?>

				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					
					<button type="button" class="btn btn-success" data-dismiss="modal" name="okmenu">OK</button>
				</div>
			</div>
		</div>
	</div>








	<div id="pilihmenu" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Bagian heading modal</h4>
				</div>
				<!-- body modal -->
				<div class="">
					<form method="POST">
						<div class="form-group">
							<label>Jumlah</label>
							<input type="text" class="form-control" name="jumlahmenu">
						</div>
					</form>

				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal" name="okmenu">OK</button>

				</div>
			</div>
		</div>
	</div>





</div>