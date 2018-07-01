<?php

 $idnya = isset($_GET['param']) ? $_GET['param'] : null;

 if($idnya == null)

 {

  ?>

   <script type="text/javascript">

    var foo = "Hello";

    window.location.href = "?param=" + encodeURI(foo);

  <?php

 } else {


 echo"<script> alert('tes')</script>";

 }

?>

 </script>

