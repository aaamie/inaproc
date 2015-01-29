<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>LPSE</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
				<?php 
					if(!empty($lpse)){
					$no=1;
					foreach ($lpse as $valuelpse) : ?>
					<!--<li><a href="<?php echo base_url()?>">Beranda</a></li>-->
					<li><a href="#">LPSE</a></li>
					<!--<li><a href="<?php echo base_url()?>lpse/detail/<?php echo $this->uri->segment(3)?>/<?php echo $d = $this->uri->segment(4)!='' ? $this->uri->segment(4)  : 0; ?>/<?php echo $d = $this->uri->segment(5)!='' ? $this->uri->segment(5)  : 0; ?>/<?php echo $valuelpse['id']?>"><?= $valuelpse['nama']?></a></li>-->
					<li><?php echo $valuelpse['nama']?></li>
					<?php endforeach;
					}?>
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

				   			<?php
				   			if(!empty($lpse)){
				   			 foreach ($listProv as  $value) : ?>
				   			<?php $selected= $value['kd_propinsi']==$this->uri->segment(3) ? 'selected="selected"' : '';  ?>
							<option value="<?php echo $value['kd_propinsi']?>" <?php echo $selected?>><?php echo $value['nama_propinsi']?></option>
							<?php endforeach;
							}?>
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
					if(!empty($lpse)){
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
							<!--<li><a href="#tab4" data-toggle="tab">Personil</a></li>-->
							<li><a href="#tab5" data-toggle="tab">Standar LPSE:2014</a></li>
							<li><a href="#tab6" data-toggle="tab">Status Server</a></li>
						</ul>
						<div class="tab-content no-border no-margin">
							<div class="tab-pane fade in active " id="tab1">
								<div class="row">
									<div class="col-md-3">
										
										<?php if($valuelpse['file_image']) {?>
										<img src="http://dataclient.net/lkpp-lpse/uploads/<?php echo $valuelpse['file_image']?>"  class="img-responsive img-center mt-10" >
									    <?php }else{?>
									    <img src="<?php echo base_url()?>images/no-image.png" width="113" class="img-responsive img-center mt-10">
									    <?php } ?>
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
													<td >Total Lelang</td><td>:</td><td><?php 
													echo getTotalLelang($valuelpse['id']);
													//echo $valuelpse['total_lelang']?></td></tr>
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
							
							<!--<div class="tab-pane fade" id="tab4">
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
							</div>-->

							<div class="tab-pane fade" id="tab5">
								<?php

								if($valuelpse['standarisasi']){

										echo str_replace(',','<br>',$valuelpse['standarisasi']);

									}else{
										echo "Data belum tersedia";
									}

									/*if($valuelpse['standarisasi']=='Ya'){

										$this->load->helper('engine');
										$standarisasi_list = json_decode($valuelpse['standarisasi_list'],true);

										if(count($standarisasi_list) > 0){
											foreach ($standarisasi_list as $value) {
											echo "- ".standarisasiList($value)."<br>";
											}
										}
									}else{
										echo "Data belum tersedia";
									}*/

								?>
							</div>


							<div class="tab-pane fade" id="tab6">
								Status server : 

								<?php 
							$lpseUrl  = getStatusServer($valuelpse['id']);
							if ($lpseUrl == true) {
									
									echo "<span style='color:green'><b>Online</b></span>";
								}else{
									
							        echo "<span style='color:red'><b>Offline</b></span>";
							       
								}

							?>

						
								

							</div>
						</div>							
					</div>
				
				</div>


				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
					<script type="text/javascript">
					      function initialize() {
					      	var myLatlng = new google.maps.LatLng(<?php echo  $valuelpse['lat']?>,<?php echo  $valuelpse['long']?>);

					        var mapOptions = {
					          center: { lat:<?php echo  $valuelpse['lat']?>, lng: <?php echo  $valuelpse['long']?>},
					          zoom: 17
					        };
					        var map = new google.maps.Map(document.getElementById('map-canvas'),
					            mapOptions);
					        var marker = new google.maps.Marker({
							      position: myLatlng,
							      map: map,
							      title: "<?php echo filter_var($valuelpse['nama'],FILTER_SANITIZE_STRING) ?>"
							  });

					        var infowindow = new google.maps.InfoWindow();
					        var marker;

							google.maps.event.addListener(marker, 'click', function() {

							
									infowindow.setContent('<h4 id="firstHeading" class="firstHeading"><?php echo filter_var($valuelpse["nama"], FILTER_SANITIZE_STRING)?></h4>'+
									          	'<p></p>'+
									          	'<p>Website : <a href="<?php echo $valuelpse["url"]?>">'+
										  		'<?php echo $valuelpse["url"]?></a></p>');
				            	//infowindow.setContent("Your content here");
				            	infowindow.open(map, this);
				        	}); 
					      }

					    google.maps.event.addDomListener(window, 'load', initialize);

					    </script>
					<style>
					.peta-lpse{
						background: none repeat scroll 0 0 #f7f7f7;
					    border: 1px solid #ddd;
					    height: 280px;
					    margin: 0 0 20px;
					}
					#map-canvas{
						width:100%;
						height:100%;
					}
</style>

				
				<div class="col-md-4">
					<h1 class="section-title-2 no-border">Peta Lokasi LPSE</h1> 
					
					<div class="peta-lpse">
						<div id="map-canvas">
						</div>
					</div>

				</div>
				<?php endforeach;
				}?>
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

