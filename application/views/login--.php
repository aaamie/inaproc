
<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Login</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!-- <li><a href="#">Home</a></li> -->
					<li>Login</li>
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
                                    <h2>Login dengan Username dan Password Anda</h2>
                                </div>
                                <div class="form-body">
                                    <p style="color:<?php echo $font?>">
                                     <?php echo $error; ?>
                                    </p>
                                    <form role="form" method="POST" action="<?php echo base_url()?>signin/submit" class="form-light padding-15">
                                        <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" id="txtEmail" name="username"  placeholder="username">
                                        </div>
										
                                        <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" id="txtPassword" placeholder="password">
                                        </div>
										
                                        <?php 
                                        $this->load->helper('string');
                                        $this->load->helper('captcha'); ?>
                                        <?php

                                            $vals = array(
                                                'word'       => strtoupper(random_string('alnum', 6)),
                                                'img_path'   => './captcha/',
                                                'img_url'    => base_url().'captcha/',
                                                'img_width'  => 110,
                                                'img_height' => 60,
                                                 'font_path' => base_url().'font/fontawesome-webfont.ttf',
                                                'expiration' => 500
                                                );

                                            $cap = create_captcha($vals);


                                        ?>

                                        <div class="form-group">
                                        <label><?php echo $cap['image'];?></label>
                                       
                                        <input type="text" value="" name="cap" id="txtPassword">
                                        </div>
										
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="checkbox"><input type="checkbox"> Remember me</label>                        
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" value="<?php echo $cap['word']?>" name="capword">

                                        
                                                <button type="submit" name="submit" value="submit" class="btn btn-two pull-right">Login</button>                      
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="form-footer">
                                    <p>Lupa password? Klik <a href="<?php echo base_url()?>signin/reset">Recovery</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	