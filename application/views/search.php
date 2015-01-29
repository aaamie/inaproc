<!-- <section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>Inaproc &raquo; Pencarian</h4>
			</div>
		</div>
	</div>
</section> -->

     <section class="pg-opt pin">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Pencarian</h2>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb">
                    <li>Pencarian</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="slice bg-3 animate-hover-slide">
	<div class="w-section inverse blog-grid">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="blockred-search">
								HASIL PENCARIAN
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="result-search">
								<div class="row speed-search">
									<div class="col-md-6 col-xs-6 text-left">
										sekitar <?php echo $total['total']?> hasil ({elapsed_time} detik)
									</div>
									<div class="col-md-6 col-xs-6 text-right">
										<div class="form-group">
											<span class="hidden-xs">Sortir Berdasarkan&nbsp;</span>
											<select name="sort">
												<option>Waktu</option>
											</select>
										</div>
									</div>
								</div>

								<?php foreach ($searchResult as $value) : ?>
								<div class="row">
									<div class="item-search">
										<h1><a href="<?php echo base_url()?><?php echo $value['tipe']?>/detail/<?php echo $value['id']?>"><?php echo $value['title']?></a></h1>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<?php
									
												$file_image = $value['file_image'];
												$jumlah = strlen($file_image)
											?>

											<?php
											if($jumlah>=1){?>
											
											<img class="img-responsive img-center" src="<?php echo base_url()."uploads/".$value['file_image']?>">
											<?php
											}else{?>
											<img class="img-responsive img-center" src="<?php echo base_url()."uploads/no-image.png"?>">
											
											<?php } ?>

										</div>
										<div class="col-md-9 col col-sm-9 col-xs-12 item-search-content">
											<p><?php echo word_limiter(strip_tags($value['content']),20);?> </p>
												
										</div>
									</div>
								</div>
								<?php endforeach?>
								
								<!--paging-->
								<div class="row no-margin">
									<ul class="pagination pull-right">
										<?php echo $pagging?>
									</ul> 
								</div> 
							</div>
						</div>
					</div>
					
				</div>
				
				<div class="col-md-4 section-right">
					<h3>Berita Terbaru</h3>
					
					<ul class="berita-baru">
						<?php foreach ($beritaRecent as  $value) : ?>
						<li>
							<h2 style="font-weight: normal;font-size: 15px;"><a href="<?php echo base_url()?>berita/detail/<?php echo $value['id']?>"><?php echo $value['title']?></a></h2>
							<span><?php echo date('d, M Y',strtotime($value['create_date'])) ?></span>
						</li>
						<?php endforeach?>
					</ul>
					
					<h3>Tabs</h3>
					<div class="widget">
						<div class="tabs">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#one" data-toggle="tab"><i class="icon-star"></i> Popular</a></li>
								<li><a href="#two" data-toggle="tab">Recent</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="one">
									<ul class="popular">
										<?php foreach ($beritaPopuler as  $value) : ?>
										<li>
											<img src="<?php echo base_url()?>uploads/thumbs/<?php echo $value['file_image']?>" alt="" class="img-thumbnail pull-left">
											<p>
												<a href="<?php echo base_url()?>berita/detail/<?php echo $value['id']?>"><?php echo $value['title']?></a>
												<i><?php echo date('d, M Y',strtotime($value['create_date'])) ?></i>
											</p>
											
										</li>
										<?php endforeach?>
									</ul>
								</div>
								<div class="tab-pane" id="two">
									<ul class="recent">
										<?php foreach ($beritaRecent as  $value) : ?>
										<li>
											<img src="<?php echo base_url()?>uploads/<?php echo $value['file_image']?>" alt="" class="img-thumbnail pull-left">
											<p>
												<a href="<?php echo base_url()?>berita/detail/<?php echo $value['id']?>"><?php echo $value['title']?></a>
												<i><?php echo date('d, M Y',strtotime($value['create_date'])) ?></i>
											</p>
											
										</li>
										<?php endforeach?>
									</ul>
								</div>
							</div>							
						</div>
					</div>
				</div>		

			</div>
		</div>
	</div>
</section>