
<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Pengadaan</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!-- <li><a href="<?php echo base_url()?>">Beranda</a></li> -->
					<li>Pengadaan</li>
				</ol>
			</div>
		</div>
	</div>
</section>	
<!-- -->
    
<section class="slice bg-3 pencarian_detail">
	<div class="w-section">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-5">
					<h3>Pencarian Detail</h3>
				</div>
				<div class="col-md-4 col-sm-7">
					<div class="btn-group pull-right view-grid">
					  <button class="btn active2" disabled>Tampilkan Berdasarkan</button>
					  <button type="button" class="btn btn-default" onclick="fadeList()"><span class="glyphicon glyphicon-th-list"></span></button>
					  <button type="button" class="btn btn-default" onclick="fadeBox()"><span class="glyphicon glyphicon-th-large"></span></button>
					</div>
				</div>
			</div>
			<form role="form" method="post" action="<?php echo base_url()?>pengadaan/search">
				<div class="row bg-grey1 box-search-home no-margin">
					<div class="slct-srch-detail">
					<?php
				   		$listProv = curlAPI('prov'); 
				   	?>
		
				   <select name="propinsi_id" class="form-control">
				   			<option value="null">Pilih Lokasi LPSE</option>
				   			<?php foreach ($listProv as  $value) : ?>
							<option value="<?php echo $value['kd_propinsi']?>"><?php echo $value['nama_propinsi']?></option>
							<?php endforeach?>
					   </select>
				   </div>
				   <div class="slct-srch-detail">

				   	<?php

				   		$listInstansi = curlAPI('instansi'); 
				   	?>

					   <select name="instansi" class="form-control">
					   	<option value="0">Pilih Instansi (KLDI)</option>
					   		<?php foreach ($listInstansi as  $value) : ?>
							<option value="<?php echo $value['kd_instansi']?>"><?php echo $value['nama_instansi']?></option>
						<?php endforeach?>
					   </select>
				   </div>
				   <div class="slct-srch-detail">
					   <select name="kgr_id" class="form-control">
							<option value="null">Pilih Kategori</option>
							<?php foreach ($kategori as $valueKat) : ?>
							<?php $selected = $this->uri->segment(4)==$valueKat->id ? "selected='selected'" : '' ?>
							<option value="<?php echo $valueKat->id?>" <?php echo $selected?>><?php echo $valueKat->title?></option>
							<?php endforeach?>
					   </select>
				   </div>
				   <div class="slct-srch-detail">
					   <select name="pkt_hps" class="form-control">
							<option value="null">Pilih Nilai HPS</option>
							<?php foreach ($nilaiHps as $key => $valueHps) : ?>
							<?php $selected = $this->uri->segment(5)==$key ? "selected='selected'" : '' ?>
							<option value="<?php echo $key?>"  <?php echo $selected?>> <?php echo $valueHps?></option>
							<?php endforeach?>
						
					   </select>
				   </div>
				   <div class="slct-srch-detail no-margin">
					   <select name="kls_id" class="form-control">
					   	<option value="null">Pilih Kualifikasi</option>
					   	<?php foreach ($kualifikasi as $valueKul) : ?>
					   	<?php $selected = $this->uri->segment(6)==$valueKul->id ? "selected='selected'" : '' ?>
							<option value="<?php echo $valueKul->id?>" <?php echo $selected?>><?php echo $valueKul->title?></option>
						<?php endforeach?>
					   </select>
				   </div>
				   
				   <div class="clearfix"></div>
				   
				   <div class="kunci-pencarian">
						<div class="slct-srch-detail"> 
							<h4>Kata Kunci</h4>
						</div>
						<div class="slct-srch-detail"> 
							<input type="text" class="form-control" name="pkt_nama" placeholder="Nama" value="<?php echo $this->uri->segment(7)!="null" ? rawurldecode($this->uri->segment(7)) : ''; ?>">
						</div>
						<div class="slct-srch-detail"> 
							<input type="text" class="form-control" name="satuan_kerja" placeholder="Satuan Kerja" value="<?php echo $this->uri->segment(8)!="null" ? rawurldecode($this->uri->segment(8)) : ''; ?>">
						</div>
						<div class="slct-srch-detail"> 
							<?php $lpse_id = ($this->uri->segment(9)!='null' && $this->uri->segment(9)!='') ? lpseName($this->uri->segment(9)).' - '.$this->uri->segment(9) : ''?>
							<input type="text" class="form-control" name="lpse_id" id="autoLPSE" placeholder="LPSE" value="<?php echo $lpse_id?>">
						</div>
						<div class="slct-srch-detail no-margin">
							<button type="submit" class="btn bg-2 col-xs-12"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
						</div>
					</div>
				</div>
			</form>
			<div class="clearfix"></div>
			<div class="line-clear"></div>
		</div>
	</div>
