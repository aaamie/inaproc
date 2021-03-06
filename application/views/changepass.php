
<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Reset Password</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!-- <li><a href="#">Home</a></li> -->
					<li>Rubah password</li>
				</ol>
			</div>
		</div>
	</div>
</section>


	
<section class="slice bg-3">
        <div class="w-section inverse">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div class="w-section inverse">                       
                            <div class="w-box sign-in-wr bg-5">
                                
                                <div class="form-header">
                                    <h2>Masukan email untuk me-reset password</h2>
                                </div>
                                <div class="form-body">
                                    <p style="color:red">
                                     <?php echo $error; ?>
                                    </p>
                                    <form role="form" method="POST" action="<?php echo base_url()?>signin/changepasswordaction" class="form-light padding-15">
                                        <div class="form-group">
                                        <label>Password Baru</label>
                                        <input type="password" class="form-control" id="txtEmail" name="pass"  placeholder="Password baru">
                                        </div>

                                         <div class="form-group">
                                        <label>Ulangi Password Baru</label>
                                        <input type="password" class="form-control" id="txtEmail" name="repass"  placeholder="Password baru">
                                        </div>


                                         <label>Kode Keamanan</label>
                                         <?php 
                                        $this->load->helper('string');
                                        $this->load->helper('captcha'); ?>
                                        <?php

                                            $vals = array(
                                                'word'   =>   strtoupper(random_string('alnum', 6)),
                                                'img_path'   => './captcha/',
                                                'img_url'    => base_url().'captcha/',
                                                'img_width'  => 110,
                                                'img_height' => 60,
                                                 'font_path'  => base_url().'font/fontawesome-webfont.ttf',
                                                'expiration' => 500
                                                );

                                            $cap = create_captcha($vals);


                                        ?>
                                        <div class="form-group">
                                        <label><?php echo $cap['image'];?></label>
                                        <input type="hidden" name="id" value="<?php echo $id?>">
                                        <input type="text" class="form-control" id="txtEmail" name="cap"  placeholder="isi dengan huruf atau angka diatas">
                                        <input type="hidden" value="<?php echo $cap['word']?>" name="capword">
                                        </div>
										
                                       

                                        
										
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                
                                        
                                                <button type="submit" name="submit" value="submit" class="btn btn-two pull-right">Ubah</button>                      
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	