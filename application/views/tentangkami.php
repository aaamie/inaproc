<?php foreach ($content as $value) : ?>
			

<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2><?php echo $value['title']?></h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!--<li><a href="<?php echo base_url()?>">Beranda</a></li>-->
					<li>Tentang Kami</li>
				</ol>
			</div>
		</div>
	</div>
</section>

    <section class="slice no-padding mt-20">
		<div class="work">
			<div class="row">
				<div class="col-md-12 text-center">
					<img src="<?php echo base_url()?>assets/images/bg-about.jpg" class="img-responsive" alt="Profil D4" style="margin:0 auto">
				</div>
			</div>
		</div>
    </section>
    
    <section class="slice bg-3">
        <div class="w-section inverse">
            <div class="container">
			<div class="row no-margin">
				
				<?php echo $value['content']?>

				<?php endforeach; ?>
				



			</div>
			</div>
        </div>
    </section>
         