<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>LPSE</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!--<li><a href="<?php echo base_url()?>">Beranda</a></li>-->
					<li><a href="<?php echo base_url()?>lpse">LPSE</a></li>
					<li>Profil LPSE Kabupaten Nagan Raya</li>
				</ol>
			</div>
		</div>
	</div>
</section>
    
<section class="slice bg-3 h-680">
	<div class="w-section">
		<div class="container">
			<div class="row">
				<?php

				$listProv = curlAPI('prov'); 

				$newListProv=array();
				if(count($listProv) > 0){
					
					   		foreach ($listProv as $key => $value) {
					   			$newListProv[$value['kd_propinsi']] = $value;
					   		}
				   		}

				?>

				
				<form role="form" method="post" action="<?php echo base_url()?>lpse/searchAction">
					<div class="col-xs-12 col-sm-3 col-md-3 mb-5">
					  <select name="propinsi_id" class="form-control">
				   			<option value='0'> Pilih Lokasi LPSE </option>

				   			<?php foreach ($listProv as  $value) : ?>
				   			<?php $selected= $value['kd_propinsi']==$this->uri->segment(3) ? 'selected="selected"' : '';  ?>
							<option value="<?php echo $value['kd_propinsi']?>" <?php echo $selected?>><?php echo $value['nama_propinsi']?></option>
							<?php endforeach?>
					   </select>
				   </div>
				   <div class="input-group col-xs-12 col-sm-9 col-md-9 pl-15 pr-15">
						<input type="text" class="form-control" name="search" placeholder="Nama LPSE">
						<div class="input-group-btn">
							<button type="submit" class="btn bg-2"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
						</div>
				   </div>
				</form>
			</div>
			
			<div class="row mb-20 mt-40">

				<?php 

					$no=1;
					foreach ($lpse as $valuelpse) : ?>
				<div class="col-md-8">
				<h1 class="section-title-2 no-border"><?php echo $valuelpse['nama']?></h1>
				
				<!-- Tabs-->
				
					
					<div class="tabs">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-star"></i>Deskripsi</a></li>
							<li><a href="#tab2" data-toggle="tab">Alamat</a></li>
							<li><a href="#tab3" data-toggle="tab">Helpdesk</a></li>
							<!-- <li><a href="#tab4" data-toggle="tab">Personil</a></li> -->
							<li><a href="#tab5" data-toggle="tab">Standar LPSE:<?php echo date('Y')?></a></li>
							<li><a href="#tab6" data-toggle="tab">Status Server</a></li>
						</ul>
						<div class="tab-content no-border no-margin">
							<div class="tab-pane fade in active " id="tab1">
								<div class="row">
									<div class="col-md-3">

									 <img src="http://dataclient.net/lkpp-lpse/uploads/<?php echo $valuelpse['file_image']?>" width="113" class="img-responsive img-center mt-10">
										<?php if(file_exists('/uploads/'.$valuelpse['file_image'])) {?>
										<!-- <img src="<?php echo base_url()?>uploads/<?php echo $valuelpse['file_image']?>" width="113" class="img-responsive img-center mt-10"> -->
									    <?php }else{?>
<!-- 									    <img src="<?php echo base_url()?>images/no-image.png" width="113" class="img-responsive img-center mt-10">
 -->									    <?php } ?>
									    <?php echo $valuelpse['nama']?> 
									    <?php if($valuelpse['standarisasi']=='Ya'){
									    	echo "<img width='16px' src='".base_url()."images/standarisasi.png'>";
									    }  ?>
									</div>
									<div class="col-md-8">
										<table class="table tb-lpse">
											<tbody>
												<tr>
													<td>Nama</td><td>:</td><td><?php echo $valuelpse['nama']?></td></tr>
												<tr>
													<td>Provinsi</td><td>:</td><td><a href="#"><?php echo $newListProv[$valuelpse['provinsi_id']]['nama_propinsi']?></a></td></tr>
												<tr>
													<td>Url</td><td>:</td><td><a href="<?php echo $valuelpse['url']?>"><?php echo $valuelpse['url']?></a></td></tr>
												<tr>
													<td >Total Lelang</td><td>:</td><td><?php echo $valuelpse['total_lelang']?></td></tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>	
							
							<div class="tab-pane fade" id="tab2">
								<?php echo strip_tags($valuelpse['alamat'],"<div>") ?>
							</div>
							
							<div class="tab-pane fade" id="tab3">
								<?php echo !isset($valuelpse['helpdesk']) || $valuelpse['helpdesk']!='' || $valuelpse['helpdesk']!=null ?  $valuelpse['helpdesk'] : "Tidak terdapat data Helpdesk";?>
							</div>
							
							<!-- <div class="tab-pane fade" id="tab4">
								<div class="col-md-3 col-sm-3 col-xs-12">
									<img src="<?php echo base_url()?>images/no-image.png" class="img-responsive img-center mt-10">
								</div>
								<div class="col-md-8 col-sm-3 col-xs-12">
									<?php echo !isset($valuelpse['anggota']) || $valuelpse['anggota']!='' || $valuelpse['anggota']!=null ?  $valuelpse['anggota'] : "Tidak terdapat data Personil"; ?>
									<table class="table tb-lpse">
										<tbody >
											<tr>
												<td>Peter Sondakh</td></tr>
											<tr>
												<td>Mahmud Salim</td></tr>
											<tr>
												<td>Jero Wacik</td></tr>
											<tr>
												<td>Hendro Priyono</td></tr>
											<tr>
												<td>Ibas Yudhoyono</td></tr>
											<tr>
												<td>Andi Malaranggeng</td></tr>
										</tbody>
									</table> 
								</div>
							</div> -->

							<div class="tab-pane fade" id="tab5">
								<?php

									if($valuelpse['standarisasi']){
										
										$this->load->helper('engine');
										$standarisasi_list = json_decode($valuelpse['standarisasi'],true);
										echo $valuelpse['standarisasi'];

										if(count($standarisasi_list) > 0){
											foreach ($standarisasi_list as $value) {
											echo "- ".standarisasiList($value)."<br>";
											}
										}
									}else{
										echo "Data belum tersedia";
									}
									
								?> 
							</div>


							<div class="tab-pane fade" id="tab6">
								Status server : 
								<?php
									// if($valuelpse['status_server']=='Aktif'){
									// 	echo "<span style='color:green'><b>Aktif</b></span>";										
									// }else{
									// 	echo "<span style='color:red'><b>Tidak Aktif</b></span>";
									// }

							

								if (filter_var($valuelpse['url'], FILTER_VALIDATE_URL) === FALSE) {
								   
									 echo "<span style='color:red'><b>Tidak Aktif</b></span>";
								
								}else{
									 ini_set("default_socket_timeout","05");
							         set_time_limit(5);
							         $f=fopen($valuelpse['url'],"r");
							         $r=fread($f,1000);
							         fclose($f);
							         if(strlen($r)>1) {
							          echo "<span style='color:green'><b>Aktif</b></span>";
							         }
							         else {
							          echo "<span style='color:red'><b>Tidak Aktif</b></span>";
							         }	
								}

								?>
							</div>
						</div>							
					</div>
				
				</div>
				
				<div class="col-md-4">
					<h1 class="section-title-2 no-border">Peta Lokasi LPSE</h1> 
					<div class="peta-lpse">
							<!-- 
							<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo  $valuelpse['lat']?>,<?php echo  $valuelpse['long']?>&zoom=11&size=360x280">
							 -->

							<iframe width="360" height="280" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo  $valuelpse['lat']?>,<?php echo  $valuelpse['long']?>&hl=es;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?q=<?php echo  $valuelpse['lat']?>,<?php echo  $valuelpse['long']?>&hl=es;z=14&amp;output=embed" style="color:#0000FF;text-align:left" target="_blank"></a></small>
	
<!-- 						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4295599860816!2d106.799705!3d-6.2069330000000065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6b9f15bedbb%3A0xf5285b3de18846ed!2sLayanan+Pengadaan+Secara+Elektronik+(LPSE)+Kementerian+Kehutanan+Republik+Indonesia!5e0!3m2!1sid!2sid!4v1410482948834" width="100%" height="100%" frameborder="0" style="border:0"></iframe>
 -->					</div>
				</div>
				<?php endforeach?>
			</div>	
		</div>
	</div>
</section>

<section class="slice bg-3">
	<div class="w-section inverse blog-grid">
		<div class="container">
			
		</div>
	</div>
</section>