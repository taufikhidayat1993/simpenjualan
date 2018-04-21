    <nav class="quick-nav">
            <a class="quick-nav-trigger" href="#0">
              <span aria-hidden="true"></span>
            </a>
            <ul>
                <li>
                    <a href="?module=tampildatapasienrajal&act=tindakan"  class="active">
                        <span>Tindakan</span>
                        <i class="icon-basket"></i>
                    </a>
                </li>
                <li>
                    <a href="?module=tampildatapasienrajal&act=diagnosa">
                        <span>Diagnosa</span>
                        <i class="icon-users"></i>
                    </a>
                </li>
                <li>
                    <a href="?module=tampildatapasienrajal&act=lab" target="_blank">
                        <span>Laboratorium</span>
                        <i class="icon-user"></i>
                    </a>
                </li>
                <li>
                    <a href="?module=tampildatapasienrajal&act=rad" target="_blank">
                        <span>Radiologi</span>
                        <i class="icon-graph"></i>
                    </a>
                </li>
            </ul>
            <span aria-hidden="true" class="quick-nav-bg"></span>
        </nav>
		 <div class="quick-nav-overlay"></div>
 <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                      
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="?page=home">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                 <li>
                                    <a href="#">Rawat Jalan</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                            </ul>
                           
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                      
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
						    <h1 class="page-title"> Rawat Jalan
                            <small>Daftar Pasien Rawat Jalan</small>
                        </h1>
                        
<div class="row">

                    <div class="panel panel-default">
                      <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">TINDAKAN</a>
                                </li>


                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                  <h4></h4>

                                  <div class="col-lg-5">
                                      <div class="panel panel-success">
                                          <div class="panel-heading">
                                              <i class="glyphicon glyphicon-edit glyphicon-fw"></i> INPUT TINDAKAN
                                          </div>
                                          <!-- /.panel-heading -->
                                          <div id="input_tindakan">
                                            <?php include "inputtindakan.php"; ?>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /.col-lg-4 -->
                                  <?php include 'tampildatatindakan.php'; ?>

                                </div>


                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
          </div>
		  </div>
          <!-- /.row -->
