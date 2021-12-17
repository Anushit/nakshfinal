<?php include('header.php');
   $filter = array(
       'table'=>'ci_banners',
       'sort'=>'sort_order',
       'order'=>'asc',
       'start'=>'0',
       'limit'=>'2',
       'where'=> 'is_active=1'
   );  
   $bannerData = postData('listing', $filter); 
   //echo "<pre>"; print_r($bannerData);die;
      $filter = array( 
       'sort'=>'p.sort_order',
       'order'=>'asc',
       'start'=>'0',
       'limit'=>'4',
       'where'=> 'is_active=1'
   );  
   $productData = postData('productlist', $filter); 
//echo "<pre>";print_r($productData);die;
   
   
    $filter = array(
       'table'=>'ci_services',
       'sort'=>'sort_order',
       'order'=>'asc',
       'start'=>'0',
       'limit'=>'10',
       'where'=> 'is_active=1'
   );  
   $serviceData = postData('listing', $filter); 
   
   $cms = getData('cms',11);
   $side_image = getData('sideimage',1);
   $home_about = getData('cms',12);
   if(isset($_POST['submit'])){ 
          $msg = '';
           if($msg==''){
            $data = $_POST;
            //echo "<pre>";print_r($data);die;
            $contactData = postData('saveinquery', $data);
            //echo "<pre>";print_r($contactData);die;
            $msg = $contactData['message'];
        } 
} 
   ?>
