<!-- breadcrumb -->
<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Unduh</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!-- <li><a href="<?php echo base_url()?>unduh">Unduh</a></li>
					 -->
					<li><?php echo $this->uri->segment(4)?></li>
				</ol>
			</div>
		</div>
	</div>
</section>
<!-- breadcrumb -->   


    <section class="mt-40">
		<div class="container">
			<div class="row">
				<div class="col-md-8">

					<?php foreach ($unduh as $value) : ?>

					<?php if(count($value['unduh_list']) > 0 ) :?>

					<h3 class="section-title"><?php echo $value['ref_title']?></h3>
					<ul class="list-listings">
						<?php foreach ($value['unduh_list'] as $valueList) : ?>
					    <li>
					        <div class="listing-image">
					        	<?php if($valueList['file_image_icon'] && file_exists("./uploads/unduh/".$valueList['file_image_icon'])) { ?>
					        	 <img src="<?php echo base_url()?>uploads/unduh/<?php echo $valueList['file_image_icon']?>" />
					        	<?php }else{?>
					             <img src="<?php echo base_url()?>images/doc-download.png" />
					            <?php }?>
					        </div>
					        <div class="listing-body">
					            <h3><?php echo $valueList['title']?></h3>
					            <p><?php echo $valueList['content']?></p>

					            	<!-- share widget-->
					            	<div class="widget-sharethis">
					                    <span class='st_facebook' ></span>
										<span class='st_twitter' ></span>
										<span class='st_googleplus' ></span>
										<span class='st_email' ></span>
		                     		</div>
		                     		<div class="clear"></div>

					        </div>
					        <div class="listing-actions">
					            <a href="<?php echo base_url()?>uploads/unduh/<?php echo $valueList['file_image']?>" class="btn btn-two">Unduh</a>
					        </div>
					    </li>
					 	<?php endforeach?>				    					    
					</ul>  


					<?php endif?>
			<?php endforeach?>

				</div>
				<div class="col-md-4">

						<div class="widget">
							<h3 class="section-title">Kategori</h3>
							<ul class="categories">
								<?php foreach ($kat as $katval) : ?>
								<li><a href="<?php echo base_url()?>unduh/catagory/<?php echo $katval->id ?>/<?php echo  url_title($katval->title)?>" ><?php echo $katval->title?></a></li>
								<?php endforeach;?>
							</ul>
						</div>				
					<h3 class="section-title">Pencarian File</h3>
					<div class="widget widget-highlight">

					    <form role="form" action="<?php echo base_url()?>unduh/searchAction" method="post">
					        <div class="form-group">
					            <label>Kata Kunci</label>
					            <input type="text" class="form-control" name="search" placeholder="Cari..." />
					        </div>
					        <div class="form-group">
					            <label>Kategori</label>
					            <select name="catagory" class="form-control">
					            	<!-- <option  value=''> - Pilih Katagori - </option> -->
					            	<?php foreach ($kat as $katval) : ?>
					                <option value="<?php echo $katval->id ?>"><?php echo $katval->title ?></option>
					                <?php endforeach;?>
					            </select>
					        </div>
					        <button type="submit" class="btn btn-two">Cari</button>
					    </form>
					</div>					
				</div>
			</div>
			<div class="line-clear"></div>
		</div>
    </section>
<!-- search form -->
<!--
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
-->			
<!-- search form -->
	
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

