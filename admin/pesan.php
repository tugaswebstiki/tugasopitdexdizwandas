<div>

	<div><h2>DAFTAR ADMIN</h2><hr> 
		<a href="index.php?halaman=tambahadmin" class="btn btn-success">Tambah</a> 
	</div>
	<br>



		 
		<?php 
			$ambil = $koneksi->query(
										"SELECT * 
										FROM admin "
									);
										
			while($pecah = $ambil->fetch_assoc()){ 		?>
		 
			<div class="col-md-3">
			<table class="">
				<tr>
					<td ><img class="img-rounded"  width="120px" height="160px" src="../assets/img/profil/<?php echo $pecah['foto_admin'] ?>" ></td>
				</tr>
				<tr>
					<td align="center"><?php  echo $pecah['nama_admin']; ?></td>
				</tr>
				
			</table>
			</div>


		<?php
			
			}
		?>


</div>