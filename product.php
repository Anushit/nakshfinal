<?php include('header.php');?>
<?php 
$id = $_GET['id'];
//echo $id;die;
$product = getData('product_detail',$id); 
$products = $product['data'];
//echo "<pre>";print_r($product);die;
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

 <nav data-depth="5" class="breadcrumb">
  <div class="container">
   <ol itemscope itemtype="http://schema.org/BreadcrumbList">

    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item" href="<?=BASE_PATH?>index">
      <span itemprop="name">Home</span>
     </a>
     <meta itemprop="position" content="1">
    </li>

    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item">
      <span itemprop="name "><?=$products['name']?></span>
     </a>
     <meta itemprop="position" content="2">
    </li>

   </ol>
  </div>
  
  <div class="category-cover hidden-sm-down">
   <img src="<?=getimage($bannerData['data'][0]['image'],'noimage')?>" class="img-fluid" alt="<?=$products['name']?>">
  </div>
 </nav>      

 <div class="container">

  <div class="row">

   <div id="content-wrapper" class="col-lg-12 col-xs-12">



    <section id="main" class="product-detail thumbs-bottom product-image-thumbs product-thumbs-bottom" itemscope itemtype="https://schema.org/Product">
     <meta itemprop="url" content="3-13-printed-dress.html#/1-size-s/13-color-orange"><div class="row"><div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12">
      <section class="page-content" id="content" data-templateview="bottom" data-numberimage="2" data-numberimage1200="2" data-numberimage992="3" data-numberimage768="4" data-numberimage576="4" data-numberimage480="3" data-numberimage360="2" data-templatemodal="1" data-templatezoomtype="in_scrooll" data-zoomposition="right" data-zoomwindowwidth="400" data-zoomwindowheight="400">

       <div class="images-container">

        <div class="product-cover">

         <!-- <ul class="product-flags">
          <li class="product-flag new">New</li>
         </ul> -->

         <img id="zoom_product" data-type-zoom="" class="js-qv-product-cover img-fluid" src="<?=getimage($products['image'],'noimage')?>" alt="" title="" itemprop="image">
         <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
         </div>
        </div>

      </section>

     </div>
     <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12">

      <h1 class="h1 product-detail-name Calibri" itemprop="name"><?=$products['name']?></h1>

      <div class="product-prices">

       <div
       class="product-price h5 "
       itemprop="offers"
       itemscope
       itemtype="https://schema.org/Offer"
       >
       <link itemprop="availability" href="https://schema.org/InStock"/>
       <meta itemprop="priceCurrency" content="USD">

     <!--   <div class="current-price">
        <span itemprop="price" content="25.99">Rs.<?=$products['price']?></span>

       </div> -->



      </div>

     </div>


     <div id="product-description-short-3" itemprop="description"><p><?=$products['description']?></p></div>
 
     </div>
     <h3 <?php if(empty($products['amazon_link']) && empty($products['filpcart_link'])) { ?>style="display: none;<?php }?>>Product available on <?php echo empty($products['amazon_link']) ? "" : "Amazon" ?> <?php echo empty($products['filpcart_link']) ? "" : "Flipkart" ?></h3>
     <p>
      <a href="<?=$products['amazon_link']?>" target="_blank" <?php if(empty($products['amazon_link'])) { ?>style="display: none;<?php }?>"><img src="<?=ADMIN_PATH?>assets/img/amazon.png"></a>

      <a href="<?=$products['filpcart_link']?>" target="_blank" <?php if(empty($products['filpcart_link'])) { ?>style="display: none;<?php }?>"><img src="<?=ADMIN_PATH?>assets/img/flip.png"></a>
      </p>   
    
     

    </section>



    
   </div>



  </div>
 </div>

</section>

<?php include('footer.php');?>