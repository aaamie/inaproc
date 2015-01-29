
<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>LPSE</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!--<li><a href="<?php echo base_url()?>">Beranda</a></li>-->
					<li>LPSE</li>
				</ol>
			</div>
		</div>
	</div>
</section>		
    
    <section class="slice bg-3 h-680">
        <div class="w-section">
            <div class="container">
				<div class="row mt-20 mb-20 no-margin hidden-sm hidden-xs">
			
				<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
				<script>
								function initialize() {
								  var myLatlng = new google.maps.LatLng(-6.2297465,106.829518);
								  
								  var mapOptions = {
									zoom: 5,
									scrollwheel: true,
									center: new google.maps.LatLng(-2.846267564815841, 116.0012915451526),
									//styles: [	{		"featureType":"landscape",		"stylers":[			{				"hue":"#F1FF00"			},			{				"saturation":-27.4			},			{				"lightness":9.4			},			{				"gamma":1			}		]	},	{		"featureType":"road.highway",		"stylers":[			{				"hue":"#0099FF"			},			{				"saturation":-20			},			{				"lightness":36.4			},			{				"gamma":1			}		]	},	{		"featureType":"road.arterial",		"stylers":[			{				"hue":"#00FF4F"			},			{				"saturation":0			},			{				"lightness":0			},			{				"gamma":1			}		]	},	{		"featureType":"road.local",		"stylers":[			{				"hue":"#FFB300"			},			{				"saturation":-38			},			{				"lightness":11.2			},			{				"gamma":1			}		]	},	{		"featureType":"water",		"stylers":[			{				"hue":"#00B6FF"			},			{				"saturation":4.2			},			{				"lightness":-63.4			},			{				"gamma":1			}		]	},	{		"featureType":"poi",		"stylers":[			{				"hue":"#9FFF00"			},			{				"saturation":0			},			{				"lightness":0			},			{				"gamma":1			}		]	}],
									disableDefaultUI: true
								  }
								  var map = new google.maps.Map(document.getElementById('peta_interactive'), mapOptions);
								  
								  var contentString = '<div id="content">'+
									  '<h4 id="firstHeading" class="firstHeading">LPSE</h4>'+
									  '<p><b>Layanan Pengadaan Secara Elektronik (LPSE)</b></p>'+
									  '<p>Website : <a href="http://eproc.lkpp.go.id/">'+
									  'https://eproc.lkpp.go.id</a></p>'+
									  '</div>';
									  
								  /*var infowindow = new google.maps.InfoWindow({
									  content: contentString
								  });*/
									var infowindow = new google.maps.InfoWindow();
								    var marker,i;
								    
								 <?php foreach ($lpseAll as  $value) : ?>
								 	<?php if( $value['lat']!='' &&  $value['lat']!=0 &&  $value['long']!='' && $value['long']!=0) {?>
	      							    marker = new google.maps.Marker({
		        							position: new google.maps.LatLng("<?php echo $value['lat']?>","<?php echo $value['long']?>"),
		        							map: map,
		        							title:'<?php echo filter_var($value["nama"], FILTER_SANITIZE_STRING)?>'
	      							  	});

	      								google.maps.event.addListener(marker, 'click', (function(marker, i) {
									        return function() {
									          infowindow.setContent('<h4 id="firstHeading" class="firstHeading"><?php echo filter_var($value["nama"], FILTER_SANITIZE_STRING)?></h4>'+
									          	'<p></p>'+
									          	'<p>Website : <a href="<?php echo $value["url"]?>">'+
										  		'<?php echo $value["url"]?></a></p>');
									          infowindow.open(map, marker);
									        }
									      })(marker, i));
	      							<?php } ?>
      							<?php endforeach?> 
      														  /*var marker = new google.maps.Marker({
									  position: myLatlng,
									  map: map,
									  title: 'LPSE'
								  });*/

								}

								google.maps.event.addDomListener(window, 'load', initialize);
							</script>
					<div class="col-md-12" id="peta_interactive">
					</div>
				</div>
				<div class="row">
					<form role="form" method="post" action="<?php echo base_url()?>lpse/searchAction">
						<div class="col-xs-12 col-sm-3 col-md-3 mb-5">

							<?php

					   		$listProv = curlAPI('prov'); 

					   		?>
				   		
						   <select class="form-control pil-prov" name='propinsi_id'>
								<option value=0>  Pilih Lokasi LPSE </option>
					   			<?php foreach ($listProv as  $value) : ?>
								<option value="<?php echo $value['kd_propinsi']?>" <?php echo $value['kd_propinsi']==$this->uri->segment(3) ? "selected='selected'" : "" ?> ><?php echo $value['nama_propinsi']?></option>
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
				
				<?php 

				$listProv = curlAPI('prov'); 
				$newListProv=array();
				if(count($listProv) > 0){
					
					   		foreach ($listProv as $key => $value) {
					   			$newListProv[$value['kd_propinsi']] = $value;
					   		}
				   		}

				?>
				<div class="row">
					<div class="col-md-12 mt-20">
						<table class="table table-bordered tb-blacklist table-lpse">
							<tbody>
								<tr class="text-center">
									<th>Kode LPSE</th><th>Provinsi</th><th>Nama LPSE</th><th class="text-center">Standarisasi</th><th class="text-center">Lelang</th><th class="text-center">Detail</th></tr>
								
								<?php 
								

								$no=1;
								if(count($lpse) > 0) {
								foreach ($lpse as $valuelpse) : ?>
								<?php 
								$stand=$valuelpse['standarisasi'];
								$stand2='';
								if($stand!=0){
									$stand2 = 'Ya';
								}
								else{
									$stand2 = 'Tidak';
								}

								?>
								<tr>
									<td><?php echo $valuelpse['id']?></td><td><?php echo $newListProv[$valuelpse['provinsi_id']]['nama_propinsi']?></td><td><?php echo $valuelpse['nama']?></td><td class="text-center"><?php echo $stand2?></td><td class="text-center"><?php echo getTotalLelang($valuelpse['id']);//echo $valuelpse['total_lelang']?></td><td class="text-center"><a href="<?php echo base_url()?>lpse/detail/<?php echo $this->uri->segment(3)?>/<?php echo $d = $this->uri->segment(4)!='' ? $this->uri->segment(4)  : 0; ?>/<?php echo $d = $this->uri->segment(5)!='' ? $this->uri->segment(5)  : 0; ?>/<?php echo $valuelpse['id']?>/" class="link-detail">Detail</a></td></tr>
								<?php 
								$no++;
								endforeach;
								}
								?>

							</tbody>
						</table>
					</div>
				</div>
				
				<div class="row no-margin">
					<ul class="pagination pull-right">
						<?php echo $pagging?>
					</ul> 
				</div>
				
			</div>
        </div>
    </section>