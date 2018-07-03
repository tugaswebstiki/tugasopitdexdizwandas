<?php 
    $koneksi= new mysqli('localhost','root','','restorant');
     function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;}
 ?>
<?php 
 if($_POST['rowid']) {
 	?>
 	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Jumlah</th>
				<th>Harga</th>
			</tr>
		</thead>
		<tbody>
			
		


<?php
        $id = $_POST['rowid'];
        $no=1;
        $ambil = $koneksi->query("	SELECT * 
									FROM menu
									INNER JOIN pesan
									ON pesan.id_menu=menu.id_menu
									WHERE id_pesanan=$id "
									);

       			while($pecah = $ambil->fetch_assoc()){ 		?>

			
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $pecah['nama_menu']; ?></td>
					<td><?php echo $pecah['jumlah_pesan']; ?></td>
					<td align="right"><?php echo rupiah($pecah['harga_pesan']); ?></td>
					
				</tr>

				<?php
				$no++;
			}
			?>

	</tbody>
</table>


        <?php 
 
    } 
    ?>