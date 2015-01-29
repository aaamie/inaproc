<section id="slider-wrapper" class="layer-slider-wrapper">
    <div id="layerslider" class="main-slider">        


        <?php foreach ($newsSlider as  $value) :?>
        <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
            <!-- slide background -->
            <img src="<?php echo base_url()?>images/slider/fw-1.jpg" class="ls-bg" alt="Slide background"/>
            
       
            <!-- Right Image -->
              <img src="<?php echo base_url()?>uploads/news/<?php echo $value['file_image_slider']?>" class="ls-l" data-ls="offsetxin:0;offsetyin:250;durationin:950;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;" alt="Image layer">
          
            <!-- <img src="<?php echo base_url()?>images/bnr-slider.png" class="ls-l" style="top:58%; left:70%;" data-ls="offsetxin:0;offsetyin:250;durationin:950;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;" alt="Image layer">
             -->
            <!-- Left Text -->
            
            <h3 class="ls-l title" style="width:500px; top:25%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;"></h3>
            <h3 class="ls-l subtitle" style="top:40%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:1500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;"><?php echo $value['title']?></h3>
            <p class="ls-l text-standard" style="width:500px; top:58%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:2500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
               <?php echo strip_tags(word_limiter($value['content'],10)); ?>
            </p>
            <a href="<?php echo base_url()?>berita/detail/<?php echo $value['id']?>" class="btn btn-two btn-lg ls-l" style="top:78%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:3500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;" target="_blank">Selengkapnya</a>
           
        </div>
         <?php endforeach;?>
        

        <?php foreach ($homebanner as  $value) :?>
        <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
            <!-- slide background 
            <img src="<?php echo base_url()?>images/slider/fw-1.jpg" class="ls-bg" alt="Slide background"/>-->
            
            

            <!-- Right Image -->
            <img src="<?php echo base_url()?>uploads/gambar_banner/<?php echo $value['file_image']?>" class="ls-l" data-ls="offsetxin:0;offsetyin:250;durationin:950;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;" alt="Image layer">
            
            <!-- Left Text -->
            <h3 class="ls-l title" style="width:500px; top:25%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;"></h3>
            <h3 class="ls-l subtitle" style="top:40%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:1500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;"><?php echo $value['title']?></h3>
            <p class="ls-l text-standard" style="width:500px; top:58%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:2500;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;">
               <?php echo strip_tags(word_limiter($value['content'],10)); ?>
            </p>
            <?php if($value['link'] && $value['link']!='#'){ ?>
            <a href="<?php echo $value['link']?>" class="btn btn-two btn-lg ls-l" style="top:84%; left:80px;" data-ls="offsetxin:0;offsetyin:250;durationin:1000;delayin:4000;offsetxout:0;offsetyout:-8;easingout:easeInOutQuart;scalexout:1.2;scaleyout:1.2;" target="_blank">Detail</a>
            <?php } ?>
        </div>
        <?php endforeach?>

    </div>
</section>