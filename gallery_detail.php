<?php include('header.php');
 
 if (!isset($_GET['id']) ) {  
        $i_id = 0;  
        
    } else {  
        $i_id = $_GET['id']; 
        //echo $i_id;die;
    }
    $filter = array(
        'table'=>'ci_gallery_details',
        'where'=> 'is_active=1 && type=1 && gallery_id='.$i_id,
    );
     //echo "<pre>";print_r($filter);die;
    $imageData = postData('listing', $filter);
    //echo "<pre>";print_r($imageData);die;

    $filter = array(
        'table'=>'ci_banners',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'1',
        'where'=> 'is_active=1 && name="bannerall"'
    );  
    $bannerData = postData('listing', $filter); 

      
      //echo "<pre>";print_r($imageData);die;
?>
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
   <?php if (!empty($imageData['data'])) {
         $i=0;
  foreach ($imageData['data'] as $key => $imgvalue) { 
  if($i==3){ echo '</div> <div class="row">'; $i=0; } ?>
<div class="col-lg-4 col-md-6">

                     
<article class="blog-item">

   <div class="blog-image-container">
       
      <div class="blog-image">
         <img src="<?=getimage($imgvalue['value'],'noimage')?>" title="At risus pretium urna tortor metus fringilla" alt="" class="img-fluid" />
      </div>
   </div>
   <div class="blog-info">
      
   </div>
</article>

</div>
<?php }}else{
  echo "No record Found";
}?>
</div>
</div>
<?php include('footer.php');?>