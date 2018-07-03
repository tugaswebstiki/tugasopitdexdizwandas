<!DOCTYPE html>
<?php 
    session_start();
    function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
 
}
    $koneksi= new mysqli('localhost','root','','restorant');
 ?>
<head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restorant</title>
    <script src="../assets/js/jquery_sweet_alert.min_2.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="../assets/css/ganti.css" rel="stylesheet" />
    <link href="../assets/css/sweetalert.min.css" rel="stylesheet" />
 
    <script type="text/javascript">
        window.setTimeout(" waktu() ",1000);
        function waktu()
        {
            var tanggal = new Date();
            var jam = tanggal.getHours();
            var menit = tanggal.getMinutes();
            var detik = tanggal.getSeconds();
            var teskjam = new String();
            if(jam <= 9)
                jam = "0"+jam;
            if(menit <= 9)
                menit = "0"+menit;
            if(detik <= 9)
                detik = "0"+detik;
            teskjam = jam + ":" + menit + ":" + detik;
            document.getElementById("jamdigital").innerHTML = teskjam;
            setTimeout("waktu()",1000);
        }

        function bacaGambar(input) {

        if (input.files && input.files[0]) {

                                    var reader = new FileReader();
                                     reader.onload = function (e) {
                                                $('#gambar_nodin').attr('src', e.target.result);
                                                                 }
                                      reader.readAsDataURL(input.files[0]);
                                            }
                                    }
        $("#preview_gambar").change(function(){
                                                bacaGambar(this);
                                                                    });
        function bacaGambarbaru(input) {
        if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                     reader.onload = function (e) {
                                               $('#gambar_baru').attr('src', e.target.result);
                                                                   }
                                         reader.readAsDataURL(input.files[0]);
                                            }
                                    }
        $("#preview_gambar_baru").change(function(){
                                                bacaGambarbaru(this);
                                                                    });
        function bacaGambaradmin(input) {

        if (input.files && input.files[0]) {

                                    var reader = new FileReader();
                                     reader.onload = function (e) {
                                                $('#gambar_admin').attr('src', e.target.result);
                                                                 }
                                      reader.readAsDataURL(input.files[0]);
                                            }
                                    }
        $("#preview_gambar_admin").change(function(){
                                                bacaGambaradmin(this);
                                                                    });
        
    </script>



</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="jamdigital navbar-brand" id="jamdigital"></div>
            </div>
            
            <div class=" paneljam">
           
             &nbsp; <a href="../index.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
             <div class=" paneljam">
             
             <?php
            echo date("  d M Y") . "<br>";
            ?>
            
            </div>
            <div class=" paneljam" id="jamdigital"></div>
        </nav>   
          







                <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
            		<li class="text-center namaadmin">
                                <img src="../assets/img/logo2.png" class="user-image img-responsive logo_ngajeng" />                              
            		</li>
                  
                <li><a href="index.php"><i class="fa fa-book fa-3x"></i> Meja</a></li>
                <li><a href="index.php?halaman=menu"><i class="fa fa-cutlery fa-3x"></i> Menu</a></li>
                <li><a href="index.php?halaman=transaksi"><i class="fa fa-shopping-cart fa-3x"></i> Transaksi</a></li>
                <li><a href="index.php?halaman=member"><i class="fa fa-smile-o fa-3x"></i> Pelanggan</a></li>
                <li><a href="index.php?halaman=admin"><i class="fa fa-user fa-3x"></i> Admin</a></li>
                
                </ul>       
        </div>
        </nav>  
    

        <div id="page-wrapper" style="max-height: 500px !important;" >
            <div  id="page-inner" style="max-height: 500px !important;">
                <?php 
                    if (isset($_GET['halaman'])) 
                    {
                        if ($_GET['halaman']=='menu') {
                            include'menu.php';

                        }
                        elseif ($_GET['halaman']=='pesan') {
                            include'pesan.php';
                        }
                        elseif ($_GET['halaman']=='transaksi') {
                            include'transaksi.php';
                        }
                        elseif ($_GET['halaman']=='member') {
                            include'member.php';
                        }
                        elseif ($_GET['halaman']=='admin') {
                            include'admin.php';
                        }
                        elseif ($_GET['halaman']=='detail') {
                            include'detail.php';
                        }
                        
                    }

                    else{
                        include'meja.php';
                    }
                 ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
    <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
   
</body>
</html>
