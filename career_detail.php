<?php include('header.php');?>
<?php 
$id = isset($_REQUEST['id'])?$_REQUEST['id']:'0'; 
/*$filter = array(
  'table'=>'ci_career', 
  'slug' => $id  
);
$metaData = postData('metadata', $filter); */

$filter = array(
    'table'=>'ci_career',
    'sort'=>'sort_order',
    'order'=>'asc',
    'where'=> 'is_active=1'
);  
$Careerlist = postData('listing', $filter); 

$filter = array(
    'table'=>'ci_career', 
    'sort'=>'sort_order',
    'order'=>'asc',
    'where'=> "is_active=1 and slug='".$id."'"
);  
$CareerData = postData('listing', $filter); 
$Career = isset($CareerData['data'][0])?$CareerData['data'][0]:[];

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
     <a itemprop="item" >
      <span itemprop="name">Home</span>
     </a>
     <meta itemprop="position" content="1">
    </li>

    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
     <a itemprop="item">
      <span itemprop="name"><?=isset($Career['name'])?$Career['name']:"Career";?></span>
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
   <div id="left-column" class="sidebar col-xs-12 col-sm-12 col-md-4 col-lg-3">
    <div class="block-categories block block-highlighted hidden-sm-down">
     <h4 class="title_block"><a >Career Opportunites</a></h4>
     <div class="block_content">
      <ul class="category-top-menu">
       <li>
        <ul class="category-sub-menu">
        <?php if($Careerlist['data']){
            foreach ($Careerlist['data'] as $skey => $svalue) { ?> 
          <li data-depth="0 active">
            <a <?php if($svalue['id']==$Career['id']){ echo 'class="active"'; } ?> href="<?=BASE_PATH?>career_detail/<?=$svalue['slug']; ?>"><?=$svalue['name']; ?></a>
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
         <div class="category-cover">
            <img class="img-fluid" src="https://demo4leotheme.com/prestashop/leo_koreni_demo/c/8-category_default/vegetable.jpg" alt="Vegetable">
         </div>
         <h1 class="h1 category-name"><?=$Careerlist['data']['name']?></h1>
         <div id="category-description" class="text-muted">
         </div>
      </div>
      <section id="products">
     
       <?php if(!empty($CareerData['data'])){ ?>
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12">

      <h1 class="h1 product-detail-name" itemprop="name"><?=$Career['name']?></h1>

      <div class="product-prices">

       <div
       class="product-price h5 "
       itemprop="offers"
       itemscope
       itemtype="https://schema.org/Offer"
       >
       <link itemprop="availability" href="https://schema.org/InStock"/>
       <meta itemprop="priceCurrency" content="USD">

       <div class="current-price">
        <span itemprop="price" content="25.99"> <?=$Career['qualification']?></span>

       </div>



      </div>

     </div>


     <div id="product-description-short-3" itemprop="description"><p class="text-justify"><?=$Career['description']?></p></div>
   <p>
            <a href="<?=BASE_PATH?>apply_job/<?=$Career['slug']; ?>" title="At risus pretium urna tortor metus fringilla" class="more btn btn-inverse">Apply Now</a>
            </p>
     </div>
         <?php }else{ ?>
           <div class="col-12"> No Record Found !!!</div>
           <?php } ?>  
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