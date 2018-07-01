<?php
$koneksi= new mysqli('localhost','root','','restorant');
$output = '';


$meja=$_POST["meja"];
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($koneksi, $_POST["query"]);
 $query = "
  SELECT * FROM pelanggan 
  WHERE nama_pelanggan LIKE '%".$search."%'
  OR alamat_pelanggan LIKE '%".$search."%' 
  OR no_telp_pelanggan LIKE '%".$search."%' 
 ";
}
else
{
 $query = "SELECT * FROM pelanggan ";
}
$result = mysqli_query($koneksi, $query);
if(mysqli_num_rows($result) > 0)
{

 $output .= '
  <div class="table">
   <table class="table table-bordered">
    <tr>
     <th>Nama</th>
     <th>Alamat</th>
     <th>No Telepon</th>
     <th>Aksi</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["nama_pelanggan"].'</td>
    <td>'.$row["alamat_pelanggan"].'</td>
    <td>'.$row["no_telp_pelanggan"].'</td>
    <td><form method="post">
    <a id="pilih" type="button" class="btn btn-success" data-toggle="modal" data-target="#pilihmember" 
      data-nama='.$row["nama_pelanggan"].'
      data-id='.$row["id_pelanggan"].'
      data-meja='.$meja.'
      >Pilih</a>

    </form></td>
   </tr>
  ';
 
 }

 echo $output;
}
else
{
 echo 'Data Not Found';
}


?>


<script type="text/javascript">
      $(document).on('click','#pilih',function(e){
                e.preventDefault();
                var id = $(this).data('id');
                $('.idyangdieksekusi').val(id);
                var meja = $(this).data('meja');
                $('.mejayangdieksekusi').val(meja);
            });
         $('.bukan_saya').click(function(){
           $('#pilihmember').modal('toggle');
            });
         $('.pilih_saya').click(function(){
            var url = "index.php?halaman=pesan&pilih=";
            var meja = $('.mejayangdieksekusi').val();
            var id = $('.idyangdieksekusi').val();
            window.location.href= url+id+'&nama_meja='+meja;
           });
</script>
<!--   
================================================PILIH MEMBER======================================================
-->

<div class="modal fade" id="pilihmember" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document"> 
    <div class="modal-content">
      <div class="modal-body">

          <input type="hidden" class="idyangdieksekusi">
          <input type="hidden" class="mejayangdieksekusi">
          <h4 align="center"><b>Yakin pilih ?</b></h4><hr>
          <div class="col-md-2"></div>
          <button type="button" class="btn btn-danger col-md-3 pilih_saya" name="ya" >YA</button>
          <div class="col-md-2"></div>
          <button type="button" data-dismiss="modal" class="btn btn-success col-md-3 bukan_saya" name="tidak">TIDAK</button>
          <div class="col-md-2"></div>
          <hr><br>
      

      </div>
    </div>
  </div>
</div>


<!--   
================================================PILIH MEMBER======================================================
-->



  <?php 
              
         ?>