<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Pengadaan</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url()?>/pengadaan">Pengadaan</a></li>
					<li>Detail Pengadaan</li>
				</ol>
			</div>
		</div>
	</div>
</section>		

<section class="slice bg-3">
	<div class="w-section inverse blog-grid">
		<div class="container">
			<div class="row">
				<div class="col-md-8 mb-20">

					<?php

					$this->load->helper('engine');
					$this->load->helper('dateIndo');
					// echo "<pre>";
					// print_r($pengadaan);
					// echo "</pre>";
					 ?>
					<div class="col-md-12 header-pengadaan-detail">
						<div class="row no-margin">
							<div class="col-md-12 col-xs-12">
								<?php  $lpse_id = $this->uri->segment(3) ?>
								<h1><?php echo 'History Status Server '. str_replace('-', ' ', $this->uri->segment(4)) ?></h1>
							</div>
						</div>
						<!-- Pengumuman -->
						
					</div>
					
					<div class="clearfix"></div>
					
					<style>
						th , tr, td {
							padding:5px;
							width:5%;
						}
					</style>
					<table border='1'>
						
						<?php 

						if(count($status) > 0){
								echo "<tr style='color:white'>
							<th style='background-color:#B6B6B4'>Jam</th><th style='background-color:#B6B6B4'>Status</th>
						</tr>";
								foreach ($status as $value) {
									# code...
								?>
								<tr>
									<td><?php echo $value['time']?></td><td>
									<?php
										if($value['status']==1){
											echo "<span style='color:green'><b>Online</b></span>";
										}else{
											echo "<span style='color:red'><b>Offline</b></span>";
										}
									?>
										
								</td>
								</tr>
								<?php }

							}else{
								echo "Mohon maaf, belum ada history status server untuk LPSE ini";
							}	
						?>
					</table>
	
				</div>
				
				<div class="col-md-4 section-right">
					<!-- <div class="server-lpse"> -->
						<!-- <div class="row">
							<div class="col-md-3 col-xs-12">

								<?php 

										$cekImg = getFileImage(lpseName($lpse_id),$lpse_id);
										if($cekImg){
											$img = "http://dataclient.net/lkpp-lpse/uploads/".$cekImg;
										}else{
											$img = base_url()."images/no-image.png ";
										}?>


									<img alt="" src="<?php echo $img ?>"  class="img-responsive img-center mt-10" style="width:80px;height:80px">
							
							</div>
							<div class="col-md-9 col-xs-12">
								<a href="<?php echo base_url()?>pengadaan/index/null/0/null/null/null/null/<?php echo $lpse_id?>" class="link-server"><?php echo word_limiter(lpseName($lpse_id),3)?></a>
							</div>
						</div> -->
						
					<!-- 	<ul>
							<?php 
							$lpseUrl  = getStatusServer($lpse_id);
							if ($lpseUrl == true) {
									
									echo '<li><label class="point-server" style="background:green;">&nbsp;</label>Server Online</li>';
								}else{
									
							           echo '<li><label class="point-server" style="background:red;">&nbsp;</label>Server Offline</li>';
							       
								}

							?>
							
							<li>60 menit yang lalu</li>
							<li><a href="#">History status Server&raquo;</a></li>
							<li>Cek status server tiap 60 menit</li>
						</ul>
						 -->
						<!-- <h5>Total 1023 Pengadaan</h5>
						<h5>Aktif 4 Pengadaan</h5> -->
					<!-- </div> -->

					<?php

					// echo "<pre>";
					// print_r($syarat);
					// echo "</pre>";

					?>
					
					<h3 class="section-title-2 mb-0 no-border">Peta Lokasi LPSE</h3> 
					<?php
							$map = lpseMap($lpse_id);
						?>
					<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
					<script type="text/javascript">
					      function initialize() {
					      	var myLatlng = new google.maps.LatLng(<?php echo $map['lat']?>,<?php echo $map['long']?>);

					        var mapOptions = {
					          center: { lat:<?php echo $map['lat']?>, lng: <?php echo $map['long']?>},
					          zoom: 17
					        };
					        var map = new google.maps.Map(document.getElementById('map-canvas'),
					            mapOptions);
					        var marker = new google.maps.Marker({
							      position: myLatlng,
							      map: map,
							      title: "<?php echo filter_var(lpseName($lpse_id),FILTER_SANITIZE_STRING) ?>"
							  });

					        var infowindow = new google.maps.InfoWindow();
					        var marker;

							google.maps.event.addListener(marker, 'click', function() {

							
									infowindow.setContent('<h4 id="firstHeading" class="firstHeading"><?php echo filter_var(lpseName($lpse_id),FILTER_SANITIZE_STRING) ?></h4>'+
									          	'<p></p>'+
									          	''+
										  		'');
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

					<div class="peta-lpse">
						<div id="map-canvas">
						</div>
					</div>

					
					<h3 class="section-title-2">Pengadaan Terbaru</h3>
					<!-- <?php echo  $map['lat']?>,<?php echo  $map['long']?> -->
					<ul id="pengadaan-baru">

						<?php foreach ($pengadaanTerbaru as $detailTerbaru) : ?>


						<li>
							<a href="<?php echo base_url()?>pengadaan/detail/<?php echo $detailTerbaru->lls_id?>/<?php echo $detailTerbaru->pkt_id?>/<?php echo rawurlencode($detailTerbaru->dtj_tglawal)?>"><?php echo $detailTerbaru->pkt_nama?></a>
							<label>Pagu: Rp. <?php echo number_format($detailTerbaru->pkt_pagu);?></label>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

