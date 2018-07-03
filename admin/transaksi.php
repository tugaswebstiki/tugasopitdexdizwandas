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
										ORDER BY pesanan.waktu_pemesanan desc");
	
										?>

		<?php while($pecah = $ambil->fetch_assoc()){ 		?>
		 

		<tr>


			<td><?php echo $no; ?></td>
			<td><?php echo $pecah['waktu_pemesanan']; ?></td>
			<td><?php echo $pecah['nama_admin']; ?></td>
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
			</td>
		</tr>

		<?php
			$no++;
			}
		?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    
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

 
  
</div>
</body>
</html>