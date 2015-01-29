<script>

function submitform()
{
  document.forms["myform"].submit();
}
</script>

<div class="col-md-4 section-right">
					<h3>Pencarian</h3>
					<div class="widget">
						<form class="form-inline" id="myform" action="<?php echo base_url()?>berita/actionSearch" method="POST">
							<div class="input-group">
								<input type="text" name="cari" class="form-control" placeholder="Cari..." />
								<span class="input-group-btn">
									<button class="btn btn-two" type="button" onclick="submitform();">Cari</button>
								</span>
							</div>
						</form>
					</div>
					
					<h3>Kategori</h3>
					<div class="widget">
						<ul class="categories highlight">
							<?php foreach ($ref_news as $val) : ?>
							<li><a href="<?php echo base_url()?>berita/catagory/<?php echo $val['id']?>"><?php echo $val['title']?></a></li>
							<?php endforeach;?>
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
										<?php foreach ($beritaPopuler as $val) : ?>
										<li>
											<?php if($val['file_image'] && file_exists('./uploads/news/thumbs/'.$val['file_image'])) {?>
											<img src="<?php echo base_url()?>uploads/news/thumbs/<?php echo $val['file_image']?>" alt="" class="img-thumbnail pull-left">
											<?php }else{ ?>
											<img alt="" src="<?php echo base_url()?>images/no-image.png" class="img-thumbnail pull-left">
											<?php } ?>
											
											<p>
												<a href="<?php echo base_url()?>berita/detail/<?php echo $val['id']?>/<?php echo url_title($val['title'])?>"><?php echo $val['title']?></a>
												<i<?php echo dateIndo($val['create_date'])?> </i>
											</p>
											
										</li>
										<?php endforeach;?>
									</ul>
								</div>
								<div class="tab-pane" id="two">
									<ul class="recent">
										<?php foreach ($beritaRecent as $val) : ?>
										<li>
											
											<p>
												<a href="<?php echo base_url()?>berita/detail/<?php echo $val['id']?>/<?php echo url_title($val['title'])?>"><?php echo $val['title']?></a>
											
											</p>
											
										</li>
										<?php endforeach;?>
									</ul>
								</div>
							</div>							
						</div>
					</div>
				</div>