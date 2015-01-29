

					<?php

						$listProv = curlAPI('prov');
				   		if(count($listProv) > 0){
					   		foreach ($listProv as $key => $value) {
					   			$newListProv[$value['kd_propinsi']] = $value;
					   		}
				   		}

						$listKab = curlAPI('kab');
				   		if(count($listKab) > 0){
					   		foreach ($listKab as $key => $value) {
					   			$newListKab[$value['kd_kabupaten']] = $value;
					   		}
				   		}

					?>

<?php foreach ($daftarhitam as $value) : ?>
<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Daftar Hitam</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!--<li><a href="<?php echo base_url()?>">Beranda</a></li>-->
					<li><a href="<?php echo base_url()?>daftarhitam">Daftar Hitam</a></li>
					<li><?php echo $value['nama_penyedia']?></li>
				</ol>
			</div>
		</div>
	</div>
</section>	
    
    <section class="slice bg-3 h-680">
        <div class="w-section">
            <div class="container">
				<div class="row">

			
					<form role="form" method="post" action="<?php echo base_url()?>daftarhitam/searchAction">
						<div class="col-xs-12 col-sm-3 col-md-3 mb-5">
						  <select name="propinsi_id" class="form-control">
				   			<option>  Pilih Lokasi Penyedia </option>
				   			<?php foreach ($listProv as  $valueProv) : ?>
							<option value="<?php echo $valueProv['kd_propinsi']?>"><?php echo $valueProv['nama_propinsi']?></option>
							<?php endforeach?>
					   </select>
					   </div>
					   <div class="input-group col-xs-12 col-sm-9 col-md-9 pl-15 pr-15">
							<input type="text" class="form-control" name="search">
							<div class="input-group-btn">
								<button type="submit" class="btn bg-2"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
							</div>
					   </div>
					</form>

				</div>
				
				
				<div class="row">
					<div class="col-md-12">
					<h3 class="mb-20"><?php echo $value['nama_penyedia']?></h3>
						<table class="table tb-lpse">
							<tbody>
								<tr>
									<td class="w-135">Nama Penyedia</td><td class="w-5">:</td><td><?php echo $value['nama_penyedia']?></td></tr>
								<tr>
									<td>NPWP Perusahaan</td><td>:</td><td><?php echo $value['npwp']?></td></tr>
								<tr>
									<td>Penandatangan Kontrak</td><td>:</td><td><?php echo $value['direktur']?></td></tr>
								<tr>
									<td>NPWP Direktur</td><td>:</td><td><?php echo $value['npwp_direktur']?></td></tr>
								<tr>
									<td>Alamat</td><td>:</td><td><?php echo $value['alamat']?></td></tr>
								<tr>
									<td>Kabupaten/Kota</td><td>:</td><td><?php echo $newListKab[$value['kab_kota']]['nama_kabupaten']?></td></tr>
								<tr>
									<td>Propinsi</td><td>:</td><td><?php echo $newListProv[$value['propinsi_id']]['nama_propinsi']?></td></tr>
							</tbody>
						</table>
						<table class="table table-bordered mt-20 table-striped">
							<tbody>
								<tr>
									<th class="text-center">NO</th><th class="text-center">SK</th><th class="text-center">Tanggal Berlaku</th><th class="text-center">Tanggal Penayangan</th><th class="text-center">Alasan Terdaftar</th></tr>
								<?php
								$no=1;
								foreach ($daftarsk as $val) : ?>
								<tr>
									<td class="text-center"><?php echo $no;?></td><td><?php echo $val['sk']?></td><td><?php echo $val['tgl_berlaku'].' to '.$val['tgl_penayangan'] ?></td><td><?php echo $val['show_createdate']==1 ? date('Y-m-d',strtotime($val['create_date']) ) : ' - ' ?></td><td><?php echo $val['alasan_terdaftar']?></td></tr>
								<?php 
								$no++;
								endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
				<?php endforeach;?>

			</div>
        </div>
    </section>