<!DOCTYPE html>
<?php 

session_start();
$koneksi= new mysqli('localhost','root','','restorant');

?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login W.O.Y Resto</title>
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/custom.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br /><br />
        <h2> W.O.Y RESTO</h2>

        <h5>( Wandas Opit Yudiana )</h5>
        <br />
      </div>
    </div>
    <div class="row ">

      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>   Login </strong>  
          </div>
          <div class="panel-body">
            <form role="form" method="POST">
             <br />
             <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
              <input type="text" class="form-control" placeholder="Username " name="user" />
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
              <input type="password" class="form-control"  placeholder="Password" name="pass" />
            </div>
            <hr>
            <button class="btn btn-primary" name="login">Login Now</button>

          </form>

          <?php 
              if (isset($_POST['login'])) {
                  $ambil=$koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password='$_POST[pass]'");
                  $yangcocok = $ambil->num_rows;
                  if($yangcocok==1){
                        $_SESSION['admin']=$ambil->fetch_assoc();
                        echo "<div class='alert alert-info'>LOGIN SUKSES</div>";
                        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                  }
                  else{
                        echo "<div class='alert alert-danger'>LOGIN GAGAL</div>";
                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                  }
                 }

                 mysqli_close($koneksi);
           ?>

        </div>

      </div>
    </div>


  </div>
</div>



<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script>



</body>
</html>
