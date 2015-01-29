<section class="pg-opt pin">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Rubah Password</h2>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<!-- <li><a href="#">Home</a></li> -->
					<li>Rubah Password</li>
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
                                    <h2>Masukkan Email Anda untuk merubah Password</h2>
                                </div>
                                <div class="form-body">
                                    <p style="color:red">
                                     <?php echo $error; ?>
                                    </p>
                                    <form role="form" method="POST" action="#" class="form-light padding-15">
                                        <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="txtEmail" name="email"  placeholder="Email">
                                        </div>
										
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" name="submit" value="submit" class="btn btn-two pull-right">Kirim</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <!-- <div class="form-footer">
                                    <p>Lupa password? Klik <a href="<?php echo base_url()?>reset">Recovery</a></p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	