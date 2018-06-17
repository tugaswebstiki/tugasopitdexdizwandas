<div>

	<div><h2>DAFTAR TRANSAKSI</h2><hr> 
	</div>
	<br>
<div style="height:360px;overflow-y: scroll; ">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Admin</th>
			<th>Member</th>
			<th>Meja</th>
			<th>Waktu Transaksi</th>
			<th>Total Belanja</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

		 
		<?php   $no=1;
			$ambil = $koneksi->query(	"SELECT * 
										FROM admin 
										INNER JOIN( pelanggan
										INNER JOIN( pesanan INNER JOIN meja
										ON pesanan.id_meja=meja.id_meja)
										ON pesanan.id_pelanggan=pelanggan.id_pelanggan)
										ON pesanan.id_admin=admin.id_admin");?>

		<?php while($pecah = $ambil->fetch_assoc()){ 		?>
		 

		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $pecah['nama_admin']; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['nama_meja']; ?></td>
			<td><?php echo $pecah['waktu_pemesanan']; ?></td>
			<td><?php echo $pecah['total_harga']; ?></td>
			<td> 
				<!--<?php  
				$ambildata = $koneksi->query("SELECT * 
										FROM pesan
										WHERE id_pesanan="$pecah[id_pesanan]" ");
										?>-->
				<a href=""
				data-toggle="modal"
				data-target="#detailtransaksi"
				data-
				 class="btn btn-info">Detail</a>
			</td>
		</tr>

		<?php
			$no++;
			}
		?>

	</tbody>
</table></div>
</div>