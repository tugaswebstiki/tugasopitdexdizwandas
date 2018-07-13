<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		$tahun=date("Y");
		$tahunlalu=$tahun-1;
	 ?>
	 <style type="text/css">
			#container {
				min-width: 310px;
				max-width: 800px;
				height: 300px;
				margin: 0 auto
			}
	</style>
</head>
<body>
	<script src="../assets/js/chart/highcharts.js"></script>
	<script src="../assets/js/chart/series-label.js"></script>
	<script src="../assets/js/chart/exporting.js"></script>
	<script src="../assets/js/chart/export-data.js"></script>

<div>

	<div><h2>PENJUALAN</h2><hr> 
	</div>
	<br>
		
<div id="container"></div>


<script type="text/javascript">

	Highcharts.chart('container', {

	    title: {
	        text: '2018'
	    },

	    credits: {
      	enabled: false
  		},

  		exporting: 
  		{ enabled: false 
  		},

	    subtitle: {
	        text: ''
	    },

	    yAxis: {
	        title: {
	            text: 'Jumlah (Rp)'
	        }
	    },

	    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    	},
	    
	    legend: {
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'middle'
	    },

	    series: [	<?php $put = $koneksi->query("SELECT * FROM menu ");  
	    					while($bagi = $put->fetch_assoc()){ 		

	    				$nama=$bagi['nama_menu'];?>
				   	   {name : '<?php echo $nama; ?>',
				        data : [
				        			<?php 
				        			
				        			for ($perulangan=1;$perulangan<13;$perulangan++) {
				        				$ambil = $koneksi->query("	SELECT SUM(pesan.jumlah_pesan)AS 'total' FROM pesan 
				        											INNER JOIN pesanan
				        											ON pesan.id_pesanan=pesanan.id_pesanan
																	WHERE year(pesanan.waktu_pemesanan)= $tahun 
																	AND month(pesanan.waktu_pemesanan)= $perulangan
																	AND pesan.id_menu=$bagi[id_menu]");
				        				
				        				$pecah = $ambil->fetch_assoc();
				        				if ($pecah['total']=='') {
				        				echo "0,";	
				        				}
				        				else{
				        				echo $pecah['total']; echo ",";
				        				}
				        			}
				        			 ?>
				        ]},
				    <?php } ?>

	    ],

	    responsive: {
	        rules: [{
	            condition: {
	                maxWidth: 500
	            },
	            chartOptions: {
	                legend: {
	                    layout: 'horizontal',
	                    align: 'center',
	                    verticalAlign: 'bottom'
	                }
	            }
	        }]
	    }

	});
</script>

  
</div>
</body>
</html>