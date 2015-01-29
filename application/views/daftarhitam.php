<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Daftar Hitam</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!--<li><a href="<?php echo base_url()?>">Beranda</a></li>-->
					<li>Daftar Hitam</li>
				</ol>
			</div>
		</div>
	</div>
</section>		
    
    <section class="slice bg-3">
        <div class="w-section">
            <div class="container">
				<div class="row">
					<form role="form" method="post" action="<?php echo base_url()?>daftarhitam/searchAction">
						<div class="col-xs-12 col-sm-3 col-md-3 mb-5">
						  
						<?php

						$this->load->helper('curl');
						$listProv = curlAPI('prov'); 
				   		
				   		$listKab = curlAPI('kab');

				   		if(count($listKab) > 0){
					   		foreach ($listKab as $key => $value) {
					   			$newListKab[$value['kd_kabupaten']] = $value;
					   		}
				   		}

				   		?>
		
				  		<select name="propinsi_id" class="form-control">
				   			<option value='0'>  Pilih Lokasi Penyedia </option>
				   			<?php foreach ($listProv as  $value) : ?>
				   			<?php $selected= $value['kd_propinsi']==$this->uri->segment(3) ? 'selected="selected"' : '';  ?>
							<option value="<?php echo $value['kd_propinsi']?>" <?php echo $selected?>><?php echo $value['nama_propinsi']?></option>
							<?php endforeach?>
					   </select>
					   </div>
					   <?php
					   $search ='';
					   		if($this->uri->segment(4)!='null'){
					   			$search = $this->uri->segment(4);
					   		}
					   ?>
					   <div class="input-group col-xs-12 col-sm-9 col-md-9 pl-15 pr-15">
							<input type="text" class="form-control" placeholder="Input Kata Kunci" name="search" value="<?php echo rawurldecode($search)?>">
							<div class="input-group-btn">
								<button type="submit" class="btn bg-2"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
							</div>
					   </div>
					</form>
				</div>
				
				
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped tb-blacklist">
							<tr>
								<th>Nama Penyedia</th>
								<th>NPWP</th>
								<th>SK</th>
								<th>Alamat</th>
								<th>Kab/Kota</th>
								<th>Tanggal Berlaku</th>
								<th>Tanggal Penayangan</th>
								<th>Detail</th>
							</tr>
						
							<?php foreach ($daftarhitam as $value) : ?>
							<tr>
								<td><?php echo $value['nama_penyedia']?></td>
								<td><?php echo $value['npwp']?></td>
								<td><?php echo $value['sk']?></td>
								<td><?php echo $value['alamat']?></td>
								<td><?php echo $newListKab[$value['kab_kota']]['nama_kabupaten']?></td>
								<td><?php echo $value['tgl_berlaku'].' to '.$value['tgl_penayangan']?></td>
								<td align='center'><?php echo $value['show_createdate']==1 ? date('Y-m-d',strtotime($value['create_date']) ) : ' - ' ?></td>
								<td class="text-center"><a href="<?php echo base_url()?>daftarhitam/detail/<?php echo $value['id']?>/<?php echo url_title($value['nama_penyedia'])?>" class="link-detail">Detail</a></td>
							</tr>
							<?php endforeach;?>

						</table>
					</div>
				</div>
				
				<div class="row no-margin">
						<ul class="pagination pull-left">
							<?php echo $pagging?>
						</ul> 
					</div>
			</div>
        </div>
    </section>