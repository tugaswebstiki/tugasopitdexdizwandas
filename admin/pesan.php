<div class="col-md-12">
<div class="container judul col-md-12"><h2>PESAN</h2></div>
<?php 
$meja_yang_dieksekusi = $_GET['nama_meja'];

$ambil = $koneksi->query("SELECT * 
						FROM admin 
						INNER JOIN(pelanggan 
						INNER JOIN(pesanan INNER JOIN meja
						ON pesanan.id_meja=meja.id_meja)
						ON pesanan.id_pelanggan=pelanggan.id_pelanggan)
						ON pesanan.id_admin=admin.id_admin
						WHERE pesanan.id_meja = $meja_yang_dieksekusi AND pesanan.id_status = 1
						");
$pecah = $ambil->fetch_assoc();
$id_pesanan_sekarang=$pecah['id_pesanan'];
?>
<form >

<div >		

		<div class="col-md-4">
			<div class="form-group">
				<label for="nama">Nama Pemesan:</label>
				<div>
					<a type="button" class="btn btn-default lebar100" data-toggle="modal" data-target="#carimember" >
						<?php 
							echo $pecah['nama_pelanggan'];
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

		 
				<label>No Meja:</label>
				<div class="form-control" id="no_meja"><?php echo "Meja ";echo $pecah['nama_meja'];?></div>
			</div>	
		</div>
		<div class="col-md-2">
			<label>&nbsp</label>
			<button type="button"
				id="selesai"
				data-pesanan="<?php echo $id_pesanan_sekarang;?>"
				data-meja="<?php echo $pecah['id_meja'];?>"
				class="btn btn-warning form-control" data-toggle="modal" data-target="#selesaipesan">Selesai</button>
		</div>
		
</div>

	
	

	

	 

</form>




<div>
	<div class="col-md-8 paddingbutton">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahmenu"><i class="fa fa-plus"></i>&nbsp&nbspTambah</button>
	</div>
					<form action="nota.php" method="POST" target="_blank">
					<div class="col-md-2 paddingbutton">
					<input type="hidden" name="id_pesanan" value="<?php echo$id_pesanan_sekarang ?>">
					<input type="submit" name="kirim" class="btn lebar100" value="Cetak Nota">
					</div></form>
	<div class="col-md-2 paddingbutton">
	<a id="batal" 
			data-meja="<?php echo $pecah['id_meja'];?>" 
			type="button" 
			class="btn btn-danger lebar100" 
			data-toggle="modal" 
			data-target="#batalpesan">Batal</a>
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
			
		


<?php   
        $no=1;
        $ambil = $koneksi->query("	SELECT * 
									FROM menu 
									INNER JOIN(pesanan 
									INNER JOIN pesan
									ON pesan.id_pesanan=pesanan.id_pesanan)
									ON pesan.id_menu=menu.id_menu
									WHERE pesanan.id_meja = $meja_yang_dieksekusi AND pesanan.id_status = 1
												");

       			while($pecah = $ambil->fetch_assoc()){ 		?>

			
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $pecah['nama_menu']; ?></td>
					<td align="right"><?php echo rupiah($pecah['harga_menu']); ?></td>
					<td align="right"><?php echo $pecah['jumlah_pesan']; ?></td>
					<td align="right"><?php echo rupiah($pecah['harga_pesan']); ?></td>
					<td>
						<a 	id="ubah" type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubahmenu" 
							data-id="<?php echo $pecah['id_menu'];?>"
							data-meja="<?php echo $meja_yang_dieksekusi;?>"
							data-pesanan="<?php echo $pecah['id_pesanan'];?>"
							data-jumlah="<?php echo $pecah['jumlah_pesan']; ?>">Ubah
						</a>
						<a 	id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusmenu" 
							data-id="<?php echo $pecah['id_menu'];?>"
							data-pesanan="<?php echo $pecah['id_pesanan'];?>"
							data-meja="<?php echo $meja_yang_dieksekusi;?>">Hapus
						</a>
					</td>
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

<script type="text/javascript">
	$(function(){
		$(document).on('click','#batal',function(e){
					e.preventDefault();
					var meja = $(this).data('meja');
					$('.idyangingindihapus').val(meja);
			});
	$(document).on('click','#selesai',function(e){
					e.preventDefault();
					var meja = $(this).data('meja');
					$('.idyangingindiselesaikan').val(meja);
					var pesanan = $(this).data('pesanan');
					$('.idpesananyangingindiselesaikan').val(pesanan);
			});
	$(document).on('click','#hapus',function(e){
					e.preventDefault();
					var id = $(this).data('id');
					$('.idyangingindihapus').val(id);
					var meja = $(this).data('meja');
					$('.idmejayangingindihapus').val(meja);
					var pesanan = $(this).data('pesanan');
					$('.idpesananyangingindihapus').val(pesanan);
			});
				
				$(document).on('click','#ubah',function(e){
					e.preventDefault();
					var id = $(this).data('id');
					var jumlah = $(this).data('jumlah');
					var meja = $(this).data('meja');
					var pesanan = $(this).data('pesanan');
					$('.idyangingindiubah').val(id);
					$('.jumlahyangingindiubah').val(jumlah);
					$('.idmejayangingindihapus').val(meja);
					$('.idpesananyangingindihapus').val(pesanan);
					
			});
	});
</script>




<!--   
===============================================CARI MEMBER======================================================
-->

<div id="carimember" class="modal fade" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Pilih Member</h4>
				</div>
				<div class="modal-body">

					<div class="container col-md-12">
						<form method="POST" autocomplete="off">
							<div class="input-group">
								<span class="input-group-addon"><div class="fa fa-search"></div></span>
								<input type="text" name="search_text" id="search_text" placeholder="cari.." class="form-control">	
							</div>
						</form>
					</div>
					<span>
						<br><br><br>
					</span>
					<div class="table table-bordered" style="height:300px;overflow-y: scroll;">
					<div class="" id="result" tabindex="-1">
						
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
if (isset($_GET['pilih'])) 
            { 
             $korban=$_GET['pilih'];
             $koneksi->query("UPDATE pesanan SET id_pelanggan ='$korban' WHERE id_meja ='$meja_yang_dieksekusi' AND id_status =1 ");
             	//input nilai jumlah dan diskon=================================================================================

						$ambilpel=$koneksi->query("SELECT * FROM pesanan WHERE id_meja='$meja_yang_dieksekusi' AND id_status =1 ");
						$pecahpesanan=$ambilpel->fetch_assoc();
						$id_pesanan_now=$pecahpesanan['id_pesanan'];
						if ($pecahpesanan['id_pelanggan']>1) {

								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$id_pesanan_now'");
								$total = $ambiltotal->fetch_assoc();
								$diskon = $total['totalharga']/10;
								$setelahdiskon =  $total['totalharga']-$diskon;
								$koneksi->query("UPDATE pesanan 
												 SET total_harga = $setelahdiskon,diskon =$diskon
												 WHERE id_pesanan ='$id_pesanan_now'");

						}
						else{
								$diskon = "0";
								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$id_pesanan_now'");
								$total = $ambiltotal->fetch_assoc();
								$koneksi->query("UPDATE pesanan
												 SET total_harga = $total[totalharga], diskon = $diskon
												 WHERE id_pesanan ='$id_pesanan_now'");
							
						}
						//input nilai jumlah===================================================================================


             echo "<meta http-equiv='refresh' content='0;url=index.php?halaman=pesan&nama_meja=$meja_yang_dieksekusi'";
                  
                }
 ?>	


<!--   
===============================================CARI MEMBER======================================================
-->
<!--   
===============================================TAMBAH MENU======================================================
-->

<div id="tambahmenu" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Pilih Menu</h2>
				</div>
					<div class="menu col-md-12">
					<div class="makanan col-md-6" >
						<label class="label_kategorimenu">Makanan</label>
						<div class="" style="height:370px;overflow-y: scroll;">
								<?php   
									$ambil = $koneksi->query("	SELECT * FROM menu 
																WHERE id_status = '1' AND
																id_kategori ='1'
																ORDER BY nama_menu ASC ");
									$kat=1;
									while($pecah = $ambil->fetch_assoc()){ 	?>


									<a id="pilih_menu" data-toggle="modal" data-id="<?php echo $pecah['id_menu'] ?>" 
										data-target="#pilihjumlah" style="cursor: pointer;">
										<div class="col-md-4">
										    <div class="thumbnail thumbnail_menu">
										    <img src="../assets/img/produk/<?php echo $pecah['fotomenu'] ?>" alt="..." style="width:100%">
										      <label class="label_menu"><?php echo $pecah['nama_menu']; ?></label>
											</div>
										</div>
									</a>


								<?php }$kat++;  ?>		
						</div>
					</div>
					<div class="minuman col-md-6" >
						<label class="label_kategorimenu">Minuman</label>
						<div class="" style="height:370px;overflow-y: scroll;">
								<?php   
									$ambil = $koneksi->query("	SELECT * FROM menu 
																WHERE id_status = '1' AND
																id_kategori ='2' 
																ORDER BY nama_menu ASC ");
									$kat=1;
									while($pecah = $ambil->fetch_assoc()){ 	?>
									<a id="pilih_menu" data-toggle="modal" data-id="<?php echo $pecah['id_menu'] ?>" 
										data-target="#pilihjumlah" style="cursor: pointer;">
										<div class="col-md-4">
										    <div class="thumbnail thumbnail_menu">
										    <img src="../assets/img/produk/<?php echo $pecah['fotomenu'] ?>" alt="..." style="width:100%">
										      <label class="label_menu"><?php echo $pecah['nama_menu']; ?></label>
											</div>
										</div>
									</a>
								<?php }$kat++;  ?>		
						</div>
					</div>
					
					</div>
			
				<div class="modal-footer">
					
					<button type="button" class="btn btn-success" data-dismiss="modal" name="okmenu">OK</button>
				</div>
			</div>
		</div>
	</div>
<script>
			$(function(){
				$(document).on('click','#pilih_menu',function(e){
					e.preventDefault();
					var id = $(this).data('id');
					$('.idyanginginditambah').val(id);
			});
			});
</script>


<!--   
===============================================TAMBAH MENU======================================================
-->



<!--   
===============================================PILIH JUMLAH MENU======================================================
-->


	<div id="pilihjumlah" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Jumlah</h2>
				</div>
				<div class="modal-body col-md-12">
					<form method="POST">
						<input type="hidden" name="id_nya" class="idyanginginditambah">
						<div class="form-group">
							<input type="number" class="form-control" name="jumlahpesan" autocomplete="off" required="">
						</div>
						<input type="submit" class="btn btn-success" name="okmenu" value="Simpan">
					</form>
							<?php 

			if (isset($_POST['okmenu'])) 
									{ 
							           

										$name_check = 	mysqli_num_rows(
														mysqli_query($koneksi,
														"SELECT * FROM pesan 
														WHERE id_menu ='$_POST[id_nya]'AND id_pesanan ='$id_pesanan_sekarang' "));

										if ($name_check>0) {
														?><script type="text/javascript">
															swal("Sudah ada", 
															{	icon : "warning",
																className : "sweetalertmn",
																button: false,
																timer: 1000
															});
														</script><?php
											}
										else{


									$ambil = $koneksi->query("SELECT * 
													FROM admin 
													INNER JOIN(pelanggan 
													INNER JOIN(pesanan INNER JOIN meja
													ON pesanan.id_meja=meja.id_meja)
													ON pesanan.id_pelanggan=pelanggan.id_pelanggan)
													ON pesanan.id_admin=admin.id_admin
													WHERE pesanan.id_meja = $meja_yang_dieksekusi AND pesanan.id_status = 1
													");
													$pecah = $ambil->fetch_assoc();
													$id_pesanan_now =$pecah['id_pesanan'];


							             $menukorban=$_POST['id_nya'];
							             $ambilmenu = $koneksi->query("SELECT * FROM menu WHERE id_menu = $menukorban");
							             $harga_menu = $ambilmenu->fetch_assoc();
							             $pecahharga = $harga_menu['harga_menu'];
							             $hargapesan = $pecahharga*$_POST['jumlahpesan'];
							             $koneksi->query("	INSERT INTO pesan
							             					(id_pesanan,id_menu,jumlah_pesan,harga_pesan)
							             					 VALUES($id_pesanan_now,$menukorban,'$_POST[jumlahpesan]',$hargapesan)");
						//input nilai jumlah dan diskon=================================================================================

						$ambilpel=$koneksi->query("SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan_now' AND id_status =1 ");
						$pecahpesanan=$ambilpel->fetch_assoc();

						if ($pecahpesanan['id_pelanggan']>1) {

								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$id_pesanan_now'");
								$total = $ambiltotal->fetch_assoc();
								$diskon = $total['totalharga']/10;
								$setelahdiskon =  $total['totalharga']-$diskon;
								$koneksi->query("UPDATE pesanan 
												 SET total_harga = $setelahdiskon,diskon =$diskon
												 WHERE id_pesanan ='$id_pesanan_now'");

						}
						else{
								$diskon = "0";
								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$id_pesanan_now'");
								$total = $ambiltotal->fetch_assoc();
								$koneksi->query("UPDATE pesanan
												 SET total_harga = $total[totalharga], diskon = $diskon
												 WHERE id_pesanan ='$id_pesanan_now'");
							
						}
						//input nilai jumlah===================================================================================



						echo "<meta http-equiv='refresh' content='0;url=index.php?halaman=pesan&nama_meja=$meja_yang_dieksekusi'";
							                	


							                	}
							                }
							 ?>

				</div>
				<div class="modal-footer">
					

				</div>
			</div>
		</div>
	</div>

<!--   
===============================================PILIH JUMLAH MENU======================================================
-->
<!--   
================================================UBAH MENU======================================================
-->

<div class="modal fade" id="ubahmenu" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">



				<div class="modal-header">
					<h2>UBAH JUMLAH YANG DIPESAN</h2>
				</div>

				<form method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="idmenu" class="idyangingindiubah">
					<input type="hidden" name="idpesan" class="idpesananyangingindihapus">
					<div class="form-group">
						<input type="text" class="form-control jumlahyangingindiubah" name="jumlah">
					</div>
					<hr>
					<button class="btn btn-success simpan_update" name="update">Simpan</button>
					</form>
							<?php 

							if (isset($_POST['update'])) 
							{	
								
								$idpesanan = $_POST['idpesan'];
								$menukorban=$_POST['idmenu'];
							             $ambilmenu = $koneksi->query("SELECT * FROM menu WHERE id_menu = $menukorban");
							             $harga_menu = $ambilmenu->fetch_assoc();
							             $pecahharga = $harga_menu['harga_menu'];
								$jumlah = $_POST['jumlah']*$pecahharga;
								
								$koneksi->query("UPDATE pesan
												 SET jumlah_pesan='$_POST[jumlah]', harga_pesan='$jumlah'
												 WHERE id_pesanan='$idpesanan' AND id_menu = '$_POST[idmenu]' ");
						//input nilai jumlah dan diskon=================================================================================

						$ambilpel=$koneksi->query("SELECT * FROM pesanan WHERE id_pesanan='$idpesanan' AND id_status =1 ");
						$pecahpesanan=$ambilpel->fetch_assoc();

						if ($pecahpesanan['id_pelanggan']>1) {

								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$idpesanan'");
								$total = $ambiltotal->fetch_assoc();
								$diskon = $total['totalharga']/10;
								$setelahdiskon =  $total['totalharga']-$diskon;
								$koneksi->query("UPDATE pesanan 
												 SET total_harga = $setelahdiskon,diskon =$diskon
												 WHERE id_pesanan ='$idpesanan'");

						}
						else{
								$diskon = "0";
								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$idpesanan'");
								$total = $ambiltotal->fetch_assoc();
								$koneksi->query("UPDATE pesanan
												 SET total_harga = $total[totalharga], diskon = $diskon
												 WHERE id_pesanan ='$idpesanan'");
							
						}
						//input nilai jumlah===================================================================================
										
							echo "<meta http-equiv='refresh' content='0;url=index.php?halaman=pesan&nama_meja=$meja_yang_dieksekusi'";		
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
================================================HAPUS MENU PESANAN======================================================
-->

<div class="modal fade" id="hapusmenu" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">

					<input type="hidden" name="idmenu" class="idyangingindihapus">
					<input type="hidden" name="idmeja" class="idmejayangingindihapus">
					<input type="hidden" name="idpesan" class="idpesananyangingindihapus">
					<h4 align="center"><b>Yakin ingin dihapus ?</b></h4><hr>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-danger col-md-3 delete_aja_pesananya" name="ya" >YA</button>
					<div class="col-md-2"></div>
					<button type="button" data-dismiss="modal" class="btn btn-success col-md-3 hapusmenu_close" name="tidak">TIDAK</button>
					<div class="col-md-2"></div>
					<hr><br>
				<?php 
				if (isset($_GET['deletemenu'])) 
					{	
						$menudaripesanan = $_GET['deletemenu'];
						$pesanannya	= $_GET['pesanan'];

						$koneksi->query("DELETE FROM pesan WHERE id_pesanan='$pesanannya' AND id_menu ='$menudaripesanan'");

						//input nilai jumlah=================================================================================

						$ambilpel=$koneksi->query("SELECT * FROM pesanan WHERE id_pesanan='$pesanannya' AND id_status =1 ");
						$pecahpesanan=$ambilpel->fetch_assoc();

						if ($pecahpesanan['id_pelanggan']>1) {

								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$pesanannya'");
								$total = $ambiltotal->fetch_assoc();
								$diskon = $total['totalharga']/10;
								$setelahdiskon =  $total['totalharga']-$diskon;
								$koneksi->query("UPDATE pesanan 
												 SET total_harga = $setelahdiskon,diskon =$diskon
												 WHERE id_pesanan ='$pesanannya'");

						}
						else{
								$diskon = "0";
								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$pesanannya'");
								$total = $ambiltotal->fetch_assoc();
								$koneksi->query("UPDATE pesanan
												 SET total_harga = $total[totalharga], diskon = $diskon
												 WHERE id_pesanan ='$pesanannya'");
							
						}
						//input nilai jumlah===================================================================================

						
						echo "<meta http-equiv='refresh' content='0;url=index.php?halaman=pesan&nama_meja=$meja_yang_dieksekusi'";
						
					}
				 ?>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.hapusmenu_close').click(function(){
			$('#hapusmenu').modal('toggle');
		});
		$('.delete_aja_pesananya').click(function(){
			var url = "index.php?halaman=pesan&nama_meja=";
			var pesanan = $('.idpesananyangingindihapus').val();
			var meja = $('.idmejayangingindihapus').val();
			var id = $('.idyangingindihapus').val();
			window.location.href= url+meja+'&deletemenu='+id+'&pesanan='+pesanan;
		});
	});

</script>

<!--   
================================================HAPUS MENU PESANAN======================================================
-->

<!--   
================================================HAPUS PESANAN======================================================
-->

<div class="modal fade" id="batalpesan" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">

					<input type="hidden" name="id" class="idyangingindihapus">
					<h4 align="center"><b>Yakin ingin dibatalkan ?</b></h4><hr>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-danger col-md-3 delete_aja_gpp" name="ya" >YA</button>
					<div class="col-md-2"></div>
					<button type="button" data-dismiss="modal" class="btn btn-success col-md-3 hapuspesanan_close" name="tidak">TIDAK</button>
					<div class="col-md-2"></div>
					<hr><br>
				<?php 
				if (isset($_GET['delete'])) 
					{		
						$mejayangdiexsekusi = $_GET['delete'];
						$koneksi->query("DELETE FROM pesanan WHERE id_meja=$mejayangdiexsekusi AND id_status=1");
						$koneksi->query("UPDATE meja SET id_status = 2 WHERE id_meja ='$mejayangdiexsekusi'");
						echo "<meta http-equiv='refresh' content='0;url=index.php'>";

						
					}
				 ?>

			</div>
		</div>
	</div>
</div>


<!--   
================================================HAPUS PESANAN======================================================
-->

<!--   
================================================SELESAIKAN PESANAN======================================================
-->

<div class="modal fade" id="selesaipesan" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">
	
					<input type="hidden" name="idpesanan" class="idpesananyangingindiselesaikan">
					<input type="hidden" name="id" class="idyangingindiselesaikan">
					<h2 align="center">Selesai ?</h2><hr>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-danger col-md-3 selesaiin_aja_ngk_papa" name="ya" >YA</button>
					<div class="col-md-2"></div>
					<button type="button" data-dismiss="modal" class="btn btn-success col-md-3 belum_kampret" name="tidak">TIDAK</button>
					<div class="col-md-2"></div>
					<hr><br>
				<?php 
				if (isset($_GET['finish'])) 
					{		
						$mejayangdiexsekusi = $_GET['finish'];
						$idpesanannya = $_GET['pesanan'];
						$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
													   FROM pesan
													   WHERE id_pesanan ='$idpesanannya'");
						$total = $ambiltotal->fetch_assoc();
						$koneksi->query("UPDATE pesanan SET total_harga = $total[totalharga] WHERE id_pesanan ='$idpesanannya'");
					//input nilai jumlah=================================================================================

						$ambilpel=$koneksi->query("SELECT * FROM pesanan WHERE id_pesanan='$idpesanannya' AND id_status =1 ");
						$pecahpesanan=$ambilpel->fetch_assoc();

						if ($pecahpesanan['id_pelanggan']>1) {

								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$idpesanannya'");
								$total = $ambiltotal->fetch_assoc();
								$diskon = $total['totalharga']/10;
								$setelahdiskon =  $total['totalharga']-$diskon;
								$koneksi->query("UPDATE pesanan 
												 SET total_harga = $setelahdiskon,diskon =$diskon
												 WHERE id_pesanan ='$idpesanannya'");

						}
						else{
								$diskon = "0";
								$ambiltotal = $koneksi->query("SELECT SUM(harga_pesan) AS 'totalharga'
															   FROM pesan
															   WHERE id_pesanan ='$idpesanannya'");
								$total = $ambiltotal->fetch_assoc();
								$koneksi->query("UPDATE pesanan
												 SET total_harga = $total[totalharga], diskon = $diskon
												 WHERE id_pesanan ='$idpesanannya'");
							
						}
						//input nilai jumlah===================================================================================
						$koneksi->query("UPDATE pesanan
										 SET id_status = 2
										 WHERE id_meja=$mejayangdiexsekusi AND id_status=1");
						$koneksi->query("UPDATE meja SET id_status = 2 WHERE id_meja ='$mejayangdiexsekusi'");
						echo "<meta http-equiv='refresh' content='0;url=index.php'>";
					}
				 ?>

			</div>
		</div>
	</div>
</div>


<!--   
================================================SELESAIKAN PESANAN======================================================
-->


<script type="text/javascript">
	$(document).ready(function(){
		$('.hapuspesanan_close').click(function(){
			$('#batalpesan').modal('toggle');
		});
		$('.delete_aja_gpp').click(function(){
			var url = "index.php?halaman=pesan&nama_meja=";
			var id = $('.idyangingindihapus').val();
			window.location.href= url+id+'&delete='+id;
		});
		$('.belum_kampret').click(function(){
			$('#selesaipesan').modal('toggle');
		});
		$('.selesaiin_aja_ngk_papa').click(function(){
			var url = "index.php?halaman=pesan&nama_meja=";
			var id = $('.idyangingindiselesaikan').val();
			var pesan = $('.idpesananyangingindiselesaikan').val();
			window.location.href= url+id+'&finish='+id+'&pesanan='+pesan;
		});

 load_data();
 function load_data(query,meja)
 {
  $.ajax({
   url:"cari.php",
   method:"POST",
   data:{query:query,meja:<?php echo $meja_yang_dieksekusi ?>},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>




