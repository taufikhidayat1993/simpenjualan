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
                                <li class="active"><a href="#home" data-toggle="tab">DIAGNOSA</a>
                                </li>
                                <li><a href="#profile" data-toggle="tab">RIWAYAT PENYAKIT</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">TULIS RESEP</a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                  <h4></h4>

                                          <div id="input_diagnosa">
                                  					<?php include "inputdiagnosa.php"; ?>
                                          </div>

                                  <div id="tampil_data_diagnosa">
                                    <?php //include "tampildatadiagnosa.php"; ?>
                                  </div>

                                </div>
                                <div class="tab-pane fade" id="profile">
                                  <h4></h4>
                                  <div id="tampil_data_riwayat">
                                  <?php //include 'tampildatariwayatpenyakit.php'; ?>
                                </div>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                  <h4></h4>
                                  <div id="tampil_resep">
                                  <?php // include 'tampilresep.php'; ?>
                                  </div>
                              </div>

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
          </div>
          <!-- /.row -->
          <script type="text/javascript">
          				$("#tampil_data_diagnosa").load('../../modul/rawatjalan/diagnosa/tampildatadiagnosa.php');
          				$("#tampil_data_riwayat").load('../../modul/rawatjalan/diagnosa/tampildatariwayatpenyakit.php');
          	 </script>
