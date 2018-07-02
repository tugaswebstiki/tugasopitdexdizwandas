<?php
$koneksi= new mysqli('localhost','root','','restorant');
date_default_timezone_set('Asia/Kuala_Lumpur');
$waktu_pesan = date('d M Y', time());
$pesanan=19;
$ambil = $koneksi->query("	SELECT * 
							FROM menu 
							INNER JOIN(pesan
							INNER JOIN( pesanan INNER JOIN meja
							ON pesanan.id_meja=meja.id_meja)
							ON pesan.id_pesanan=pesanan.id_pesanan)
							ON pesan.id_menu=menu.id_menu
							WHERE pesanan.id_pesanan = $pesanan  ");
$pecah=$ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
</head>
<body>
<div class="col-md-3">
	<div class="header">
		<div><img class="col-md-12"src="../assets/img/logo.jpeg"></div>
		<span>Jl.Bisma no.56, Blahbatuh | Telp.08986545983</span>
		<hr style="margin: 5px;">
		<table class="col-md-12">
			<tr>
				<td class="col-md-8">No Nota : <?php echo $pecah['id_pesanan']; ?></td>
				<td class="col-md-4" rowspan="2" style="font-size: 18px;">Meja <?php echo $pecah['nama_meja']; ?></td>
			</tr>
			<tr>
				<td class="col-md-8">Tanggal : <?php echo $waktu_pesan ?></td>
			</tr>
		</table>
	</div>
	
	<div class="body">
		<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>NamaMenu</th>
			<th>Harga</th>
			<th>Qty</th>
			<th>Jumlah</th>
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
									WHERE pesanan.id_pesanan = $pesanan");

       			while($pecah = $ambil->fetch_assoc()){ 		?>

			
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $pecah['nama_menu']; ?></td>
					<td align="right"><?php echo $pecah['harga_menu']; ?></td>
					<td align="right"><?php echo $pecah['jumlah_pesan']; ?></td>
					<td align="right"><?php echo $pecah['harga_pesan']; ?></td>
				</tr>

				<?php
				$no++;		
			}	

		$ambil = $koneksi->query("	SELECT * 
									FROM menu 
									INNER JOIN(pesanan 
									INNER JOIN pesan
									ON pesan.id_pesanan=pesanan.id_pesanan)
									ON pesan.id_menu=menu.id_menu
									WHERE pesanan.id_pesanan = $pesanan");

       	$pecah = $ambil->fetch_assoc();
			
			  ?>	
			  		<tr>
					<td></td>
					<td></td>
					<td></td>
					<td align="right">Diskon</td>
					<td align="right"><?php echo $pecah['diskon']; ?></td>
					</tr>
					<tr>
					<td></td>
					<td></td>
					<td></td>
					<td align="right">Total</td>
					<td align="right"><?php echo $pecah['total_harga']; ?></td>
					</tr>

	</tbody>
</table>
	</div>
	<div class="footer">
		<h4 align="center"><i class="fa fa-smile-o"></i> Terima Kasih <i class="fa fa-smile-o"></i></h4>
	</div>
</div>
</body>
</html>