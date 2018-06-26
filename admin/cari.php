<div>
<?php
$koneksi= new mysqli('localhost','root','','restorant');
$output = '';
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
    <input type="hidden" value='.$row["id_pelanggan"].'></input>
    <botton id="pilih" class="btn btn-success">Pilih</botton></form></td>
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
</div>