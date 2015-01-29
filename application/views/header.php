<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <title>INAPROC - Portal Pengadaan Nasional</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <!-- Required -->
    <link href="<?php echo base_url()?>assets/css/global-style.css" rel="stylesheet" type="text/css" media="screen">
    <!-- <link rel="icon" href="<?php echo base_url()?>images/favicon.png" type="image/png">LayerSlider stylesheet -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/layerslider/css/layerslider.css" type="text/css">


<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "9cce3116-5c94-4377-b1a1-be56fc4c8469", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ecdf0c974ce288f" async></script>
 -->

 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55118026-1', 'auto');
  ga('send', 'pageview');

</script>

<script type="text/javascript">
        var logo1 = "<?php print base_url(); ?>images/inaproc-logo-small.png";
        var logo2 = "<?php print base_url()?>images/<?php echo logoImage()?>";
    </script>

</head>
<body>

<div class="wrapper">

<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="top-header-menu">
                    <ul class="menu">
                        <?php if($this->session->userdata('lkpp_logged_user')) :?>
                        <li><a href="<?php echo base_url()?>eproc">Aplikasi eProc Lainnya</a></li>
                        <li><a href="<?php echo base_url()?>signin/logout">Logout</a></li> 
                    <?php else :?>
                        <li><a href="<?php echo base_url()?>signin">Login</a></li> 
                        <!-- <li><a href="<?php echo base_url()?>signin/register">Daftar</a></li>  -->
                    <?php endif?>                      
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header: Logo and Main Nav -->
<header class="rz_header">    
    <div id="navOne" class="navbar navbar-wp" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo-inaproc navbar-brand" href="<?php echo base_url()?>" title="INAPROC">
                   <!--  <img id="logo-inaproc" src="<?php echo base_url()?>images/inaproc-logo.png" alt="INAPROC"> -->
                    <img id="logo-inaproc" src="<?php echo base_url()?>images/<?php echo logoImage()?>" alt="INAPROC">
                </a>
            </div>


             <?php
            $menu = $this->uri->segment(1);
            $active1= $active2=$active3=$active4=$active5=$active6=$active7=$active8="";
            switch ($menu) {
                case 'home':
                    $active1 = "class='active'";
                    break;
                case 'pengadaan':
                    $active2 = "class='active'";
                    break;
                case 'link':
                    $active3 = "class='active'";
                    break;
                case 'daftarhitam':
                    $active4 = "class='active'";
                    break;
                case 'tentang-kami':
                    $active5 = "class='active'";
                    break;
                case 'berita':
                    $active6 = "class='active'";
                    break;
                case 'unduh':
                    $active7 = "class='active'";
                    break;
                 case 'lpse':
                    $active8 = "class='active'";
                    break;
                 case 'signin' || 'search':
                   //die('a');
                    break;
                default:
                    $active1 = "class='active'";
                    break;
            }
            $refLink = $this->db->order_by('order','asc')->get('ref_link')->result_array();

            ?>


            <div class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav navbar-rz">
                    <li <?php echo $active1?>>
                        <a href="<?php echo base_url()?>home">Beranda</a></li>
                    <li <?php echo $active2?>>
                        <a href="<?php echo base_url()?>pengadaan">Pengadaan</a></li>
                    <li <?php echo $active4?>>
                        <a href="<?php echo base_url()?>daftarhitam">Daftar Hitam</a></li>
                     <li <?php echo $active8?>>
                        <a href="<?php echo base_url()?>lpse/index/0/0/0">LPSE</a></li>
                    <li <?php echo $active7?>>
                        <a href="<?php echo base_url()?>unduh" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">Unduh</a>
                        <ul class="dropdown-menu">
                            <?php foreach ($refLink as $value) : ?>
                            <li><a href="<?php echo base_url()?>unduh/catagory/<?php echo $value['id']?>/<?php echo $value['title']?>"><?php echo $value['title']?></a></li>
                            <?php endforeach?>
                        </ul></li>
                    <li <?php echo $active6?>>
                        <a href="<?php echo base_url()?>berita">Berita</a></li>
                    <li <?php echo $active5?>>
                        <a href="<?php echo base_url()?>tentang-kami">Tentang Kami</a></li>
                    <li class="dropdown animate-click" data-animate="animated fadeInUp" style="z-index:500;">
                        <a href="#" class="dropdown-toggle dropdown-form-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                        <ul class="dropdown-menu dropdown-menu-user animate-wr">
                            <li id="dropdownForm">
                                <div class="dropdown-form">
                                    <form action="<?php echo base_url()?>search/action" method="POST" class="form-default form-inline p-15">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="ketik kata pencarian...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-two" type="submit">Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
               
            </div><!--/.nav-collapse -->
        </div>
    </div>
</header>   









