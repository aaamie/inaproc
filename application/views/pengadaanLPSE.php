
<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Pengadaan</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
				<!-- 	<li><a href="<?php echo base_url()?>">Beranda</a></li> -->
					<li>Pengadaan</li>
				</ol>
			</div>
		</div>
	</div>
</section>	
    
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
				   			<option value="null"> Pilih Lokasi LPSE</option>
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
					   	<option value="0"> Pilih Instansi (KLDI)</option>
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
					   	<option value="null"> Pilih Kualifikasi</option>
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


<section class="search-custom">
	<div class="container">
		<div class="breadcrumb-sub">
			<a href="#" class="active">Pengadaan</a> &raquo; <a href="#">Berdasar LPSE</a> <!-- &raquo; Pengadaan Barang -->
		</div>
	</div>
</section>
	

<section id="pengadaan_list" >
	<div class="w-section inverse">
		<div class="container">
			<div class="row no-margin">
				
				<?php 

				foreach ($lpse as $value) :   ?>
				<div class="col-md-12 col-sm-12 col-xs-12 box-lpse-list">
					
					<div class="col-md-4 col-sm-4 col-xs-12 no-padding" >
						
						<div class="col-md-4 col-sm-4 col-xs-12 mb-10" >
							<img src="<?php echo base_url()?>images/no-image.png" class="img-responsive img-center">
						</div>
						<div class="col-md-8 col-sm-8 col-xs-12 mb-20">
							<h5><?php echo $value['nama']?></h5>
							<!-- <h4>AAA</h4>
							<h3>AAA</h3> -->
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 mb-20">
						<a href="<?php echo base_url()?>pengadaan/index/null/null/null/null/null/null/<?php echo $value['id']?>"><?php echo totalPengadaanByLPSE($value['id'])?> Pengadaan</a>
						<br/>
					</div>
						
					<div class="w-footer col-md-4 col-sm-4 col-xs-12 text-center">
					<!-- 	<p>Pengumuman Lelang : aaa</P> -->
						<!-- <span class="price">Dilihat : 0</span> -->
						<a href="<?php echo base_url()?>pengadaan/index/null/null/null/null/null/null/<?php echo $value['id']?>" class="btn btn-detail">Detail</a> 
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