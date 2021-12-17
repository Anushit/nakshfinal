<?php require_once('config.php');


   //echo parse_url($_SERVER['REQUEST_URI'])['path']; exit; 
  $cat = explode('/',$_SERVER['PHP_SELF']);

  $page =  str_replace(".php", "", array_pop($cat));



   $header_setting = getData('setting');
   //echo "<pre>";print_r($header_setting);die;
   
   if(isset($header_setting['data']['meta_title']) && !empty($header_setting['data']['meta_title'])){
    $meta_title = $header_setting['data']['meta_title'];
   }
   if(isset($header_setting['data']['logo']) && !empty($header_setting['data']['logo'])){
       $logo = $header_setting['data']['logo'];
   }
   
     $filter = array(
           'table'=>'ci_categories',
           'sort'=>'sort_order',
           'order'=>'asc',
           'where'=> 'is_active=1'
       );  
     $categoryData = postData('allcategory', $filter);
     //echo "<pre>";print_r($categoryData);die;


$filter = array(
            'sort'=>'sort_order',
            'start'=>'0',
            'limit'=>'10',
            'where' =>'is_active=1'
        );  
$productData = postData('productlist',$filter);
//print_r($productData);die;

   ?>
<!doctype html>
<html lang="en"  class="default" >
   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title><?=$meta_title?></title>
      <meta name="description" content="">
      <meta name="keywords" content="">
      
     
     
       <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>css/styles.css">

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/vnd.microsoft.icon" href="<?=ADMIN_PATH.$header_setting['data']['favicon']; ?>">
      <link rel="shortcut icon" type="image/x-icon" href="<?=ADMIN_PATH.$header_setting['data']['favicon']; ?>"> 
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
      
      
   

    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>css/j-sliding-banner.min.css">
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="<?=BASE_PATH?>js/jquery.min.js"></script>


  
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>css/j-sliding-banner.min.css">

   <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>css/style.css">

    <script type="text/javascript">
  $('#container').imagesLoaded( function() {
  $('.banner').jSlidingBanner({ slideAnimationSpeed : 500 });
});
</script>
  <style type="text/css">
  .content{
    color:white;
    width: 100%;
    text-align: center;
    position: absolute;
    top: 50%;
    transform:translateY(-50%);
  }
.sliding-banner-container { height:100%;}
  </style>



<script type="text/javascript">
  $('#container').imagesLoaded( function() {
  $('.banner').jSlidingBanner({ slideAnimationSpeed : 500 });
});
</script>
  <style type="text/css">
  .content{
    color:white;
    width: 100%;
    text-align: center;
    position: absolute;
    top: 50%;
    transform:translateY(-50%);
  }
.sliding-banner-container { height:100%;}
  </style>

   </head>

   <body id="index" class="lang-en country-us currency-usd layout-full-width page-index tax-display-enabled fullwidth">
      <main id="page">
      <header id="header" style="height: 96px;">
         <div class="header-container">
            <div class="header-banner">
               <div class="container">
                  <div class="inner"></div>
               </div>
            </div>
            <nav class="header-nav">
               <div class="topnav">
                  <div class="inner"></div>
               </div>
               <div class="bottomnav">
                  <div class="inner"></div>
               </div>
            </nav>
            <div class="header-top">
               <div class="inner">
                  <!-- @file modules\appagebuilder\views\templates\hook\ApRow -->
                  <div        class="row box-header ApRow  has-bg bg-boxed"
                     data-bg=" no-repeat"                style="background: no-repeat;"        >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                     <div    class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 col-sp-12 left-header ApColumn "
                        >
                        <!-- @file modules\appagebuilder\views\templates\hook\ApGenCode -->
                        <a href="<?=BASE_PATH?>index">     <img class="logo img-fluid" src="<?=ADMIN_PATH.$logo?>" alt="Leo Koreni" style="max-width: 240px;margin-left: 41px;"></a>
                     </div>
                     <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                     <div    class="col-xl-8 col-lg-8 col-md-6 col-sm-4 col-xs-4 col-sp-4 center-header ApColumn "
                        >
                        <!-- @file modules\appagebuilder\views\templates\hook\ApSlideShow -->
                        <div id="memgamenu-form_3939178485114183" class="ApMegamenu">
                           <nav data-megamenu-id="3939178485114183" class="leo-megamenu cavas_menu navbar mb-0 disable-canvas " role="navigation">
                              <!-- Brand and toggle get grouped for better mobile display -->
                              <div class="navbar-header">
                                 <button id="btn_toggle" type="button" class="navbar-toggler hidden-lg-up" >
                                 <span class="sr-only">Toggle navigation</span>
                                 &#9776;
                                 </button>
                              </div>
                              <!-- Collect the nav links, forms, and other content for toggling -->
                              <div class="leo-top-menu collapse navbar-toggleable-md megamenu-off-canvas megamenu-off-canvas-3939178485114183">
                                 <ul class="nav navbar-nav megamenu horizontal">
                                                  
                                
                                 <li class="nav-item  <?php echo $page =="index" ? "active" : null; ?> "><a href="<?=BASE_PATH?>index" target="_self" class="nav-link has-category"><span class="menu-title Calibri" >Home</span></a>
                                 </li>
                                 <li class="nav-item <?php echo $page =="about" ? "active" : null; ?> " ><a href="<?=BASE_PATH?>about" target="_self" class="nav-link has-category"><span class="menu-title Calibri">About Us</span></a>
                                 </li>
                                 <li class="nav-item parent dropdown" id="pro-drop">
                                    <a class="nav-link dropdown-toggle has-category" data-toggle="dropdown" target="_self"><span class="menu-title Calibri">Products</span>
                                    </a>
                                    <b class="caret"></b>
                                    <div class="dropdown-menu level1">
                                       <div class="dropdown-menu-inner">
                                          <div class="row">
                                             <div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu" >
                                                <div class="inner">
                                                   <ul>
                                                      <?php if(!empty($productData['data'])){
                                                         foreach ($productData['data'] as $key => $pvalue) { ?>
                                                       
                                                      <li class="nav-item">
                                                         <a class="nav-link" href="<?=BASE_PATH?>product/<?=$pvalue['slug']?>" target="_self"><span class="menu-title Calibri"><?=$pvalue['name']?></span></a>
                                                      </li>
                                                      <?php }} ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    </li>
                                    <li class="nav-item   <?php echo ($page =="career" ? "active" : null); ?> " ><a href="<?=BASE_PATH?>career" target="_self" class="nav-link has-category"><span class="menu-title Calibri">Career</span></a>
                                    </li>
                                    <li class="nav-item    <?php  echo ($page =="gallery" ? "active" : null); ?> " ><a href="<?=BASE_PATH?>gallery" target="_self" class="nav-link has-category"><span class="menu-title Calibri">Gallery</span></a>
                                    </li>
                                    <li class="nav-item"><a href="<?=BASE_PATH?>index#contact" target="_self" class="nav-link has-category"><span class="menu-title Calibri">Contact</span>
                                    </a>
                                    </li>
                                    </ul>
                              </div>
                           </nav>
                        </div>
                     </div>
                     <div  class="col-xl-2 col-lg-2 col-md-6 col-sm-8 col-xs-8 col-sp-8 right-header ApColumn ">
                    <form method="get" action="<?=BASE_PATH?>products">
                    <input type="text" class="test" name="search" placeholder="Search Products..">
                  </form>
                     </div>
                   
                     </div>
                  </div>
               </div>
            </div>

     
      </header>

