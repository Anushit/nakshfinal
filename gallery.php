<?php include('header.php');

$filter = array(
        'table'=>'ci_gallery',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'10',
        'where'=> 'is_active=1'
    );  
$galleryData = postData('listing', $filter);
//echo "<pre>";print_r($galleryData);die;
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
     <a itemprop="item">
      <span itemprop="name">Gallery</span>
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
 <div class="row">
      <?php if (!empty($galleryData['data'])) {
         $i=0;
  foreach ($galleryData['data'] as $key => $gvalue) { 
  if($i==3){ echo '</div> <div class="row">'; $i=0; } ?>
<div class="col-lg-4 col-md-6">

                     
<article class="blog-item">

   <div class="blog-image-container">
      <h4 class="title">
         <a href="<?=BASE_PATH?>gallery_detail/<?=$gvalue['id']?>" title="At risus pretium urna tortor metus fringilla"><?=$gvalue['album']?></a>
      </h4>
  
      <div class="blog-image">
         <a href="<?=BASE_PATH?>gallery_detail/<?=$gvalue['id']?>"><img src="<?=getimage($gvalue['cover_photo'],'noimage')?>" title="At risus pretium urna tortor metus fringilla" alt="" class="img-fluid" /></a>
      </div>
   </div>
   <div class="blog-info">
      <div class="blog-shortinfo">
       <p class="text-justify"><?=mb_strimwidth($gvalue['description'],0,100,"...")?></p>  
      </div>
      
   </div>
</article>

</div>
<?php $i++; }} ?>
</div>
</div>
</section>
<?php include('footer.php');?>