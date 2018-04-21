<?php
/*
include "inc/inc.koneksi.php";
include 'auth.php';
*/
$mod = $_GET['module'];


?>

<div class="collapse navbar-collapse navbar-ex1-collapse">
   <ul class="nav navbar-nav side-nav">

        <li <?php if ($mod=='home'){ echo "class='active'"; } ?>>
           <a href='?module=home'><i class="fa fa-fw fa-h-square"></i> Home</a>
       </li>
   <li <?php if ($mod=='pendaftaran'){ echo "class='active'"; } ?>>
           <a href='?module=pendaftaran' data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-wheelchair"></i> Pendaftaran</a>
      </li>
       <li <?php if ($mod=='tampildatapasienrajal'){ echo "class='active'"; } ?>>
           <a href='?module=tampildatapasienrajal' data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-wheelchair"></i> Rawat Jalan </a>
      </li>
       <li <?php if ($mod=='tampildatapasienranap'){ echo "class='active'"; } ?>>
           <a href='?module=tampildatapasienranap' data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-hospital-o "></i> Rawat Inap </i></a>
       </li>

   </ul>
</div>
