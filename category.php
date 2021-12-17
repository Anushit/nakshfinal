<?php include('header.php');

$id = $_GET['id'];   
//echo $id;die;
$category = getData('category', $id);
//echo "<pre>"; print_r($category);die;
$limit = 12;
if (isset($_REQUEST['sort'])) {
    $sort = $_REQUEST['sort'];
} else {
    $sort = 'sort_order';
}
if (isset($_REQUEST['order'])) {
    $order = $_REQUEST['order'];
} else {
    $order = 'asc';
}
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {
    $page = 1;
}
 

$filter_data = array(
    'category_id'   => $id,  
    'sort'          => $sort,
    'order'         => $order,
    'start'         => ($page - 1) * $limit,
    'limit'         => $limit,

);
$product_total = postData('totalproduct', $filter_data);
//echo "<pre>";print_r($product_total);die;

$total_pages = ceil($product_total['data'] / $limit);
$results =  postData('allproducts',$filter_data);
//echo "<pre>";print_r($results);die;
$nurl = '';
if (isset($_REQUEST['sort'])) {
    $nurl .= '&sort=' . $_REQUEST['sort'];
}
if (isset($_REQUEST['order'])) {
    $nurl .= '&order=' . $_REQUEST['order'];
}

$purl = BASE_PATH.'category/'.$id.'';

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

 <nav data-depth="3" class="breadcrumb">
  <div class="container">
   <h1 class="h1 category-name"><?php echo $category['data']['name']; ?> </h1>
   <ol itemscope itemtype="http://schema.org/BreadcrumbList">

    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item" href="<?=BASE_PATH?>index">
      <span itemprop="name">Home</span>
     </a>
     <meta itemprop="position" content="1">
    </li>

    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item">
      <span itemprop="name"><?php echo $category['data']['name']; ?> </span>
     </a>
     <meta itemprop="position" content="3">
    </li>

   </ol>
  </div>
  
  <div class="category-cover hidden-sm-down">
   <img src="<?=getimage($bannerData['data'][0]['image'],'noimage')?>" class="img-fluid" alt="Vegetable">
  </div>
 </nav>      

 <div class="container">
  <div class="row">
   <div id="left-column" class="sidebar col-xs-12 col-sm-12 col-md-4 col-lg-3">
    <div class="block-categories block block-highlighted hidden-sm-down">
     <h4 class="title_block Calibri"><a  >Categories</a></h4>
     <div class="block_content">
      <ul class="category-top-menu">
       <li>
        <ul class="category-sub-menu">
                <?php  
                if(!empty($categoryData['data'])){
                foreach ($categoryData['data'] as $ckey => $cvalue) { ?>
                
          <li data-depth="0">
            <a class="<?php if($cvalue['slug']==$id){ echo 'active'; } ?>" href="<?=BASE_PATH?>category/<?=$cvalue['slug']?>"><?=$cvalue['name']?></a>
          </li>
          <?php } } ?>
       </ul>
     </li>
   </ul>
      </div>
     </div>
</div>
<div id="content-wrapper" class="left-column col-xs-12 col-sm-12 col-md-8 col-lg-9">
   <section id="main">
      <div class="block-category card card-block">
        
         <h1 class="h1 category-name Calibri"><?=$cvalue['name']?></h1>
         <div id="category-description" class="text-muted">
         </div>
      </div>
      <section id="products">
         <div id="">
            <div id="js-product-list-top" class="products-selection">
               <div class="row">
                  <div class="col-lg-6 col-md-3 hidden-sm-down total-products">
                     <div class="display">
                        <div id="grid" class="leo_grid selected"><a rel="nofollow" href="#" title="Grid"><i class="ti-view-grid" aria-hidden="true"></i></a></div>
                        <div id="list" class="leo_list "><a rel="nofollow" href="#" title="List"><i class="ti-view-list-alt" aria-hidden="true"></i></a></div>
                     </div>
                     <p class="products-counter hidden-md-down">There are <?=$product_total['data']?> products.</p>
                  </div>
              
               </div>
            </div>
         </div>
     
         <div id="">
            <div id="js-product-list">
               <div class="products">
                  <!-- Products list -->
                  <div class="product_list grid  profile-default ">
                     <div class="row">
   <?php 
   if(!empty($results['data'] )){ 
      foreach ($results['data'] as $rkey => $rvalue) { ?> 
<div class="ajax_block_product col-sp-12 col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4
   last-item-of-tablet-line
   last-item-of-mobile-line
   ">
   <article class="product-miniature js-product-miniature" data-id-product="4" data-id-product-attribute="16" itemscope="" itemtype="http://schema.org/Product">
      <div class="thumbnail-container">
         <div class="product-image">
            <!-- @file modules\appagebuilder\views\templates\front\products\file_tpl -->
            <a href="<?=BASE_PATH?>product/<?=$rvalue['slug']?>">
               <img class="img-fluid" src="<?=getimage($rvalue['image'],'default.png')?>" alt="Rosemary" data-full-size-image-url="<?=getimage($rvalue['image'],'default.png')?>">
               <span class="product-additional" data-idproduct="4"></span>
               <div class="product-price-and-shipping">
               </div>
            </a>
            <!-- @file modules\appagebuilder\views\templates\front\products\file_tpl -->
            <!-- <ul class="product-flags">
               <li class="product-flag new">New</li>
            </ul> -->
         
         </div>
         <div class="product-meta">
            <h2 class="h3 product-title" itemprop="name"><a href="cumin/4-16-printed-dress.html#/1-size-s/7-color-beige"><?=$rvalue['name']?></a></h2>
            <div class="product-price-and-shipping ">
               <span class="price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
              <!--  <span itemprop="priceCurrency" content="USD"></span><span itemprop="price" content="50.99">Rs.<?=$rvalue['price']?></span>
               </span> -->
            </div>
            <div class="product-description-short" itemprop="description">
               <p><?=$rvalue['sort_description']?></p>
            </div>
            <div class="row">
            <p>
           <a href="<?=$rvalue['amazon_link']?>" target="_blank" <?php if(empty($rvalue['amazon_link'])) { ?>style="display: none;<?php }?>"><img src="<?=ADMIN_PATH?>assets/img/amazon.png"></a>

            <a href="<?=$rvalue['filpcart_link']?>" target="_blank" <?php if(empty($rvalue['filpcart_link'])) { ?>style="display: none;<?php }?>" ><img src="<?=ADMIN_PATH?>assets/img/flip.png"></a>
            </p>    
         </div>
         </div>
      </div>
   </article>
</div>
<?php }}else{
  echo "NO Record Found";
} ?>

</div>
</div>
               
</div>
<nav class="pagination">
  <div class="col-xs-12 col-md-6 col-lg-5 text-md-left text-xs-center">
    <?php for($i=1;$i<=$total_pages;$i++){ ?>
      <li class="page-item  <?php if($i==$page){ echo 'active'; } ?> "><a class="page-link" href="<?=$purl?>?page=<?=$i.''.$nurl;?>"><?=$i?></a></li>
    <?php } ?> 
  </div>

</nav> 

</div>
</div>

<div id="js-product-list-bottom">
  <div id="js-product-list-bottom"></div>
</div>
</section>
</section>
</div>



</div>

</div>


</section>
<?php include('footer.php');?>