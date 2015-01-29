  <section class="search-home">
        <div class="cta-wr">
            <div class="container">
                <div class="row bg-2 box-search-home">
				<form role="form" method="post" action="<?php echo base_url()?>lpse/searchAction">
					<div class="col-xs-12 col-sm-3 col-md-3 mb-2 no-padding">
					  	 <?php

                           $listProv = curlAPI('prov'); 

                        ?>
                        <select class="form-control pil-prov"  name="propinsi_id">
                            <option value="0"> Pilih Lokasi LPSE</option>
                            <?php foreach ($listProv as  $value) : ?>
                            <option value="<?php echo $value['kd_propinsi']?>"><?php echo $value['nama_propinsi']?></option>
                            <?php endforeach?>
                        </select>
				   </div>
				   <div class="input-group col-xs-12 col-sm-9 col-md-9">
						<input type="text" class="form-control" name="search" placeholder="Nama LPSE">
						<div class="input-group-btn">
							<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span>&nbsp;Cari</button>
						</div>
				   </div>
				</form> 
                </div>
            </div>
        </div>
    </section>
    
    <section class="slice bg-3">
        <div class="w-section inverse">
            <div class="container">
				<div class="row cat-pengadaan no-margin">
					<div class="col-md-10">
						<div class="sort-list-btn hidden-xs hidden-sm">
							<button type="button" class="btn btn-satu filter" data-filter="all">Pengadaan Berdasarkan : </button>
							<button type="button" class="btn btn-dua filter" data-filter="category_1 category_2 category_3" onclick="window.location.href ='<?php echo base_url()?>pengadaan/setSession/kategori'">Kategori</button>
							<button type="button" class="btn btn-dua filter" data-filter="category_3 category_5 category_6 category_7 category_8"  onclick="window.location.href ='<?php echo base_url()?>pengadaan/lpse'">LPSE</button>
							<button type="button" class="btn btn-dua filter" data-filter="category_6 category_7 category_8"  onclick="window.location.href ='<?php echo base_url()?>pengadaan/kota'">Kota</button>
							<button type="button" class="btn btn-dua filter" data-filter="category_3"  onclick="window.location.href ='<?php echo base_url()?>pengadaan/propinsi'">Provinsi</button>
							<button type="button" class="btn btn-dua filter" data-filter="category_3"  onclick="window.location.href ='<?php echo base_url()?>pengadaan/setSession/hps'">Nilai HPS</button>
<!-- 							<button type="button" class="btn btn-dua filter" data-filter="category_3"  onclick="window.location.href ='<?php echo base_url()?>pengadaan/setSession/pagu'">Nilai Pagu</button>
 -->							<button type="button" class="btn btn-dua filter" data-filter="category_3"  onclick="window.location.href ='<?php echo base_url()?>pengadaan/setSession/kualifikasi'">Kualifikasi Usaha</button>
						</div>
					</div>
					<div class="col-md-2">
                    	<div class="btn-group hidden-md hidden-lg">
                            <button type="button" class="btn btn-three">Pengadaan Berdasarkan</button>
                            <button type="button" class="btn btn-three dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                        </div>
                    </div>
				</div>
				
				
                    <div class="mt-20">
    					<div id="carouselWork" class="carousel-3 slide animate-hover-slide">
                            <?php if(count($link_aplikasi) > 6) : ?>
    						<div class="carousel-nav">
    							<a data-slide="prev" class="left color-two" href="#carouselWork"><i class="fa fa-angle-left"></i></a>
    							<a data-slide="next" class="right color-two" href="#carouselWork"><i class="fa fa-angle-right"></i></a>
    						</div>
                        <?php endif?>
                        <div class="line-clear mb-10"></div>
    				<div class="clearfix"></div>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">

                                <?php foreach ($link_aplikasi1 as  $value) : ?>
                                <div class="col-md-2 col-sm-2">
                                    <div class="app-eproc">
                                         <a href="<?php echo $value['link']?>"><img alt="" src="<?php echo base_url()?>uploads/gambar_link/thumbs/<?php echo $value['file_image']?>" class="img-container img-responsive img-center"></a>
                                    </div>
                                </div>
                                <?php endforeach;?>
                                
                          
                            </div>
                        </div>
                       <?php if(count($link_aplikasi2) > 0 ) :?>
                        <div class="item">
                            <div class="row">

                                <?php foreach ($link_aplikasi2 as  $value) : ?>
                                <div class="col-md-2 col-sm-2">
                                    <div class="app-eproc">
                                         <a href="<?php echo $value['link']?>"><img alt="" src="<?php echo base_url()?>uploads/gambar_link/thumbs/<?php echo $value['file_image']?>" class="img-container img-responsive img-center"></a>
                                    </div>
                                </div>
                                <?php endforeach;?>
								
                            </div>
                        </div>
						<?php endif;?>


                         <?php if(count($link_aplikasi3) > 0 ) :?>
                        <div class="item">
                            <div class="row">

                                 <?php foreach ($link_aplikasi3 as  $value) : ?>
                                <div class="col-md-2 col-sm-2">
                                    <div class="app-eproc">
                                         <img alt="" src="<?php echo base_url()?>uploads/gambar_link/thumbs/<?php echo $value['file_image']?>" class="img-container img-responsive img-center">
                                    </div>
                                </div>
                                <?php endforeach;?>
								<!-- <div class="col-md-2 col-sm-2">
                                    <div class="app-eproc">
                                         <img alt="" src="<?php echo base_url()?>images/app1.png" class="img-responsive img-center">
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-2">
                                    <div class="app-eproc">
                                         <img alt="" src="<?php echo base_url()?>images/app2.png" class="img-responsive img-center">
                                    </div>
                                </div> -->
                                
                            </div>
                        </div>
                        <?php endif;?>


                    </div>
                    </div>
                </div>  
				<div class="line-clear"></div>				
                </div>
            </div>
        </div>    
    </section>
    
    <section>
        <div class="w-section inverse">
            <div class="container">
                <h2 class="title-new-pengadaan">Pengadaan Terbaru : <a href="<?php echo base_url()?>pengadaan"><?php echo $total?></a> Paket</h2>
                <div class="row">

                	<?php 



                    // echo "<pre>";
                    // print_r($pengadaan);
                    // echo "</pre>";
                    // die();
                    $this->load->helper('engine');
                    $this->load->helper('dateIndo');
                    foreach ($pengadaan as $detail) : ?>
                	<?php //echo substr($detail->lls_id,count($detail->lls_id)-4).'.jpg';
                                        $lpse_id = substr($detail->lls_id,count($detail->lls_id)-4);
                    ?>
					<div class="col-md-4">
						<div class="w-box product">
						<div class="box-lpse-bt">
							<div class="col-md-4">

