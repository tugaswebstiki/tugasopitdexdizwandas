<?php
$pesanan = str_replace(" ", "_", strtolower($_POST['id_pesanan']));
$koneksi= new mysqli('localhost','root','','restorant');
date_default_timezone_set('Asia/Kuala_Lumpur');
$waktu_pesan = date('d M Y', time());
$ambil = $koneksi->query("	SELECT * 
							FROM menu 
							INNER JOIN(pesan
							INNER JOIN( pesanan INNER JOIN meja
							ON pesanan.id_meja=meja.id_meja)
							ON pesan.id_pesanan=pesanan.id_pesanan)
							ON pesan.id_menu=menu.id_menu
							WHERE pesanan.id_pesanan = $pesanan  ");
$pecah=$ambil->fetch_assoc();
require_once("../assets/dompdf/dompdf_config.inc.php");
$output =
			'<!DOCTYPE html>'.
			'<html>'.
			'<head>'.
				'<title></title>'.
			'</head>'.
			'<body>'.
			'<div>'.
				'<div class="header">'.
					'<div><img style="width: 100%" src="../assets/img/logo.jpeg"></div>'.
					'<span>Jl.Bisma no.56, Blahbatuh | Telp.08986545983</span>'.
					'<hr style="margin: 5px;">'.
					'<table style="width: 100%">'.
						'<tr>'.
							'<td  style="width: 70%">No Nota : '.$pecah["id_pesanan"].'</td>'.
							'<td  style="width: 30%;font-size: 26px;" rowspan="2" style="font-size: 18px;">Meja '.$pecah["nama_meja"].'</td>'.
						'</tr>'.
						'<tr>'.
							'<td  style="width: 70%">Tanggal : '.$waktu_pesan.'</td>'.
						'</tr>'.
					'</table>'.
				'</div>'.
				
				'<div class="body">'.
					'<table style="width: 100%;border-collapse: collapse;">'.
				'<thead style="border-bottom-width: 2px;border: 1px solid #ddd;">'.
					'<tr>'.
						'<th>No</th>'.
						'<th>NamaMenu</th>'.
						'<th>Harga</th>'.
						'<th>Qty</th>'.
						'<th>Jumlah</th>'.
					'</tr>'.
				'</thead>'.
				'<tbody>';
			
		


  
        $no=1;
        $ambil = $koneksi->query("	SELECT * 
									FROM menu 
									INNER JOIN(pesanan 
									INNER JOIN pesan
									ON pesan.id_pesanan=pesanan.id_pesanan)
									ON pesan.id_menu=menu.id_menu
									WHERE pesanan.id_pesanan = $pesanan");

       			while($pecah = $ambil->fetch_assoc()){ 	

			
$output .=			'<tr style="border: 1px solid #ddd;">'.
					'<td style="border: 1px solid #ddd;">'.$no.'</td>'.
					'<td style="border: 1px solid #ddd;">'.$pecah["nama_menu"].'</td>'.
					'<td style="border: 1px solid #ddd;" align="right">'.$pecah["harga_menu"].'</td>'.
					'<td style="border: 1px solid #ddd;" align="right">'.$pecah["jumlah_pesan"].'</td>'.
					'<td style="border: 1px solid #ddd;" align="right">'.$pecah["harga_pesan"].'</td>'.
				'</tr>';

				
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
			
			 
$output .=			'<tr>'.
					'<td></td>'.
					'<td></td>'.
					'<td></td>'.
					'<td >Diskon</td>'.
					'<td style="border: 1px solid #ddd;" align="right">'.$pecah["diskon"].'</td>'.
					'</tr>'.
					'<tr>'.
					'<td></td>'.
					'<td></td>'.
					'<td></td>'.
					'<td >Total</td>'.
					'<td style="border: 1px solid #ddd;" align="right">'.$pecah["total_harga"].'</td>'.
					'</tr>'.

	'</tbody>'.
'</table>'.
	'</div>'.
	'<div class="footer">'.
		'<h4 align="center"> Terima Kasih </i></h4>'.
	'</div>'.
'</div>'.
'</body>'.
'</html>';


$dompdf = new DOMPDF();
$dompdf->load_html($output);
$dompdf->set_paper('A6','potrait');
$dompdf->render();
$dompdf->stream("Nota", array("Attachment"=>0));

?>