<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Berita</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!--<li><a href="<?php echo base_url()?>">Beranda</a></li>-->
					<li>Berita</li>
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
						<?php foreach ($berita as $value) : ?>
						<div class="col-md-6">
							<div class="w-box b-box">
								<div class="figure box-img-berita">
									<?php if($value['file_image'] && file_exists('./uploads/news/thumbs/'.$value['file_image'])) {?>
									<img alt="" src="<?php echo base_url()?>uploads/news/thumbs/<?php echo $value['file_image']?>" class="img-responsive">
									<?php }else{ ?>
									<img alt="" src="<?php echo base_url()?>images/no-image.png" class="img-responsive">
									<?php } ?>
								</div>
								<a href="<?php echo base_url()?>berita/detail/<?php echo $value['id']?>/<?php echo url_title($value['title'])?>" class="title-news"><?php echo word_limiter($value['title'],3)?></a>
								<p>Dibuat oleh : <?php echo $value['dibuat']?> Dilihat : <?php echo $value['counter']?> kali
								<br>
								<?php echo word_limiter($value['content'],15)?> 
								</p>
								<div class="w-footer bg-white">
									<span class="pull-left"><small>Posted on  <?php echo dateIndo($value['create_date'])?>  </small></span>
									<a href="<?php echo base_url()?>berita/detail/<?php echo $value['id']?>/<?php echo url_title($value['title'])?>" class="btn btn-xs pull-right btn-readmore">Selengkapnya</a>
									<span class="clearfix"></span>
								</div>
							</div>
							
						</div>
						<?php endforeach; ?>
						<!-- <div class="col-md-6">
							<div class="w-box">
								<div class="figure box-img-berita">
									<img alt="" src="images/gal-2.jpg" class="img-responsive">
								</div>
								<a href="berita-detail.html" class="title-news">Start selling your products in a beautiful style</a>
								<p>
								Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. 
								</p>
								<div class="w-footer bg-white">
									<span class="pull-left"><small>Posted on 23th, October 2013</small></span>
									<a href="berita-detail.html" class="btn btn-xs pull-right btn-readmore">Read more</a>
									<span class="clearfix"></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="w-box">
								<div class="figure box-img-berita">
									<img alt="" src="images/gal-3.jpg" class="img-responsive">
								</div>
								<a href="berita-detail.html" class="title-news">Start selling your products in a beautiful style</a>
								<p>
								Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. 
								</p>
								<div class="w-footer bg-white">
									<span class="pull-left"><small>Posted on 23th, October 2013</small></span>
									<a href="berita-detail.html" class="btn btn-xs pull-right btn-readmore">Read more</a>
									<span class="clearfix"></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="w-box">
								<div class="figure box-img-berita">
									<img alt="" src="images/gal-4.jpg" class="img-responsive">
								</div>
								<a href="berita-detail.html" class="title-news">Start selling your products in a beautiful style</a>
								<p>
								Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. 
								</p>
								<div class="w-footer bg-white">
									<span class="pull-left"><small>Posted on 23th, October 2013</small></span>
									<a href="berita-detail.html" class="btn btn-xs pull-right btn-readmore">Read more</a>
									<span class="clearfix"></span>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="w-box">
								<div class="figure box-img-berita">
									<img alt="" src="images/gal-5.jpg" class="img-responsive">
								</div>
								<a href="berita-detail.html" class="title-news">Start selling your products in a beautiful style</a>
								<p>
								Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. 
								</p>
								<div class="w-footer bg-white">
									<span class="pull-left"><small>Posted on 23th, October 2013</small></span>
									<a href="berita-detail.html" class="btn btn-xs pull-right btn-readmore">Read more</a>
									<span class="clearfix"></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="w-box">
								<div class="figure box-img-berita">
									<img alt="" src="images/gal-6.jpg" class="img-responsive">
								</div>
								<a href="berita-detail.html" class="title-news">Start selling your products in a beautiful style</a>
								<p>
								Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. 
								</p>
								<div class="w-footer bg-white">
									<span class="pull-left"><small>Posted on 23th, October 2013</small></span>
									<a href="berita-detail.html" class="btn btn-xs pull-right btn-readmore">Read more</a>
									<span class="clearfix"></span>
								</div>
							</div>
						</div> -->



					</div>
					
					<div class="row no-margin">
						<ul class="pagination pull-left">
							<?php echo $pagging?>
<!-- 							<li><a href="#">&laquo;</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">&raquo;</a></li>
 -->						</ul> 
					</div>
				</div>
				
				<!-- <div class="col-md-4 section-right">
					<h3>Pencarian</h3>
					<div class="widget">
						<form class="form-inline">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="ketik kata pencarian..." />
								<span class="input-group-btn">
									<button class="btn btn-two" type="button">Go!</button>
								</span>
							</div>
						</form>
					</div>
					
					<h3>Kategori</h3>
					<div class="widget">
						<ul class="categories highlight">
							<li><a href="#">Deputi Hukum</a></li>
							<li><a href="#">Sanggahan</a></li>
						</ul>
					</div>
					
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
										<li>
											<img src="images/gal-2.jpg" alt="" class="img-thumbnail pull-left">
											<p>
												<a href="berita-detail.html">Dorlorem ipsum et mea dolor sit amet, usu timeam persius ea</a>
												<i>20th, June 2013</i>
											</p>
											
										</li>
										<li>
											<img src="images/gal-3.jpg" alt="" class="img-thumbnail pull-left">
											<p>
												<a href="berita-detail.html">Dorlorem ipsum et mea dolor sit amet, usu timeam persius ea</a>
												<i>20th, June 2013</i>
											</p>
										</li>
										<li>
											<img src="images/gal-1.jpg" alt="" class="img-thumbnail pull-left">
											<p>
												<a href="berita-detail.html">Dorlorem ipsum et mea dolor sit amet, usu timeam persius ea</a>
												<i>20th, June 2013</i>
											</p>
										</li>
									</ul>
								</div>
								<div class="tab-pane" id="two">
									<ul class="recent">
										<li>
											<p><a href="berita-detail.html">Dorlorem ipsum et mea dolor sit amet</a></p>
										</li>
										<li>
											<p><a href="berita-detail.html">Fierent adipisci iracundia est ei, usu timeam persius ea</a></p>
										</li>
										<li>
											<p><a href="berita-detail.html">Usu ea justo malis, pri quando everti electram ei</a></p>
										</li>
									</ul>
								</div>
							</div>							
						</div>
					</div>
				</div> -->

				<?php echo $this->load->view('beritaRight',$dataRight)?>

			

			</div>
		</div>
	</div>
</section>