</section>


<?php

if($this->session->userdata('berdasarkan')=='kategori') { 
?>
<section class="search-custom">
	<div class="container">
		<div class="breadcrumb-sub">
			<a href="#" class="active">Pengadaan</a> &raquo; <a href="#">Berdasar Kategori</a> <!-- &raquo; Pengadaan Barang -->
		</div>
		
			<ul class="pencarian-kategori">

				<?php foreach ($kategori as  $value) : ?>
				<?php $active = $this->uri->segment(4)==$value->id ? "class='active'" : '' ?>
<!-- 				<li class="col-md-4 col-sm-6 no-margin"><a href="#" class="active">
 -->
				<li class="col-md-4 col-sm-6 no-margin"><a href="<?php echo base_url()?>pengadaan/index/null/<?php echo $value->id?>/null/null/null/null/null" <?php echo $active?>>
 					<h4><?php echo  $value->title?></h4>
					<span>Total <b><?php echo totalPengadaanByKategori($value->id) ?></b> Pengadaan</span>
					</a>
				</li>
				<?php endforeach?>
			</ul>
			<div style="clear:both"></div>
			<hr style="border:0.08em solid #eee">
		</div>
</section>
<!-- / 3 Nov 2014 -->
<?php
}elseif($this->session->userdata('berdasarkan')=='hps') { 
?>

<section class="search-custom">
	<div class="container">
		<div class="breadcrumb-sub">
			<a href="#" class="active">Pengadaan</a> &raquo; <a href="#">Berdasar HPS</a>
		</div>
		
			<ul class="pencarian-kategori">

				<?php 

				foreach ($nilaiHps as  $key => $value) : ?>
				<?php $active = $this->uri->segment(5)==$key ? "class='active'" : '' ?>
				<li class="col-md-4 col-sm-6 no-margin"><a href="<?php echo base_url()?>pengadaan/index/null/null/<?php echo $key?>/null/null/null/null" <?php echo $active?>>
 					<h4><?php echo  $value?></h4>
					<span>Total <b><?php echo totalPengadaanByHps($key) ?></b> Pengadaan</span>
					</a>
				</li>
				<?php endforeach?>
			</ul>
			<div style="clear:both"></div>
			<hr style="border:0.08em solid #eee">
		</div>
</section>
<!-- / 3 Nov 2014 -->
<?php
}elseif($this->session->userdata('berdasarkan')=='kualifikasi') { 
?>

<section class="search-custom">
	<div class="container">
		<div class="breadcrumb-sub">
			<a href="#" class="active">Pengadaan</a> &raquo; <a href="#">Berdasar Kualifikasi</a>
		</div>
		
			<ul class="pencarian-kategori">

				<?php 

				foreach ($kualifikasi as   $value) : ?>
				<?php $active = $this->uri->segment(7)==$value->id ? "class='active'" : '' ?>
				<li class="col-md-4 col-sm-6 no-margin"><a href="<?php echo base_url()?>pengadaan/index/null/null/null/<?php echo $value->id?>/null/null/null" <?php echo $active?>>
 					<h4><?php echo  $value->title?></h4>
					<span>Total <b><?php echo totalPengadaanByKualifikasi($value->id) ?></b> Pengadaan</span>
					</a>
				</li>
				<?php endforeach?>
			</ul>
			<div style="clear:both"></div>
			<hr style="border:0.08em solid #eee">
		</div>
</section>
<!-- / 3 Nov 2014 -->
<?php } ?>
	
