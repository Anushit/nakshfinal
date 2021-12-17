<?php include('header.php');
   $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : null;
   $search = isset($_GET['search']) ? $_GET['search'] : null;
   $page = isset($_GET['page']) ? $_GET['page'] : 1;
   $per_page = 10;
   $productdata = array(
         'cat_id' => $cat_id,
         'search' => $search,
         'per_page'=> $per_page,
         'page' => $page,
         
       );
   $productData = postData('getproducts',$productdata);
   
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
               <a itemprop="item" href="<?=BASE_PATH?>about">
               <span itemprop="name">Products</span>
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
      <div id="">
         <div id="js-product-list">
            <h2>All Products</h2>
            <div class="products">
               <!-- Products list -->
               <div class="product_list grid  profile-default ">
                  <div class="row">
                     <?php if(!empty($productData['data'])){
                        
                        foreach ($productData['data'] as $key => $pvalue) { 
                           
                          ?>
                     <div class="col-sp-12 col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 myheight" >
                        <article class="product-miniature js-product-miniature" data-id-product="4" data-id-product-attribute="16" itemscope="" itemtype="http://schema.org/Product">
                           <div class="thumbnail-container">
                              <div class="product-image">
                                 <!-- @file modules\appagebuilder\views\templates\front\products\file_tpl -->
                                 <a href="<?=BASE_PATH?>product/<?=$pvalue['slug']?>">
                                    <img class="img-fluid" src="<?=getimage($pvalue['image'],'noimage')?>" alt="Rosemary" data-full-size-image-url="<?=getimage($pvalue['image'],'noimage')?>">
                                    <span class="product-additional" data-idproduct="4"></span>
                                    <div class="product-price-and-shipping">
                                    </div>
                                 </a>
                              </div>
                              <div class="product-meta">
                                 <h2 class="h3 product-title" itemprop="name"><a href="<?=BASE_PATH?>product/<?=$pvalue['id']?>"><?=$pvalue['name']?></a></h2>
                                 <div class="product-price-and-shipping ">
                                    <span class="price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                 </div>
                                 <div class="product-description-short" itemprop="description">
                                    <p><?=$pvalue['sort_description']?></p>
                                 </div>
                                 <div class="row">
                                    <p>
                                       <a href="<?=$pvalue['amazon_link']?>" target="_blank" <?php if(empty($pvalue['amazon_link'])) { ?>style="display: none;<?php }?>"><img src="<?=ADMIN_PATH?>assets/img/amazon.png"></a>
                                       <a href="<?=$pvalue['filpcart_link']?>" target="_blank" <?php if(empty($pvalue['filpcart_link'])) { ?>style="display: none;<?php }?>" ><img src="<?=ADMIN_PATH?>assets/img/flip.png"></a>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </article>
                     </div>
                     <?php  }}else{
                        echo "No Record Found";
                        } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="center">
      <div class="pagination pagination-pro ">
         <?php   
            if(isset($productData['count_data']) && $productData['count_data'] > 0){
             $total_products = $productData['count_data'];
             $total_page =  ceil($total_products / $per_page);
             for($page = 1; $page <= $total_page; $page++){
            ?>
         <a href="<?=BASE_PATH?>products?page=<?=$page?>"><?=$page?></a> 
         <?php  }} ?>
      </div>
   </div>
</section>
<?php include('footer.php');?>