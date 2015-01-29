
<!-- <section class="slice bg-3 pt-pb-0 mt-20">
	<div class="container">
		<div class="row no-margin">
			<h3>Berita</h3>
			<div class="line-clear"></div>
		</div>
        <div class="col-md-6">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>">Berita</a></li>
                    <li><?php echo ucwords(str_replace('-',' ',$this->uri->segment(4)))?></li>
                </ol>
        </div>
	</div>
</section>
	 -->

     <section class="pg-opt pin">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Berita</h2>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb">
                  <li><a href="<?php echo base_url()?>">Berita</a></li>
                    <li><?php echo ucwords(str_replace('-',' ',$this->uri->segment(4)))?></li>
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

                                <?php foreach ($berita as $value) : ?>
                                <div class="w-box blog-post">
                                    <div class="figure">

                                            <?php if($value['file_image'] && file_exists('./uploads/news/thumbs/'.$value['file_image'])) {?>
                                            <img src="<?php echo base_url()?>uploads/news/<?php echo $value['file_image']?>" alt="" class="img-responsive-">
                                            <?php }else{ ?>
                                            <img alt="" src="<?php echo base_url()?>images/no-image.png" class="img-responsive-">
                                            <?php } ?>
                                            
                                       
                                        <!-- share widget-->
                                        <div class="widget-sharethis">
                                        <span class='st_facebook' ></span>
                                        <span class='st_twitter' ></span>
                                        <span class='st_googleplus' ></span>
                                        <span class='st_email' ></span>
                                    </div>
                                        <!-- -->

                                        <h2><?php echo $value['title']?></h2>
                                        
                                        <ul class="meta-list">
                                            <!-- <li>
                                                <span>Written by</span>
                                                <span class="bold">Alex</span>
                                            </li> -->
                                            <li>
                                                <!-- <span>-</span> -->
                                                <a href="#"> <?php echo dateIndo($value['create_date'])?> </a>
                                            </li>
                                        </ul>
                                        <p>Dibuat oleh : <?php echo $value['dibuat']?> Dilihat : <?php echo $value['counter']?> kali</p>
                                        <?php echo $value['content']?>
                                        
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="w-box blog-post">
                        
                                    <div class="comments-wr">
                                        <h3 class="section-title">Komentar</h3>
                                        <?php foreach($komentar as $val) : ?>
                                        <div class="comment">
                                            <img src="<?php echo base_url()?>images/no-image.png" alt="">
                                            <p><?php echo $val['content']?><br><?php echo "<i><b>".$val['nama']."</b></i>";?></p>
                                        </div>
                                        <?php endforeach;?>
                                        
                                    </div>
                                </div>
                                
                                <?php if($this->session->userdata('lkpp_logged_user')) :?>
                                <script type="text/javascript">
                                function submitformKomentar()
                                {
                                  if($('#nama').val()==''){
                                    alert('nama tidak boleh kosong');
                                  }else if($('#email').val()==''){
                                     alert('email tidak boleh kosong');
                                  }else if($('#content').val()==''){
                                     alert('komentar tidak boleh kosong');
                                  }else{
                                     document.komentar.submit();
                                  }
                                 
                                }
                                </script>
                                <div class="w-box w-box-inverse inner">
                                    <div class="comment-form">
                                        <h3 class="section-title">Tulis Komentar</h3>
                                        
                                        <form class="form-light" name="komentar" method="POST" action="<?php echo base_url()?>berita/submitKomentar">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>      
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Komentar</label>
                                                        <textarea name="content" id="content" class="form-control" placeholder="Silahkan isi komentar Anda disini" style="min-height:90px;"></textarea>
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="col-md-6">
                                                    &nbsp;
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="news_id" value="<?php echo $this->uri->segment(3)?>" placeholder="Nama">
                                                    <input type="hidden" name="current_url" value="<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4)?>">
                                                    <a data-toggle="modal" href="#" class="btn btn-two pull-right" onclick="submitformKomentar()" title=""><i class="fa fa-comment-o"></i> Kirim Komentar</a>
                                                </div>
                                            </div>     
                                        </form>
                                    </div>
                                </div>
                            <?php endif;?>
                            </div>
                        </div>
                    </div>
                                            


                     <?php echo $this->load->view('beritaRight',$dataRight)?>
				</div>



			</div>
    
            </div>
        </div>
    </section>