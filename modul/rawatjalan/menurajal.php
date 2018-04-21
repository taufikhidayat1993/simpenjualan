<?php
include "../../inc/inc.koneksi.php";
$modrajal = $_GET['modulerajal'];
include 'authrajal.php';

?>
<li <?php if ($modrajal=='diagnosa'){ echo "class='active'"; } ?>>
    <a href='?modulerajal=diagnosa'><i class="fa fa-stethoscope fa-fw"></i> Diagnosa</a>
</li>
<li <?php if ($modrajal=='tindakan'){ echo "class='active'"; } ?>>
    <a href='?modulerajal=tindakan'><i class="glyphicon glyphicon-edit  glyphicon-fw"></i> Tindakan</a>
</li>
<li <?php if ($modrajal=='lab'){ echo "class='active'"; } ?>>
    <a href='?modulerajal=lab'><i class="fa  fa-flask fa-fw"></i> Labolatorium</a>
</li>
<li <?php if ($modrajal=='rad'){ echo "class='active'"; } ?>>
    <a href='?modulerajal=rad'><i class="glyphicon glyphicon-file glyphicon-fw"></i> Radiologi</a>
</li>
