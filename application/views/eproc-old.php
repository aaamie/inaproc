<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Aplikasi eProc Lainnya</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url()?>">Beranda</a></li>
					<li>Aplikasi eProc Lainnya</li>
				</ol>
			</div>
		</div>
	</div>
</section>		
    
    <section class="slice bg-3 h-680">
        <div class="w-section">
            <div class="container">
				<h3>Selamat datang di Portal Pengadaan Nasional</h3>
				<div class="row no-margin">
					<div class="col-md-12 info-login-eproc">
						<h4>Anda masuk sebagai :</h4>
						<h5><?php echo $this->session->userdata('lkpp_logged_user')?></h5>
						<!-- <h5>PANITIA@LPSEID-999</h5> -->
					</div>
				</div>
				<div class="row no-margin">
					<h5 class="choose-eproc">Pilih aplikasi yang anda inginkan </h5>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel-group" id="accordion">

							<?php 
							$i=0;
							foreach ($eproc as $value) : ?>
							<div class="panel panel-default">
							  <div class="panel-heading">
								<h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="collapsed">
									<?php echo $value['title']?>
								  </a>
								</h4>
							  </div>
							  <?php $in = $i==0 ? 'in' : 'collapse' ?>
							  <div id="collapse1" class="panel-collapse <?php echo $in?>">
								<div class="panel-body">
								<p>
									<?php echo strip_tags($value['content'])?></p>
									<a href="<?php echo $value['link']?>" class="btn btn-two">Masuk Versi Latihan</a>
									<hr>
									<p>
										Jika Anda login dari LPSE Versi PRODUCTION silahkan klik tombol di bawah ini</p>
									<a href="<?php echo $value['link2']?>" class="btn btn-two">Masuk Versi Production</a>								</div>
							  </div>
							</div>
							<?php
							$i++;
							 endforeach?>
							
							<!-- <div class="panel panel-default">
							  <div class="panel-heading">
								<h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed">
									Aplikasi e-Purchasing pemasangan pagar pengaman aset ruang bangun kereta api dengan panel
								  </a>
								</h4>
							  </div>
							  <div id="collapse2" class="panel-collapse collapse">
								<div class="panel-body">
									<p>
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.</p>
									<a href="eproc.html" class="btn btn-two">Masuk Versi Latihan</a>
									<hr>
									<p>
										Jika Anda login dari LPSE Versi PRODUCTION silahkan klik tombol di bawah ini</p>
									<a href="eproc.html" class="btn btn-two">Masuk Versi Production</a>	
								</div>
							  </div>
							</div> -->
							<!-- <div class="panel panel-default">
							  <div class="panel-heading">
								<h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="collapsed">
									Aplikasi e-Purchasing pemasangan pagar pengaman aset ruang bangun kereta api dengan panel
								  </a>
								</h4>
							  </div>
							  <div id="collapse3" class="panel-collapse collapse">
								<div class="panel-body">
									<p>
										Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.</p>
									<a href="eproc.html" class="btn btn-two">Masuk Versi Latihan</a>
									<hr>
									<p>
										Jika Anda login dari LPSE Versi PRODUCTION silahkan klik tombol di bawah ini</p>
									<a href="eproc.html" class="btn btn-two">Masuk Versi Production</a>	
								</div>
							  </div>
							</div> -->

							
							
						  </div>
					</div>
				</div>
			</div>
        </div>
    </section>