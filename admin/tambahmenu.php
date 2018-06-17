<div class="modal fade" id="ubahmenu" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document"> 
		<div class="modal-content">
			<div class="modal-body">

				<div class="modal-header">
					<h2>UBAH MENU</h2>
				</div>
<input type="hidden" name="idyangingindiubah" class="idyangingindiubah">


<?php
			
				$ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu='$_GET[id]'
				
					 ");
				$pecah = $ambil->fetch_assoc();
				echo "<pre>";
				print_r($pecah);
				echo "</pre>";


?>
				



						</div>	
					</div>	
				</div>
			</div>

