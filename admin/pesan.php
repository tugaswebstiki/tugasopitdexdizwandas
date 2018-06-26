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
				<div class="form-control" ><?php echo $pecah['nama_admin'];?></div>
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
			<button type="button" class="btn btn-warning form-control" data-toggle="modal" data-target="#">Selesai</button>
		</div>
		
</div>

	
	

	

	

</form>




<div>
	<div class="col-md-8 paddingbutton">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#carimenu"><i class="fa fa-plus"></i>&nbsp&nbspTambah</button>
	</div>
	<div class="col-md-2 paddingbutton">
	<button type="button" class="btn lebar100" data-toggle="modal" data-target="#">Cetak Nota</button>
	</div>
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
						
					</div><input type="hidden" clas="pelanggan_yang_di_eksekusi" value="<?php echo $meja_yang_dieksekusi ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	


<!--   
===============================================CARI MEMBER======================================================
-->
<!--   
===============================================CARI MENU======================================================
-->

<div id="carimenu" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pilih Menu</h4>
				</div>
				<div class="">
					<?php   
						$ambil = $koneksi->query("SELECT * FROM menu WHERE id_status = '1'");
					?>
					 

					<?php $kat=1;

						while($pecah = $ambil->fetch_assoc()){ 	
					?>
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
				<div class="modal-footer">
					
					<button type="button" class="btn btn-success" data-dismiss="modal" name="okmenu">OK</button>
				</div>
			</div>
		</div>
	</div>



<!--   
===============================================CARI MENU======================================================
-->




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
						echo "<meta http-equiv='refresh' content='1;url=index.php'>";

						
					}
				 ?>

			</div>
		</div>
	</div>
</div>


<!--   
================================================HAPUS PESANAN======================================================
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
	});

$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"cari.php",
   method:"POST",
   data:{query:query},
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