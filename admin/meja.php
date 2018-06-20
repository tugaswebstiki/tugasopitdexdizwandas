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

					?>

				
							<div class="col-md-2">
								<span><?php echo "&nbsp&nbsp&nbsp&nbspMeja No."; echo $pecah['nama_meja']; ?></span>
								<div class="thumbnail" style="border: 0px !important;">

										<?php
											if ($pecah['id_status']==1) {
										?>
															
															<a href="index.php?halaman=pesan&id=<?php echo $pecah['id_meja']; ?>" class="tombol_meja">
																<img src="../assets/img/meja/penuh.jpg">
															</a>
															
														

										<?php }
											else{
										?>
											
															<a href="index.php?halaman=pesan&id=<?php echo $pecah['id_meja']; ?>" class="tombol_meja">
																<img src="../assets/img/meja/kosong.jpg">
															</a>
															
										<?php
											}
										?>
									</div>
								</div>
							
					<?php } ?>


</div>
