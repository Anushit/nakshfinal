<?php $header_setting = getData('setting');
   $facebook_link = $header_setting['data']['facebook_link'];
   $twitter_link = $header_setting['data']['twitter_link'];
   $instagram_link = $header_setting['data']['instagram_link'];
   $youtube_link = $header_setting['data']['youtube_link'];
   if(isset($header_setting['data']['whatsapp_button']) && !empty($header_setting['data']['whatsapp_button'])){
       $whatsapp_button = $header_setting['data']['whatsapp_button'];
   }
   ?>
<footer id="footer" class="footer-container">
   <div class="footer-top">
      <div class="container">
         <div class="inner"></div>
      </div>
   </div>
   <div class="footer-center">
      <div class="inner">
         <div class="wrapper"      >
            <div class="container">
               <div  class="row leo-footer-center ApRow  has-bg bg-boxed"
                  data-bg=" no-repeat"      style="background: no-repeat;"        >
                  <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                  <div    class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                     >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApGeneral -->
                     <div     class="block block-toggler ApHtml accordion_small_screen">
                        <div class="title clearfix" id="about-drop" data-target="#footer-html-form_3149379647154665" data-toggle="collapse">
                           <h4 class="title_block Calibri">About Us</h4>
                           <span class="float-xs-right">
                           <span class="navbar-toggler collapse-icons">
                           <i class="material-icons add">&#xE313;</i>
                           <i class="material-icons remove">&#xE316;</i>
                           </span>
                           </span>
                        </div>
                        <div class="collapse block_content" id="footer-html-form_3149379647154665">
                           <div class="aboutus-footer"><?=$header_setting['data']['meta_description']?></div>
                        </div>
                     </div>
                
                     <!-- @file modules\appagebuilder\views\templates\hook\ApModule -->
                     <div class="block-social block links accordion_small_screen">
                        <div class="title clearfix hidden-md-up" id="social-drop" data-target="#footer_block_social" data-toggle="collapse">
                           <span class="h3 title_block Calibri">Our Social</span>
                           <span class="float-xs-right">
                           <span class="navbar-toggler collapse-icons">
                           <i class="material-icons add">&#xE313;</i>
                           <i class="material-icons remove">&#xE316;</i>
                           </span>
                           </span>
                        </div>
                        <ul class="collapse social" id="footer_block_social">
                           <li class="facebook" <?php if (empty($facebook_link)){?>style="display:none"<?php }?>><a href="<?=$facebook_link?>" title="Facebook" target="_blank"><span>Facebook</span></a></li>
                           <li class="twitter" <?php if (empty($twitter_link)){?>style="display:none"<?php }?>><a href="<?=$twitter_link?>" title="Twitter" target="_blank"><span>Twitter</span></a></li>
                           <li class="youtube" <?php if (empty($youtube_link)){?>style="display:none"<?php }?>><a href="<?=$youtube_link?>" title="YouTube" target="_blank"><span>YouTube</span></a></li>
                           <li class="instagram" <?php if (empty($instagram_link)){?>style="display:none"<?php }?>><a href="<?=$instagram_link?>" title="Instagram" target="_blank"><span>Instagram</span></a></li>
                        </ul>
                     </div>
                  </div>
                  <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                  <div    class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                     >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApBlockLink -->
                     <div class="block block-toggler ApLink ApBlockLink accordion_small_screen" >
                        <div class="title clearfix" id="inform-drop"  data-target="#footer-link-form_9853452960881892" data-toggle="collapse">
                           <h4 class="title_block Calibri">
                              Information
                           </h4>
                           <span class="float-xs-right">
                           <span class="navbar-toggler collapse-icons">
                           <i class="material-icons add">&#xE313;</i>
                           <i class="material-icons remove">&#xE316;</i>
                           </span>
                           </span>
                        </div>
                        <ul class="collapse info" id="footer-link-form_9853452960881892">
                           <li><a href="<?=BASE_PATH?>index" target="_self">Home</a></li>
                           <!-- 
                              <li><a href="<?=BASE_PATH?>portfolio" target="_self">Portfolio</a></li> -->
                           <li><a href="<?=BASE_PATH?>career" target="_self">Career</a></li>
                           <li><a href="<?=BASE_PATH?>gallery" target="_self">Image and Gallery</a></li>
                        </ul>
                     </div>
                  </div>
                  <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                  <div    class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                     >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApBlockLink -->
                     <div class="block block-toggler ApLink ApBlockLink accordion_small_screen">
                        <div class="title clearfix" id="footer-drop" data-target="#footer-link-form_9853452960881892" data-toggle="collapse" >
                           <h4 class="title_block Calibri">
                              Useful Links
                           </h4>
                           <span class="float-xs-right">
                           <span class="navbar-toggler collapse-icons">
                           <i class="material-icons add">&#xE313;</i>
                           <i class="material-icons remove">&#xE316;</i>
                           </span>
                           </span>
                        </div>
                        <ul class="collapse dropdown-fot" >
                           <li><a href="<?=BASE_PATH?>service" target="_self">Services</a></li>
                           <li><a href="<?=BASE_PATH?>about" target="_self">About</a></li>
                           <li><a href="<?=BASE_PATH?>terms" target="_self">Terms & Policy </a></li>
                        </ul>
                     </div>
                  </div>
                  <div    class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                     >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApGeneral -->
                     <div  class="block block-toggler ApHtml accordion_small_screen">
                        <div class="title clearfix" id="contact-drop" data-target="#footer-html-form_3149379647154665" data-toggle="collapse">
                           <h4 class="title_block Calibri">Contact Us</h4>
                           <span class="float-xs-right">
                           <span class="navbar-toggler collapse-icons">
                           <i class="material-icons add">&#xE313;</i>
                           <i class="material-icons remove">&#xE316;</i>
                           </span>
                           </span>
                        </div>
                        <div class="collapse block_content" id="footer-html-form_3149379647154665">
                           <div class="aboutus-footer">Please contact with our marwari masala team below given details.</div>
                        </div>
                     </div>
                     <div class="block-contact block links accordion_small_screen">
                        <p class="h4 title_block block-contact-title hidden-xl-down">Main office</p>
                        <ul class="collapse block_content" id="footer_block_contact">
                           <li class="address" <?php if (empty($header_setting['data']['address'])){?>style="display:none"<?php }?>><i class="ti-location-pin"></i><span><?=$header_setting['data']['address']?></span></li>
                           <li class="phone" <?php if (empty($header_setting['data']['phone'])){?>style="display:none"<?php }?>>
                              <i class="ti-mobile"></i>
                              <span><?=$header_setting['data']['phone']?></span>
                           </li>
                           <li class="email">
                              <i class="ti-email" <?php if (empty($header_setting['data']['email'])){?>style="display:none"<?php }?>></i>
                              <span><?=$header_setting['data']['email']?></span>
                           </li>
                        </ul>
                     </div>
                     <!-- @file modules\appagebuilder\views\templates\hook\ApModule -->
                  </div>
               </div>
            </div>
         </div>
         <!-- @file modules\appagebuilder\views\templates\hook\ApRow -->
         <div class="wrapper"      >
            <div class="container">
               <div        class="row footer-copyright ApRow  "
                  style=""        >
                  <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                  <div    class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                     >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApGeneral -->
                     <div     class="block ApRawHtml">
                        <div class="copyright"><?=$header_setting['data']['copyright']?> | Developed By : <a href="https://adiyogitechnosoft.com" target="_blank" style="color:white;">Adiyogi Technosoft</a></div>
                     </div>
                  </div>
                  <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                  <div    class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                     >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApBlockLink -->
                     <div class="block ApLink ApBlockLink">
                        <ul>
                           <li><a href="<?=BASE_PATH?>index" target="_self">Home</a></li>
                           <!-- <li><a href="<?=BASE_PATH?>contact" target="_self">Contact Us</a></li> -->
                           <li><a href="<?=BASE_PATH?>about" target="_self">About Us</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="footer-bottom">
      <div class="container">
         <div class="inner"></div>
      </div>
   </div>
   <!-- Live Theme Editor -->
   <div id="back-top" style="right: 30px;
      bottom: 80px;"><a href="#" class="fa fa-angle-double-up"></a></div>
