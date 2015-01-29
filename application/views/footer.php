<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	&copy; Lembaga Kebijakan Pengadaan Barang/Jasa Pemerintah - Indonesia (LKPP)
			</div>
		</div>
    </div>
</footer>

<!-- JavaScript -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/scrolling-nav.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/css/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/modernizr.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.easing.js"></script>

<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
<![endif]-->

<?php if($this->uri->segment(1)=='pengadaan') : ?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    var availableTags = <?php echo $lpseJson?>

    $( "#autoLPSE" ).autocomplete({
      source: availableTags
    });
  });
  </script>
<?php endif?>

<!-- Plugins -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/masonry.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.ui.totop.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.mixitup.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.mixitup.init.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/css/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/css/easy-pie-chart/jquery.easypiechart.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.sticky.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.wp.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.wp.switcher.js"></script>
<script src="<?php echo base_url()?>assets/css/layerslider/js/greensock.js" type="text/javascript"></script>
<!-- LayerSlider script files -->
<script src="<?php echo base_url()?>assets/css/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/css/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
<!-- Initializing the slider -->
	<script>
		jQuery("#layerslider").layerSlider({
			pauseOnHover: true,
			autoPlayVideos: false,
			skinsPath: '<?php echo base_url()?>assets/css/layerslider/skins/',
			responsive: false,
			responsiveUnder: 1280,
			layersContainer: 1280,
			skin: 'borderlessdark3d',
			hoverPrevNext: false,
		});
	</script>

	<script>
	function fadeList() {
		$("#pengadaan_box").fadeOut();
		$("#pengadaan_list").fadeIn();	
	}
	
	function fadeBox() {
		$("#pengadaan_box").fadeIn();
		$("#pengadaan_list").fadeOut();
	}
   </script>

   <script type="text/javascript">
		var baseurl = "<?php print base_url(); ?>";
	</script>
</body>
</html>