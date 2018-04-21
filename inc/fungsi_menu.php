<?php
			  function fungsiMenu($user,$top) {
				  $pendaftaran="?module=pendaftaran";
				  $daftarrjalan="?module=daftarrawatjalan";
				  $pemeriksaan="?module=pemeriksaan";
				  $laboratorium="?module=laboratorium";
				  $radiologi="?module=radiologi";
				  $diagnosa="?module=diagnosa";
				  if($top=='top'){
					$first="classic-menu-dropdown";
					$sub="dropdown-menu pull-left";
				  }else{
					  	$first="nav-item";
					$sub="sub-menu";
		           $class="class=''";
				  }
        if($user=='operator'){
			$menu='<li class="classic-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
					Rawat Jalan<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu pull-left">
						<li>
							<a href="'.$pendaftaran.'">
							<i class="fa fa-bookmark-o"></i> Pendaftaran R. Jalan </a>
						</li>
						<li>
							<a href="'.$daftarrjalan.'">
							<i class="fa fa-user"></i> Daftar Pasien R. Jalan </a>
						</li>
					
					</ul>
				</li>';	
		}else if($user=='admin'){
			$menu='<li class="classic-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
					Rawat Jalan<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu pull-left">
						<li>
							<a href="'.$pendaftaran.'">
							<i class="fa fa-bookmark-o"></i> Pendaftaran R. Jalan </a>
						</li>
						<li>
							<a href="'.$laboratorium.'">
							<i class="fa fa-hospital-o"></i> Laboratorium </a>
						</li>
						<li>
							<a href="'.$radiologi.'">
							<i class="fa fa-hospital-o"></i> Radiologi</a>
						</li>
						<li>
							<a href="'.$diagnosa.'">
							<i class="fa fa-user-md"></i> Diagnosa</a>
						</li>
						<li>
							<a href="'.$daftarrjalan.'">
							<i class="fa fa-user"></i> Daftar Pasien R. Jalan </a>
						</li>
					
					</ul>
				</li>';
		}else if($user=='dokter'){
			$menu='<li class="classic-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
					Rawat Jalan<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu pull-left">
						<li>
							<a href="'.$pemeriksaan.'">
							<i class="fa fa-bookmark-o"></i> Pemeriksaan </a>
						</li>
					
					
					</ul>
				</li>';
		}else if($user=='rjalan'){
			$menu='<li class="'.$fist.'">
					<a data-toggle="dropdown" '.$class.' href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
					Rawat Jalan<i class="fa fa-angle-down"></i>
					</a>
					<ul class="'.$sub.'">
					    <li>
							<a href="'.$pemeriksaan.'">
							<i class="fa fa-bookmark-o"></i> Pemeriksaan </a>
						</li>
						<li>
							<a href="'.$pemeriksaan.'">
							<i class="fa fa-recycle"></i> Radiologi </a>
						</li>
					
					
					</ul>
				</li>';
		}else{
			$menu='<li class="classic-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
					Menu Dalam Perbaikan<i class="fa fa-angle-down"></i>
					</a></li>';
		}
        return $menu;
    }
	?>