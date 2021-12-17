<?php include('header.php');

$about_data = getData('cms',3);
$side_image = getData('sideimage',1);
//print_r($side_image);die;
    $filter = array(
        'table'=>'ci_banners',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'1',
        'where'=> 'is_active=1 && name="bannerall"'
    );  
    $bannerData = postData('listing', $filter); 
//echo "<pre>";print_r($about_data);die;
$filename = $side_image['data']['image'];
$file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

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
      <span itemprop="name"><?=$about_data['data']['cms_name']?></span>
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
   <div id="content-wrapper" class="col-lg-12 col-xs-12">
    <section id="main">
     <header class="page-header">
      <h1 class="Calibri">
      <?=$about_data['data']['cms_name']?>
      </h1>
     </header>
     <section id="content" class="page-content page-cms page-cms-4">
      <h1 class="page-heading bottom-indent"></h1>
      <div class="row">
       <div class="col-xs-12 col-sm-8">
        <div class="cms-block">
         <h3 class="page-subheading Calibri"><?=$about_data['data']['meta_title']?></h3>
         <p><?=$about_data['data']['cms_contant']?></p>
           <p class="meta">"<?=$about_data['data']['meta_description']?>"</p>
        </div>
       </div>
      <div class="col-xs-12 col-sm-4" style="float:right:">
         <div class="cms-box">
        <?php 
            if($file_extension == 'mp4') {

                  echo '<video width="400" height="240" controls>
                         <source src='.ADMIN_PATH.$side_image['data']['image'].' type="video/mp4">
                         </video>'; 

           }else{
              echo '<img src="'.getimage($side_image['data']['image'],'noimage').'" >';
           } ?>
 
     </div>
    </div>
   </div>
     </section>
</section>
</div>
</div>
</div>
</section>

<?php include('footer.php');?>
