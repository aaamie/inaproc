<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4>Registrasi</h4>
			</div>
		</div>
	</div>
</section>

<section class="slice bg-3">
        <div class="w-section inverse">
            <div class="container">
                
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
                        <div class="w-section inverse">                       
                            <div class="w-box sign-in-wr bg-5">
                                
                                <div class="form-header">
                                    <h2>Lengkapi Data Anda</h2>
                                </div>
                                <div class="form-body">
                                    <h5>Mohon lengkapi data di bawah ini untuk registrasi akun Anda.</h5>
									<p class="small">Input yang ditandai bintang(*) wajib diisi.</p>
                                    <div style="color:red">
                                     <?php echo $error; ?>
                                    </div>
                                    <form class="form-light padding-15" method="POST" action="<?php echo base_url()?>signin/registerAction">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username*</label>
                                                    <input type="text" class="form-control" name="username"  value="<?php echo $this->session->flashdata('username')?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Lengkap*</label>
                                                    <input type="text" class="form-control" name="fullname" value="<?php echo $this->session->flashdata('fullname')?>">
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat Email*</label>
                                                    <input type="text" class="form-control" name="email" value="<?php echo $this->session->flashdata('email')?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No KTP / NIK*</label>
                                                    <input type="text" class="form-control" name="id_no" value="<?php echo $this->session->flashdata('id_no')?>">
                                                </div>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ulangi Password*</label>
                                                    <input type="password" class="form-control" name="password_confirm">
                                                </div>
                                            </div>
                                        </div> 
										
										

                                        <?php 
                                        $this->load->helper('string');
                                        $this->load->helper('captcha'); ?>
                                        <?php

                                            $vals = array(
                                                'word'   =>  random_string('alnum', 4),
                                                'img_path'   => './captcha/',
                                                'img_url'    => base_url().'captcha/',
                                                'img_width'  => '110',
                                                'img_height' => 60,
                                                'font_path'  => base_url().'font/Asap-Regular.ttf',
                                                'expiration' => 500
                                                );

                                            $cap = create_captcha($vals);


                                        ?>


										<div class="row">
											<div class="form-group">
												<div class="col-md-12">
													<?php echo $cap['image'];?>

                                        <input type="text" value="" name="cap" id="txtPassword">
                                                     <input type="hidden" value="<?php echo $cap['word']?>" name="capword">
												</div>
											</div>
										</div>
										
										<div class="row mt-20">
											<div class="col-md-3 col-xs-hidden"></div>
											<div class="col-md-6">
												<button type="submit" class="col-md-12 col-xs-12 btn btn-two">Register</button>
											</div>
											<div class="col-md-3 col-xs-hidden"></div>
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