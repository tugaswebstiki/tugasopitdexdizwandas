<div>

	<div><h2>DAFTAR MEJA</h2><hr> 
		<a href="index.php?halaman=tambahmeja" class="btn btn-success">Tambah</a> 
	</div>
	<br>

	



<?php   
					$ambil = $koneksi->query("SELECT * FROM meja");
				?>
		 


					<?php 

					while($pecah = $ambil->fetch_assoc()){ 	
					if ($pecah['id_status']==1) {
					?>

				
							<div class="col-md-2">
								<a class="noeffect" href="index.php?halaman=pesan&id=<?php echo $pecah['id_meja']; ?>">
								<div class="thumbnail fotomeja mejapenuh" style="border: 0px !important;">	
									<div class="nomeja">
									<?php 
										echo " $pecah[nama_meja] ";
									 ?>
									</div>
								</div>
								</a>
							</div>					

										<?php }
											else{
										?>


							<div class="col-md-2">
								<a class="noeffect" href="index.php?halaman=pesan&id=<?php echo $pecah['id_meja']; ?>">
								<div class="thumbnail fotomeja" style="border: 0px !important;">	
									<div class="nomeja">
									<?php 
										echo " $pecah[nama_meja] ";
									 ?>
									</div>
								</div>
							</a>
							</div>	
															
										<?php
											}
										?>
								
					<?php } ?>


</div>