<?php 

                                        $cekImg = getFileImage(lpseName($lpse_id),$lpse_id);
                                        if($cekImg){
                                            $img = "http://dataclient.net/lkpp-lpse/uploads/".$cekImg;
                                        }else{
                                            $img = base_url()."images/no-image.png ";
                                        }?>


                                    <img alt="" src="<?php echo $img ?>" class="img-responsive img-center" style="height:84px">
                               
								<!-- <img alt="" src="<?php echo base_url()?>uploads/thumbs/<?php echo $value['file_image']?>" class="img-responsive img-center"> -->
							</div>
							<h5><?php echo word_limiter(lpseName($lpse_id),3)?></h5>
                                <h3>Nilai HPS : </h3>
                                <h4>Rp <?php echo number_format($detail->pkt_hps); ?></h4>
                            </div>
                            <p >
                                <?php echo word_limiter($detail->pkt_nama,5)?>
                            </p>
                            <br/>
                            <p>
                                Pengumuman Lelang : <?php echo dateIndo($detail->dtj_tglawal)?></P>
                            
                            <div class="w-footer">
                                <a href="<?php echo base_url()?>pengadaan/detail/<?php echo $detail->lls_id?>/<?php echo $detail->pkt_id?>/<?php echo rawurlencode($detail->dtj_tglawal)?>" class="btn btn-detail">Detail</a>
                                <?php echo kategoriIcon($detail->kgr_id)?>
                                <span class="price">Dilihat : <?php echo $detail->counter?></span>
                            </div>
						</div>
					</div>

					<?php endforeach;?>
			
				</div>					
                <div class="row">
					<div class="col-md-12" style="text-align:center;">
						<a href="<?php echo base_url()?>pengadaan" class="btn btn-two mb-20">Selengkapnya &raquo;</a>
					</div>
				</div>
            </div>
        </div>    
    </section>
	
	<section>
        <div class="w-section inverse">
            <div class="container">
				<div class="line-clear mb-20"></div>
			</div>
		</div>
	</section>
	
	<section>
        <div class="w-section inverse">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title-new-pengadaan">Pengadaan Terpopuler</h2>
					</div>
				</div>
                <div class="row">
					<?php foreach ($pengadaanPopuler as $detail) : ?>
                	
                    <?php //echo substr($detail->lls_id,count($detail->lls_id)-4).'.jpg';
                                        $lpse_id = substr($detail->lls_id,count($detail->lls_id)-4);
                    ?>
                    <div class="col-md-4">
                        <div class="w-box product">
                        <div class="box-lpse-bt">
                            <div class="col-md-4">
                               
                              <?php 

                                        $cekImg = getFileImage(lpseName($lpse_id),$lpse_id);
                                        if($cekImg){
                                            $img = "http://dataclient.net/lkpp-lpse/uploads/".$cekImg;
                                        }else{
                                            $img = base_url()."images/no-image.png ";
                                        }?>


                                    <img alt="" src="<?php echo $img ?>" class="img-responsive img-center" style="height:84px">
                                <!-- <img alt="" src="<?php echo base_url()?>uploads/thumbs/<?php echo $value['file_image']?>" class="img-responsive img-center"> -->
                            </div>
                            <h5><?php echo word_limiter(lpseName($lpse_id),3)?></h5>
                                <h3>Nilai HPS : </h3>
                                <h4>Rp <?php echo number_format($detail->pkt_hps); ?></h4>
                            </div>
                            <p >
                                <?php echo word_limiter($detail->pkt_nama,5)?>
                            </p>
                            <br/>
                            <p>
                                Pengumuman Lelang : <?php echo dateIndo($detail->dtj_tglawal)?></P>
                            
                            <div class="w-footer">
                                <a href="<?php echo base_url()?>pengadaan/detail/<?php echo $detail->lls_id?>/<?php echo $detail->pkt_id?>/<?php echo rawurlencode($detail->dtj_tglawal)?>" class="btn btn-detail">Detail</a>
                                <?php echo kategoriIcon($detail->kgr_id)?>
                                <span class="price">Dilihat : <?php echo $detail->counter?></span>
                            </div>
                        </div>
                    </div>


				<?php endforeach;?>
					
				</div>					
                <div class="row">
					<div class="col-md-12" style="text-align:center;">
						<a href="<?php echo base_url()?>pengadaan" class="btn btn-two">Selengkapnya &raquo;</a>
					</div>
				</div>
            </div>
        </div>    
    </section>