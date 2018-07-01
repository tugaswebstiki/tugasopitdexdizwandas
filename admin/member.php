<div>

	<div><h2>DAFTAR PELANGGAN</h2><hr> 
		<a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahpelanggan">Tambah</a> 
	</div>
	<br>
<div style="height:400px;overflow-y: scroll; ">
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
			<td><?php
					if ("$pecah[id_pelanggan]"==1) {
						
					}
					else{

					?>


				<a id="ubah" type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubahpelanggan" 
						data-id="<?php echo $pecah['id_pelanggan'];?>" 
						data-nama="<?php echo $pecah['nama_pelanggan']; ?>"  
						data-alamat="<?php echo $pecah['alamat_pelanggan']; ?>" 
						data-notel="<?php echo $pecah['no_telp_pelanggan']; ?>">Ubah</a>
						<a id="hapus" type="button" class="btn btn-danger" data-toggle="modal"  data-target="#hapuspelanggan" data-id="<?php echo $pecah['id_pelanggan'];?>">Hapus</a>
					<?php
				}
					?>
			</td>
		</tr>

		<?php
			$no++;
			}
		?>

	</tbody>
</table></div>
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
					var nama = $(this).data('nama');
					var alamat = $(this).data('alamat');
					var notel = $(this).data('notel');
					$('.idyangingindiubah').val(id);
					$('.ubah_nama').val(nama);
					$('.ubah_alamat').val(alamat);
					$('.ubah_notel').val(notel);
					
			});
				
});
		
	</script>



	<!--   
===============================================TAMBAH MEMBER======================================================
-->

<div class="modal fade" id="tambahpelanggan" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document"> 
		<div class="modal-content">
			<div class="modal-body">



				<div class="modal-header">
					<h2>TAMBAH PELANGGAN</h2>
				</div>

				<form method="post" enctype="multipart/form-data" autocomplete="off">
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
	<button class="btn btn-success" name="save">Simpan</button>

</form>

		<?php 

		if (isset($_POST['save'])) {	


			$koneksi->query("	INSERT INTO pelanggan
								(nama_pelanggan,alamat_pelanggan,no_telp_pelanggan) 
								VALUES('$_POST[nama]','$_POST[alamat]','$_POST[notel]');
							");
			
										?><script type="text/javascript">
											swal({
													className : "sweetalertmn",
			  										icon: "success",
			  										button: false,
			  										timer: 1000
												});
										</script><?php	
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=member'>";		
			}
			
		 ?>



						</div>	
					</div>	
				</div>
			</div>
<!--   
================================================TAMBAH MEMBER======================================================
-->

<!--   
================================================UBAH MEMBER======================================================
-->

<div class="modal fade" id="ubahpelanggan" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content">
			<div class="modal-body">


				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2>UBAH PELANGGAN</h2>
				</div>

				<form method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="id" class="idyangingindiubah">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control ubah_nama" name="nama">
	</div>
	
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" class="form-control ubah_alamat" name="alamat">
	</div>

	<div class="form-group">
		<label>No Telp</label>
		<input type="text" class="form-control ubah_notel" name="notel">
	</div>

	
<hr>
	<button class="btn btn-success" name="ubah">Simpan</button>

</form>

		<?php 

		if (isset($_POST['ubah'])) {	

			$id = $_POST['id'];
			$koneksi->query("	UPDATE pelanggan
								SET nama_pelanggan='$_POST[nama]',alamat_pelanggan='$_POST[alamat]',no_telp_pelanggan='$_POST[notel]'
								WHERE id_pelanggan='$id'
							");
										?><script type="text/javascript">
											swal({
													className : "sweetalertmn",
			  										icon: "success",
			  										button: false,
			  										timer: 1000
												});
										</script><?php	
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=member'>";		
			}
			
		 ?>

							



						</div>	
					</div>	
				</div>
			</div>


<!--   
================================================UBAH MEMBER======================================================
-->
<!--   
================================================HAPUS MEMBER======================================================
-->

<div class="modal fade" id="hapuspelanggan" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">
					<input type="hidden" name="id" class="idyangingindihapus">
					<h4 align="center"><b>Yakin ingin dihapus ?</b></h4><hr>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-danger col-md-3 delete_aja_gpp" name="ya" >YA</button>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-success col-md-3 hapusmenu_close"  data-dismiss="modal" name="tidak">TIDAK</button>
					<div class="col-md-2"></div>
					<hr><br>
				<?php 
				if (isset($_GET['delete'])) 
					{		
						$id = $_GET['delete'];

						$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id'");

						echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=member'>";

						
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

<script type="text/javascript">
	$(document).ready(function(){
		$('.hapusmenu_close').click(function(){
			$('#hapuspelanggan').modal('toggle');
		});
		$('.delete_aja_gpp').click(function(){
			var url = "index.php?halaman=member";
			var id = $('.idyangingindihapus').val();
			window.location.href= url+'&delete='+id;
		});
	});

</script>
</div>