</footer>
<div id="gb-widget" class="<?php echo ($whatsapp_button != "")?"":"hide"; ?>">
   <?=$whatsapp_button?>
</div>
</main>



<script type="text/javascript" src="<?=BASE_PATH?>js/j-sliding-banner.js"></script>
<script type="text/javascript" src="<?=BASE_PATH?>js/j-sliding-banner.min.js"></script>

<script type="text/javascript" src="https://demo4leotheme.com/prestashop/leo_koreni_demo/themes/leo_koreni/assets/cache/bottom-cea4248.js" ></script>
   


       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://npmcdn.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script src="<?=BASE_PATH?>js/j-sliding-banner.min.js"></script>

     <script type="text/javascript">
   $('body').imagesLoaded( function() {
  $('.banner').jSlidingBanner({ slideAnimationSpeed : 500 });
});
</script>

<script>

$("#btn_toggle").click(function(){
   $(".navbar-toggleable-md").toggleClass('collapse');
   
   $(".navbar-toggleable-md").toggleClass('in');

   /*$(".parent dropdown").toggleClass('open');*/
});

// $("#pro-drop").click(function(){
//    //alert("hey");
//   $(".dropdown-menu").toggleClass("d-block");
// });


$("#footer-drop").click(function(){
   //alert("hey");
  $(".dropdown-fot").toggleClass("d-block");
});

$("#contact-drop").click(function(){
   //alert("hey");
  $(".block_content").toggleClass("d-block");
});

$("#about-drop").click(function(){
  // alert("hey");
  $(".block_content").toggleClass("d-block");
});

$("#social-drop").click(function(){
  // alert("hey");
  $(".social").toggleClass("d-block");
});
$("#inform-drop").click(function(){
  // alert("hey");
  $(".info").toggleClass("d-block");
});
</script>



<div class="leo-fly-cart-mask"></div>
<div class="leo-fly-cart-slidebar slidebar_bottom">
   <div class="leo-fly-cart disable-dropdown">
      <div class="leo-fly-cart-wrapper">
         <div class="leo-fly-cart-icon-wrapper">
            <a href="javascript:void(0)" class="leo-fly-cart-icon"><i class="material-icons">&#xE8CC;</i></a>
            <span class="leo-fly-cart-total"></span>
         </div>
         <div class="leo-fly-cart-cssload-loader"></div>
      </div>
   </div>
</div>
</body>
</html>