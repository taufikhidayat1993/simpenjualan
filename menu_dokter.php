	<div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            <li class="sidebar-search-wrapper">
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                             
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            </li>
							 <li class="heading">
                                <h3 class="uppercase">Daftar Menu</h3>
                            </li>
							<?php if ($mod=='home'){ 
							$open= "start active open";$arrow="selected"; }else{$open= ""; $arrow="";
							}if ($mod=='pendaftaran'){ 
							$open1= "start active open";$arrow1="selected"; }else{$open1= ""; $arrow1="";
							}if ($mod=='pendaftaran'){ 
							$open1= "start active open";$arrow1="selected";$active="active"; }else{$open1= ""; $arrow1="";
							}if ($mod=='tampildatapasienrajal'){$open2= "start active open";$arrow2="selected"; }
							else{$open2= ""; $arrow2="";
							} ?> 
                            <li class="nav-item <?php echo $open; ?>" >
                                <a href="?module=home" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Home</span>
                                  
									<span class="<?php echo $arrow ?>"></span>
                                </a>
                              
                            </li>
							<li class="nav-item <?php echo $open1; ?>">
                                <a href="javascript:;">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Operasional</span>
                                  
									<span class="arrow"></span>
                                </a>
									<ul class="sub-menu">
						<li >
							<a href="javascript:;">
							<i class="icon-settings"></i> Informasi<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
									<i class="icon-user"></i>
									Sample Link 1 <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="#"><i class="icon-power"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="icon-paper-plane"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="icon-star"></i> Sample Link 1</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-camera"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="icon-link"></i> Sample Link 2</a>
								</li>
								<li>
									<a href="#"><i class="icon-pointer"></i> Sample Link 3</a>
								</li>
							</ul>
						</li>
						<li class="<?php echo $active; ?>">
							<a href="?module=pendaftaran">
							<i class="icon-bar-chart"></i>
							Pendaftaran R. Jalan </a>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-globe"></i> Rawat Jalan <span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="?module=daftarrawatjalan"><i class="icon-tag"></i>Daftar Rawat Jalan</a>
								</li>
								<li>
									<a href="#"><i class="icon-pencil"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="icon-graph"></i> Sample Link 1</a>
								</li>
							</ul>
						</li>
						
					</ul>
				
                              
                            </li>
								<li class="nav-item <?php echo $open2; ?>" >
                                <a href="?module=tampildatapasienrajal">
                                    <i class="icon-direction"></i>
                                    <span class="title">Rawat Jalan</span>
                                  
									<span class="<?php echo $arrow2; ?>"></span>
                                </a>
                              
                            </li>
							
                            <li class="heading">
                                <h3 class="uppercase">Features</h3>
                            </li>
      
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>