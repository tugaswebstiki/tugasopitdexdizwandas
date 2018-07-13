<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<div>

	<div><h2>DAFTAR TRANSAKSI</h2><hr> 
	</div>
	<br>
<div style="height:400px;overflow-y: scroll; ">
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>Waktu Transaksi</th>
			<th>Admin</th>
			<th>Member</th>
			<th>Meja</th>
			<th>Diskon</th>
			<th>Total Belanja</th>
			<th>Status Transaksi</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

		 
		<?php   $no=1;
			$ambil = $koneksi->query(	"SELECT * 
										FROM admin 
										INNER JOIN( status
										INNER JOIN( pelanggan
										INNER JOIN( pesanan INNER JOIN meja
										ON pesanan.id_meja=meja.id_meja)
										ON pesanan.id_pelanggan=pelanggan.id_pelanggan)
										ON pesanan.id_status=status.id_status)
										ON pesanan.id_admin=admin.id_admin
										ORDER BY pesanan.waktu_pemesanan desc ");
			
										?>

		<?php while($pecah = $ambil->fetch_assoc()){ 		?>
		 

		<tr>


			<td><?php echo $no; ?></td>
			<td><?php echo $pecah['waktu_pemesanan']; ?></td>
			<td><?php echo"A-"; echo$pecah['id_admin']; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['nama_meja']; ?></td>
			<td align="right"><?php echo rupiah($pecah['diskon']); ?></td>
			<td ><?php echo rupiah($pecah['total_harga']); ?></td>
			<td><?php echo $pecah['sedang']; ?></td>
			<td> 
				<a type="button" 
				id="custId"
				href="#detailtransaksi"
				data-toggle="modal"
				data-id="<?php echo $pecah['id_pesanan']; ?>"
				 class="btn btn-info">Detail</a>
					<?php if ($_SESSION['sess_jbt']==1) { ?>
				 <a id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapustransaksi" data-id="<?php echo $pecah['id_pesanan'];?>">Hapus</a>
					<?php } ?>
			</td>
		</tr>

		<?php
			$no++;
			}
		?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    $(function(){
				$(document).on('click','#hapus',function(e){
					e.preventDefault();
					var id = $(this).data('id');
					$('.idyangingindihapus').val(id);
			});
		       $(document).on('click','#custId',function(e){
		            var rowid = $(this).data('id');
		            $.ajax({
		                type : 'post',
		                url : 'detail.php',
		                data :  'rowid='+ rowid,
		                success : function(data){
		                $('.fetched-data').html(data);
		                }
		            });
		         });
    });
  </script>
	</tbody>
</table></div>



<div class="modal fade" id="detailtransaksi" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Transaksi</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

 <!--   
================================================HAPUS MENU======================================================
-->

<div class="modal fade" id="hapustransaksi" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document"> 
		<div class="modal-content">
			<div class="modal-body">

					<input type="hidden" name="id" class="idyangingindihapus">
					<h4 align="center"><b>Yakin ingin dihapus ?</b></h4><hr>
					<div class="col-md-2"></div>
					<button type="button" class="btn btn-danger col-md-3 delete_aja_gpp" name="ya" >YA</button>
					<div class="col-md-2"></div>
					<button type="button" data-dismiss="modal" class="btn btn-success col-md-3 hapusmenu_close" name="tidak">TIDAK</button>
					<div class="col-md-2"></div>
					<hr><br>
				<?php 
				if (isset($_GET['delete'])) 
					{		
						
						$id = $_GET['delete'];

						$koneksi->query("DELETE FROM pesanan WHERE id_pesanan='$id'");
						$koneksi->query("DELETE FROM pesan WHERE id_pesanan='$id'");


						
						echo "<meta http-equiv='refresh' content='0;url=index.php?halaman=transaksi'>";

						
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
			var url = "index.php?halaman=transaksi";
			var id = $('.idyangingindihapus').val();
			window.location.href= url+'&delete='+id;
		});
	});

</script>
  
</div>
</body>
</html>