<!DOCTYPE html>
<?php 
    $koneksi= new mysqli('localhost','root','','restorant');
 ?>
<head>
      <meta charset="utf-8" />
    <title>Restorant</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <script>
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
                <a class="navbar-brand" href="index.html">W.O.Y Resto</a> 
            </div>
            <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> &nbsp; <a href="login.html" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
          


                <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
		<li class="text-center">
                    <img src="../assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
    <li><a href="index.php"><i class="fa fa-book fa-3x"></i> Pesan</a></li>
    <li><a href="index.php?halaman=menu"><i class="fa fa-cutlery fa-3x"></i> Menu</a></li>
    <li><a href="index.php?halaman=transaksi"><i class="fa fa-shopping-cart fa-3x"></i> Transaksi</a></li>
    <li><a href="index.php?halaman=member"><i class="fa fa-smile-o fa-3x"></i> Pelanggan</a></li>
    <li><a href="index.php?halaman=admin"><i class="fa fa-user fa-3x"></i> Admin</a></li>
                
                </ul>       
        </div>
        </nav>  
    

        <div id="page-wrapper" >
            <div  id="page-inner" style="height: 500px">
                <?php 
                    if (isset($_GET['halaman'])) 
                    {
                        if ($_GET['halaman']=='menu') {
                            include'menu.php';

                        }
                        elseif ($_GET['halaman']=='meja') {
                            include'meja.php';
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
                        elseif ($_GET['halaman']=='tambahmenu') {
                            include'tambahmenu.php';
                        }
                        elseif ($_GET['halaman']=='tambahmember') {
                            include'tambahmember.php';
                        }
                        elseif ($_GET['halaman']=='tambahmeja') {
                            include'tambahmeja.php';
                        }
                        elseif ($_GET['halaman']=='tambahadmin') {
                            include'tambahadmin.php';
                        }
                        elseif ($_GET['halaman']=='ubahadmin') {
                            include'ubahadmin.php';
                        }
                        elseif ($_GET['halaman']=='hapus') {
                            include'hapus.php';
                        }

                    }

                    else{
                        include'pesan.php';
                    }
                 ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/custom.js"></script>
   
</body>
</html>
