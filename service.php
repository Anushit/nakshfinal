<?php include('header.php');


   $filter = array(
        'table'=>'ci_services',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'10',
        'where'=> 'is_active=1'
    );  
  $serviceData = postData('listing', $filter); 
  //echo "<pre>";print_r($serviceData);die;
      $filter = array(
        'table'=>'ci_banners',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'1',
        'where'=> 'is_active=1 && name="bannerall"'
    );  
    $bannerData = postData('listing', $filter); 


?>
<section id="wrapper">
 <nav data-depth="2" class="breadcrumb">
  <div class="container">
   <ol itemscope itemtype="http://schema.org/BreadcrumbList">

    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item" href="<?=BASE_PATH?>index">
      <span itemprop="name">Home</span>
     </a>
     <meta itemprop="position" content="1">
    </li>
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item" >
      <span itemprop="name">Services</span>
     </a>
     <meta itemprop="position" content="2">
    </li>

   </ol>
  </div>
  <div class="category-cover hidden-sm-down">
   <img src="<?=getimage($bannerData['data'][0]['image'],'noimage')?>" class="img-fluid" alt="Breadcrumb image">
  </div>
 </nav>
 <div class="container">
    <div id="blog-form_2848020214632399" class="block latest-blogs exclusive appagebuilder ApBlog">
      <div class="box-title">
        <h2 class="title_block Calibri">
          Latest Services
        </h2>
      </div>

      <div class="block_content"> 
        <!-- @file modules\appagebuilder\views\templates\hook\BlogOwlCarousel -->
        <div class="owl-row">

          <div class="timeline-wrapper clearfix prepare"
          data-item="3" 
          data-xl="3" 
          data-lg="3" 
          data-md="2" 
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
          </div>
        </div>
        <div id="carousel-3269356675" class="owl-carousel owl-theme owl-loading">
                      <?php if(!empty($serviceData['data'])){
                    foreach ($serviceData['data'] as $key => $svalue) { ?>
          <div class="item">
            <!-- @file modules\appagebuilder\views\templates\hook\BlogItem -->
            <div class="blog-container" itemscope itemtype="https://schema.org/Blog">
              <div class="left-block">
                <div class="blog-image-container">
                  <a class="blog_img_link" title="Nullam ullamcorper nisl quis ornare molestie" itemprop="url">
                    <img class="img-fluid" src="<?=getimage($svalue['image'],'noimage')?>" 
                    alt="Nullam ullamcorper nisl quis ornare molestie" 
                    title="Nullam ullamcorper nisl quis ornare molestie" 
                    width="370"             height="300"           itemprop="image" />
                  </a>
                </div>
              </div>
              <div class="right-block">
                <div class="blog-meta">
                  <h5 class="blog-title" itemprop="name"><a  title="Nullam ullamcorper nisl quis ornare molestie"><?=$svalue['name']?></a></h5>
                </div>
              </div>
            </div>
          </div>

<?php }} ?>
        </div>
      </div>
      <script type="text/javascript">
        ap_list_functions.push(function(){
          $('#carousel-3269356675').imagesLoaded( function() {
            $('#carousel-3269356675').owlCarousel({
              items :             3,
              itemsDesktop :      [1200,3],
              itemsDesktopSmall : [992,3],
              itemsTablet :       [768,2],
              itemsMobile :       [576,1],
              itemsCustom :       [[1199,3],[992,3],[768,2],[576,2],[0,1]],
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

        };

      </script>                                                   </div>
    </div>  
    </div>    
 </section>
<?php include('footer.php');?>
