<?php
session_start();
include '../../inc/inc.koneksi.php';
include '../../auth.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="../../files/js/jquery.min.js"></script>
      <script src="../../files/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../files/bootstrap/css/bootstrap.min.css">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sim.rsiypdhi.com</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link type="text/css" href="../../css/excite-bike/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.21.custom.min.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                    <a class="dropdown-toggle"  href="destroy_pasien.php">
                      <i class="fa fa fa-sign-out fa-fw"></i><i class="fa fa-table fa-fw"></i>Daftar Pasien Rawat Jalan
                    </a>
                    <li class="dropdown">
                         <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                             <i class="fa fa-user fa-fw"></i> <font color='red'><?php echo"$_SESSION[nama]"; ?></font> [<?php echo"$_SESSION[level]"; ?>] <i class="fa fa-caret-down"></i>
                         </a>
                         <ul class="dropdown-menu dropdown-user">
                             <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                             </li>
                             <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                             </li>
                             <li class="divider"></li>
                             <li><a href="../../logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a>
                             </li>
                         </ul>
                         <!-- /.dropdown-user -->
                     </li>

                <!-- /.dropdown -->
            </div>
                        <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                  <a class="navbar-brand" > <i class="glyphicon glyphicon-user"></i> <?php echo"$_SESSION[NAME]"; ?></a>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    <li>

                          <div class="panel panel-primary">
                              <div class="panel-heading">
                                  <div class="row">
                                      <div class="col-xs-3">
                                          <i class="fa fa-user fa-5x"></i>
                                      </div>
                                      <div class="col-xs-9 text-left">
                                          <div class="huge"><?php echo"$_SESSION[NO_RM]"; ?></div>
                                          <div ><?php echo"<b>$_SESSION[NAME]</b> ($_SESSION[JK])"; ?></div>
                                      </div>
                                      <div class="col-xs-12 text-left">
                                          <p><i class="fa fa-home"></i> <?php echo"$_SESSION[ADDRESS]"; ?></p>
                                      </div>
                                  </div>
                              </div>
                              <a href="?modulerajal=pasien">
                                  <div class="panel-footer">
                                      <span class="pull-left">View Details</span>
                                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                      <div class="clearfix"></div>
                                  </div>
                              </a>
                          </div>
                    </li>
                        <?php include 'menurajal.php'; ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <?php include 'contentrajal.php'; ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../vendor/raphael/raphael.min.js"></script>
    <script src="../../vendor/morrisjs/morris.min.js"></script>
    <script src="../../data/morris-data.js"></script>
    <!-- DataTables JavaScript -->
   <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
   <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
   <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->


    <script>
      $(document).ready(function() {
          $('#dataTables-example').DataTable({
              responsive: true
          });
          $("#tgl").datepicker({
                dateFormat:"dd-mm-yy",
                changeYear : true,
                changeMonth:true,
              });
    });
    </script>
</body>

</html>
