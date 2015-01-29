	<section class="tag">
		<div class="w-section inverse">
            <div class="container">
				<div class="row no-margin">
					<h3>Pencarian Terpopuler</h3>
					<div class="line-clear mb-20"></div>
					<div>
					<?php foreach ($list as $value) : ?>
					<a href="<?php echo base_url()?>search/index/<?php echo rawurlencode($value['title'])?>" class="tag-populer">#<?php echo $value['title']?></a>
					<?php endforeach?>
					</div>
				</div>
			</div>
		</div>
	</section>