<section id="wrapper">
   <div class="row">
   <div id="content-wrapper" class="col-lg-12 col-xs-12">
      <section id="main">
         <section id="content" class="page-home">
            <div class="row ApRow">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                  >
                  <div id="slideshow-form_9130001240190224" class="ApSlideShow">
                     <div class="bannercontainer banner-fullwidth" style="padding: 0;margin: 0;">
                        <div class="iview iview-group-61738450a058f-6">
                           <?php if(!empty($bannerData['data'])){
                              foreach ($bannerData['data'] as $key => $bvalue) { ?>
                           <!-- SLIDE IMAGE BEGIN -->
                           <div class="slide_config "
                              data-leo_image="<?=getimage($bvalue['image'],'noimage.png') ?>"											
                              data-leo_pausetime="5000"
                              data-leo_thumbnail="<?=getimage($bvalue['image'],'noimage.png') ?>"
                              data-leo_background="image">
                              <div class="tp-caption  very_large_text" 
                                 data-x="975"
                                 data-y="190"
                                 data-transition="fade"
                                 style="background-color:#fff;"									 >
                                 <h4>
                                 </p><?=$bvalue['title_first']?>
                                 <p>
                                    <a href="<?=BASE_PATH?>products" class="btn btn-inverse">Explore Our Product</a>
                                 </p>
                              </div>
                           </div>
                           <?php }} ?>  
                        </div>
                     </div>
                  
                  </div>
               </div>
            </div>
          <div class="wrapper" style="background: #f9f9f9 no-repeat">
               <div class="container">
                  <div class="row ApRow  has-bg bg-fullwidth-container" style="">
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12  ApColumn ">
                        <div class="block ApRawHtml">
                           <div class="service-box">
                              <div class="row">
                                 <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 col-sp-12">
                                    <div class="service-item mt-2">
                                          <h2><?=$cms['data']['cms_title']?></h2>
                                          <p><?=mb_strimwidth($home_about['data']['cms_contant'],0,600,'....')?></p> 
                                    </div>
                                 </div>
                                
                                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                                    <div class="service-item">
                                      
                                          <p>
                                             <img src="<?=getimage($side_image['data']['image'],'noimage')?>"width="200" height="150">
                                          </p>
                                     
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="wrapper"      >
               <div class="container">
                  <div        class="row ApRow  has-bg bg-boxed"
                     data-bg=" no-repeat"                style="background: no-repeat;"        >
                     <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                     <div    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                        >
                        <!-- @file modules\appagebuilder\views\templates\hook\ApProductCarousel -->
                        <div class="block products_block exclusive appagebuilder ApProductCarousel">
                           <h4 class="title_block">
                              Our Products
                           </h4>
                           <div class="sub-title-widget"><span>Our</span> Products</div>
                           <div class="block_content">
                              <!-- @file modules\appagebuilder\views\templates\hook\ProductOwlCarousel -->
                              <div class="owl-row">
                                 <div class="timeline-wrapper clearfix prepare"
                                    data-item="4" 
                                    data-xl="4" 
                                    data-lg="3" 
                                    data-md="3" 
                                    data-sm="2" 
                                    data-m="1"
                                    >
                                    <div class="timeline-parent">
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="timeline-parent">
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="timeline-parent">
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="timeline-parent">
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                       <div class="timeline-item">
                                          <div class="animated-background">
                                             <div class="background-masker content-top"></div>
                                             <div class="background-masker content-second-line"></div>
                                             <div class="background-masker content-third-line"></div>
                                             <div class="background-masker content-fourth-line"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="carousel-2453061249" class="owl-carousel owl-theme owl-loading profile-default">
                                    <?php if(!empty($productData['data'])){
                                       foreach ($productData['data'] as $key => $pvalue) { ?>
                                    <div class="item first">
                                       <article class="product-miniature js-product-miniature" data-id-product="1" data-id-product-attribute="1" itemscope itemtype="http://schema.org/Product">
                                          <div class="thumbnail-container">
                                             <div class="product-image">
                                                <a href="<?=BASE_PATH?>product/<?=$pvalue['slug']?>">
                                                   <img
                                                      class="img-fluid"
                                                      src = "<?=getimage($pvalue['image'],'noimage')?>"
                                                      alt = "Caraway"
                                                      data-full-size-image-url = "<?=getimage($pvalue['image'],'noimage')?>"
                                                      >
                                                   <span class="product-additional" data-idproduct="1"></span>
                                                   <div class="product-price-and-shipping">
                                                   </div>
                                                </a>
                                                <ul class="product-flags">
                                                   <li class="product-flag new">New</li>
                                                </ul>
                                             </div>
                                             <div class="product-meta">
                                                <!-- @file modules\appagebuilder\views\templates\front\products\file_tpl -->
                                                <h3 class="h3 product-title" itemprop="name"><a href="<?=BASE_PATH?>product/<?=$pvalue['id']?>"><?=$pvalue['name']?></a></h3>
                                                <!-- @file modulesappagebuilderviewstemplatesfrontproductsfile_tpl -->
                                                <div class="product-price-and-shipping ">
                                                   <span class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                   <span itemprop="priceCurrency" content="USD"></span><span itemprop="price" content="16.51">Rs.<?=$pvalue['price']?></span>
                                                   </span>
                                                </div>
                                                <div class="row">
                                                 <p>
                                             <a href="<?=$pvalue['amazon_link']?>" target="_blank"<?php if(empty($pvalue['amazon_link'])) { ?>style="display: none;<?php }?>"><img src="<?=ADMIN_PATH?>assets/img/amazon.png"></a>

                                             <a href="<?=$pvalue['filpcart_link']?>" target="_blank" <?php if(empty($pvalue['filpcart_link'])) { ?>style="display: none;<?php }?>"><img src="<?=ADMIN_PATH?>assets/img/flip.png"></a>
                                             </p>    
                                          </div>
                                                <!-- @file modules\appagebuilder\views\templates\front\products\file_tpl -->
                                                <!-- @file modules\appagebuilder\views\templates\front\products\file_tpl -->
                                             </div>
                                          </div>
                                       </article>
                                    </div>
                                    <?php }} ?>
                                 </div>
                                  				                			        
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- @file modules\appagebuilder\views\templates\hook\ApRow -->
               <div class="wrapper" style="background: url(https://demo4leotheme.com/prestashop/leo_koreni_demo/themes/leo_koreni/assets/img/modules/appagebuilder/images/home1-img1.jpg) no-repeat top center"     >
                  <div class="container">
                     <div        class="row ApRow  has-bg bg-fullwidth-container"
                        style=""        >
                        <!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->
                        <div    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                           >
                           <!-- @file modules\appagebuilder\views\templates\hook\ApCountdown -->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- @file modules\appagebuilder\views\templates\hook\ApRow -->
               <div id="contact" class="left-column col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 44px;">
                 <section id="main">
                   <section id="content" class="page-content card card-block">
                    <div style="background-color: white; border:0;">
                      <?php  
                      if(!empty($error)){
                       echo "<div class='alert alert-danger text-center'>".$error."</div>";
                    } 
                    if(!empty($msg)){
                      echo "<div class='alert alert-success text-center'>".$msg."</div>";
                   } 
                   ?>
                </div> 
                <section class="contact-form">
                  <form action="<?=BASE_PATH.'index'?>" method="post" id="contact-form">


                   <section class="form-fields">

                     <div class="form-group row">
                       <div class="col-md-9 col-md-offset-3">
                         <h3>Contact us</h3>
                      </div>
                   </div>

                   <div class="form-group row">
                    <label class="col-md-3 form-control-label">Name</label>
                    <div class="col-md-6">
                      <input  type="text" class="form-control" name="name" id="name" value=""  placeholder="Enter Your Name">
                   </div>
                </div>


                <div class="form-group row">
                 <label class="col-md-3 form-control-label">Email address</label>
                 <div class="col-md-6">
                   <input  type="email" class="form-control" name="email" id="email" value=""  placeholder="Enter Your Email">
                </div>
             </div>

             <div class="form-group row">
              <label class="col-md-3 form-control-label">Mobile</label>
              <div class="col-md-6">
                <input  type="text" class="form-control" name="mobile" id="mobile" value=""  placeholder="Enter Your Mobile">
             </div>
          </div>


          <div class="form-group row">
           <label class="col-md-3 form-control-label">Subject</label>
           <div class="col-md-6">
             <input  type="text" class="form-control" name="subject" id="subject" value=""  placeholder="Enter Your Subject">
          </div>
       </div>


       <div class="form-group row">
        <label class="col-md-3 form-control-label">Message</label>
        <div class="col-md-9">
          <textarea
          class="form-control"
          name="message" id="message"
          placeholder="How can we help?"
          rows="3"
          ></textarea>
       </div>
    </div>
    <button type="submit" name="submit" class="btn btn-inverse submit-button submitData">Send Message</button>
 </section>
</form>
</section>
</section>
</section>
               </div>
         </section>
      </section>
      </div>
   </div>
</section>
<?php include('footer.php');?>

<script type="text/javascript"> 
        //Refresh Captcha
        jQuery(document).ready(function(){

            jQuery(document).on("click", ".submitData", function(e){  
            if (jQuery("#contact-form").valid()) { 
                // alert("asdf");
                jQuery("#contact-form").submit();
            }
        });

        jQuery("#contact-form").validate({
            rules: {
                name: "required",
                email: {required: true, email: true},
                mobile: {
                    required: true, 
                    number: true,
                    minlength:10,
                    maxlength:10,
                },
                subject: "required",
                message: "required", 
            },
            messages: {
                name: "Please Enter Full Name",
                email: { 
                  "required": "Please Enter Email Address",
                  "email": "Please Enter Valid Email Address",
                },
                mobile: { 
                  "required": "Please Enter Mobile No.",
                  "number": "Please Enter Valid Mobile No",
                  "minlength": "Mobile No Should Be 10 Digits",
                  "maxlength": "Mobile No Should Be 10 Digits",
                },
                subject: "Please Enter Subject",
                message: "Please Enter Message",  
            }
        }); 

        });
  


                        ap_list_functions.push(function(){
                        
                           jQuery(".iview-group-61738450a058f-6").iView({
                        // COMMON
                        pauseTime:9000, // delay
                        startSlide:0,
                        autoAdvance: 1,   // enable timer thá»�i gian auto next slide
                        pauseOnHover: 1,
                        randomStart: 0, // Ramdom slide when start
                        
                        // TIMER
                        timer: "360Bar",
                        timerPosition: "middle", // Top-right, top left ....
                        timerX: 10,
                        timerY: 10,
                        timerOpacity: 0.5,
                        timerBg: "#000",
                        timerColor: "#EEE",
                        timerDiameter: 30,
                        timerPadding: 4,
                        timerStroke: 3,
                        timerBarStroke: 1,
                        timerBarStrokeColor: "#EEE",
                        timerBarStrokeStyle: "solid",
                        playLabel: "Play",
                        pauseLabel: "Pause",
                        closeLabel: "Close", // Muli language
                        
                        // NAVIGATOR controlNav
                        controlNav: 1, // true : enable navigate - default:'false'
                        keyboardNav: 1, // true : enable keybroad
                        controlNavThumbs: 0, // true show thumbnail, false show number ( bullet )
                        controlNavTooltip: 0, // true : hover to bullet show thumnail
                        tooltipX: 5,
                        tooltipY: -5,
                        controlNavHoverOpacity: 1, // opacity navigator
                        
                        // DIRECTION
                        controlNavNextPrev: false, // false dont show direction at navigator
                        directionNav: 1, // true  show direction at image ( in this case : enable direction )
                        directionNavHoverOpacity: 1, // direction opacity at image
                        nextLabel: "Next",            // Muli language
                        previousLabel: "Previous", // Muli language
                        
                        // ANIMATION 
                        fx: 'random', // Animation
                        animationSpeed: 500, // time to change slide
                        //    strips: 20,
                        strips: 1, // set value is 1 -> fix animation full background
                        blockCols: 10, // number of columns
                        blockRows: 5, // number of rows
                        
                        captionSpeed: 500, // speed to show caption
                        captionOpacity: 1, // caption opacity
                        captionEasing: 'easeInOutSine', // caption transition easing effect, use JQuery Easings effect
                        customWidth: 1920,
                        customHtmlBullet: false,
                        rtl: false,
                        height:750,
                        timer_show : 1,
                        
                        
                        onAfterLoad: function() 
                        {
                        // THUMBNAIL
                        $('.iview-group-61738450a058f-6 .iview-controlNav a img').height(30);
                        //$('.iview-group-61738450a058f-6 .iview-tooltip').height(30);
                        $('.iview-group-61738450a058f-6 .iview-controlNav a img').width(30);
                        //$('.iview-group-61738450a058f-6 .iview-tooltip').width(30);
                        
                        // BULLET
                        $('.iview-group-61738450a058f-6 .iview-tooltip div.holder div.container div img').width(30);
                        $('.iview-group-61738450a058f-6 .iview-tooltip div.holder div.container div img').height(30);
                        
                        // Display timer
                        $('.iview-group-61738450a058f-6 .iview-timer').hide();
                        },
                        
                        });
                        
                           $(".img_disable_drag").bind('dragstart', function() {
                              return false;
                           });
                        
                        
                        // Fix : Slide link, image cant swipe
                        // step 1
                        var link_event = 'click';
                        
                        // step 3
                        $(".iview-group-61738450a058f-6 .slide_config").on("click",function(){
                        
                        if(link_event !== 'click'){
                        link_event = 'click';
                        return;
                        }
                        
                        if($(this).data('link') != undefined && $(this).data('link') != '') {
                        window.open($(this).data('link'),$(this).data('target'));
                        }
                        
                        });
                        
                        // step 2
                        $(".iview-group-61738450a058f-6 .slide_config").on('swipe',function(){
                        link_event = 'swiped';  // do not click event
                        });
                        });
                        

                                    ap_list_functions.push(function(){
                                       if($('#carousel-2453061249').parents('.tab-pane').length)
                                       {     
                                          if(!$('#carousel-2453061249').parents('.tab-pane').hasClass('active'))
                                          {
                                             var width_owl_active_tab = $('#carousel-2453061249').parents('.tab-pane').siblings('.active').find('.owl-carousel').width();     
                                             $('#carousel-2453061249').width(width_owl_active_tab);
                                          }
                                       }
                                       $('#carousel-2453061249').imagesLoaded( function() {
                                          $('#carousel-2453061249').owlCarousel({
                                             items :             4,
                                             itemsDesktop :      [1200,4],
                                             itemsDesktopSmall : [992,3],
                                             itemsTablet :       [768,2],
                                             itemsMobile :       [576,1],
                                             itemsCustom :       [[1199,4],[1024,4],[992,3],[768,3],[481,2],[0,1]],
                                    singleItem :        false,       // true : show only 1 item
                                    itemsScaleUp :      false,
                                    slideSpeed :        200,        //  change speed when drag and drop a item
                                    paginationSpeed :   800,       // change speed when go next page
                                    autoPlay :          false,       // time to show each item
                                    stopOnHover :       false,
                                    navigation :        false,
                                    navigationText :    ["&lsaquo;", "&rsaquo;"],
                                    scrollPerPage :     false,
                                    pagination :        false,       // show bullist
                                    paginationNumbers : false,       // show number
                                    responsive :        true,
                                    responsiveRefreshRate : 0,
                                    lazyLoad :          false,
                                    lazyFollow :        false,       // true : go to page 7th and load all images page 1...7. false : go to page 7th and load only images of page 7th
                                    lazyEffect :        "fade",
                                    autoHeight :        false,
                                    mouseDrag :         true,
                                    touchDrag :         true,
                                    addClassActive :    true,
                                    direction:          false,
                                    afterInit: OwlLoaded,
                                    afterAction : SetOwlCarouselFirstLast,
                                    });
                                       });
                                    });
                                    function OwlLoaded(el){
                                       el.removeClass('owl-loading').addClass('owl-loaded').parents('.owl-row').addClass('hide-loading');
                                       if ($(el).parents('.tab-pane').length && !$(el).parents('.tab-pane').hasClass('active'))
                                          el.width('100%');
                                    };
                                    
</script>  