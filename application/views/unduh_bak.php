<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Unduh</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url()?>">Beranda</a></li>
					<li>Unduh</li>
				</ol>
			</div>
		</div>
	</div>
</section>
   
    <section class="mt-40">
		<div class="container">
			<div class="row">
				<div class="form-group col-md-8"> 
					<select name="jenis-regulasi" class="form-control">
						<option>Semua Kategori</option>
						<?php foreach ($kat as $katval) : ?>
						<option><?php echo $katval->title?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group col-md-3"> 
					<select name="tahun" class="form-control">
						<option>Tahun</option>
						<option>2014</option>
					</select>
				</div>
				<div class="form-group col-md-1">
					<button type="button" class="btn bg-2 w-100"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
				</div>
			</div>
			<div class="line-clear"></div>
		</div>
    </section>
	
	<section>
		<div class="container">
			<div class="row">

				<?php foreach ($unduh as $value) : ?>

				<?php if(count($value['unduh_list']) > 0 ) :?>
				<div class="box-unduh2 col-md-12">
					<h4 class="list-unduh-kategori"><?php echo $value['ref_title']?></h3>
					
					<?php foreach ($value['unduh_list'] as $valueList) : ?>
					<div class="row list-unduh no-margin">
						<div class="col-md-5">
							<h4><?php echo $valueList['title']?></h4>
						</div>
						<div class="col-md-7">
							<p>
								<?php echo $valueList['content']?></p>
							<!-- share widget-->
		                    <!-- <span class='st_facebook' displayText=''></span>
							<span class='st_twitter' displayText=''></span>
							<span class='st_googleplus' displayText=''></span>
							<span class='st_email' displayText=''></span>
		                     --><!-- -->
							
		                     <!-- Go to www.addthis.com/dashboard to customize your tools -->
								<div class="addthis_sharing_toolbox"></div>


								<div class="form-group link-unduh">
								<a href="<?php echo base_url()?>uploads/documents/<?php echo $valueList['file_image']?>" class="btn-unduh"><span class="glyphicon glyphicon-file"></span>&nbsp;Unduh File</a>
							</div>
						</div>
					</div>

					<?php endforeach?>
					
				</div>
				<?php endif?>
			<?php endforeach?>



			</div>
		</div>
	</section>
	
	<!-- <section>
		<div class="container">
			<div class="row no-margin">
				<ul class="pagination pull-right">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul> 
			</div>
		</div>
	</section> -->