<section id="pengadaan_box">
        <div class="w-section inverse">
            <div class="container">
                <div class="row">

                	<?php 	

                	// echo "<pre>";
                	// print_r($pengadaan);
                	// echo "</pre>";
    
                	foreach ($pengadaan as $detail) :  ?>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="w-box product">
							<div class="box-lpse-bt">
								<div class="col-md-4 box-img">
									<?php //echo substr($detail->lls_id,count($detail->lls_id)-4).'.jpg';
										$lpse_id = substr($detail->lls_id,count($detail->lls_id)-4);
									?>

										<?php 

										$cekImg = getFileImage(lpseName($lpse_id),$lpse_id);
										if($cekImg){
											$img = "http://dataclient.net/lkpp-lpse/uploads/".$cekImg;
										}else{
											$img = base_url()."images/no-image.png ";
										}?>


									<img alt="" src="<?php echo $img ?>" class="img-responsive img-center">
								</div>
								<h5><?php echo word_limiter(lpseName($lpse_id),3)?></h5>
								<h3>Nilai HPS : </h3>
								<h4>Rp <?php echo number_format($detail->pkt_hps); ?></h4>
							</div>
							<p >
								<?php echo word_limiter($detail->pkt_nama,5)?>
							</p>
							<br/>
							<p>
								Pengumuman Lelang : <?php echo dateIndo(date('Y-m-d',strtotime($detail->dtj_tglawal)) )?></P>
							
							<div class="w-footer">
								<a href="<?php echo base_url()?>pengadaan/detail/<?php echo $detail->lls_id?>/<?php echo $detail->pkt_id?>/<?php echo rawurlencode($detail->dtj_tglawal)?>" class="btn btn-detail">Detail</a>
								
								<?php echo kategoriIcon($detail->kgr_id)?>
								<span class="price">Dilihat : <?php echo $detail->counter?></span>
							</div>
						</div>
					</div>
					<?php endforeach?>
				</div>
			</div>
        </div>
    </div>    
</section>

<section id="pengadaan_list" style="display:none">
	<div class="w-section inverse">
		<div class="container">
			<div class="row no-margin">
				
				<?php 

				foreach ($pengadaan as $detail) :   ?>
				<div class="col-md-12 col-sm-12 col-xs-12 box-lpse-list">
					
					<div class="col-md-4 col-sm-4 col-xs-12 no-padding" >
						<?php //echo substr($detail->lls_id,count($detail->lls_id)-4).'.jpg';
								$lpse_id = substr($detail->lls_id,count($detail->lls_id)-4);
						?>
						<div class="col-md-4 col-sm-4 col-xs-12 mb-10" >
							<?php 

										$cekImg = getFileImage(lpseName($lpse_id),$lpse_id);
										if($cekImg){
											$img = "http://dataclient.net/lkpp-lpse/uploads/".$cekImg;
										}else{
											$img = base_url()."images/no-image.png ";
										}?>


									<img alt="" src="<?php echo $img ?>" class="img-responsive img-center">
						</div>
						<div class="col-md-8 col-sm-8 col-xs-12 mb-20">
							<h5><?php echo word_limiter(lpseName($lpse_id),3)?></h5>
							<h4>Nilai HPS : </h4>
							<h3>Rp <?php echo number_format($detail->pkt_hps); ?></h3>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 mb-20">
						<a href="<?php echo base_url()?>pengadaan/detail/<?php echo $detail->lls_id?>/<?php echo $detail->pkt_id?>/<?php echo rawurlencode($detail->dtj_tglawal)?>"><?php echo $detail->pkt_nama?></a>
						<br/>
					</div>
						
					<div class="w-footer col-md-4 col-sm-4 col-xs-12 text-center">
						<p>Pengumuman Lelang : <?php echo dateIndo($detail->dtj_tglawal)?></P>
						<span class="price">Dilihat :  <?php echo $detail->counter?></span>
						<a href="<?php echo base_url()?>pengadaan/detail/<?php echo $detail->lls_id?>/<?php echo $detail->pkt_id?>/<?php echo rawurlencode($detail->dtj_tglawal)?>" class="btn btn-detail">Detail</a> <?php echo kategoriIcon($detail->kgr_id)?>
					</div>
				</div>
				<?php endforeach?>
		
			</div>
		</div>
	</div>    
</section>
	
<section>
	<div class="w-section inverse">
		<div class="container">
			<div class="row no-margin">
				<ul class="pagination pull-right">
					<?php echo $pagging?>
					<!-- <li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li> -->
				</ul> 
			</div>
		</div>
	</div>
</section>