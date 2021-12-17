<?php include('header.php');

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
$filter = array(   
    'sort'          => $sort,
    'order'         => $order,
    'start'         => ($page - 1) * $limit,
    'limit'         => $limit
); 
$portfolio_total = postData('totalportfolio', $filter);

$total_pages = ceil(@$portfolio_total['data'] / $limit);
$results =  postData('allportfolio',$filter);
//echo "<pre>";print_r($results);die;

$nurl = '';
if (isset($_REQUEST['sort'])) {
    $nurl .= '&sort=' . $_REQUEST['sort'];
}
if (isset($_REQUEST['order'])) {
    $nurl .= '&order=' . $_REQUEST['order'];
}
$purl = BASE_PATH.'portfolio';
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
      <span itemprop="name">PortFolio</span>
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
 <div class="secondary-blog">
  <div class="row">
        <?php
    if(!empty($results['data'])){
    $i=1;  
    foreach ($results['data'] as $mskey => $msvalue) { ?>
    <div class="col-lg-4 col-md-6">
  <article class="blog-item">
  <div class="blog-image-container">
          <h4 class="title">
        <a href="<?=BASE_PATH?>portfolio_detail/<?=$msvalue['slug']?>" title="Turpis at eleifend leo mi elit Aenean porta ac sed faucibus"><?php echo $msvalue['name']?></a>
      </h4>
     
      <div class="blog-image">
      <a href="<?=BASE_PATH?>portfolio_detail/<?=$msvalue['slug']?>"><img src="<?=ADMIN_PATH.$msvalue['image']?>" title="Turpis at eleifend leo mi elit Aenean porta ac sed faucibus" alt="" class="img-fluid"></a>
    </div>
      </div>
  <div class="blog-info">
          <div class="blog-shortinfo">
       <p class="text-justify"><?php echo $msvalue['sort_description']?></p></div>
              <p>
        <a href="<?=BASE_PATH?>portfolio_detail/<?=$msvalue['slug']?>" title="Turpis at eleifend leo mi elit Aenean porta ac sed faucibus" class="more btn btn-primary">Read more</a>
      </p>
      </div>
</article>
  </div>
  <?php  } }else{?>
<div class="col-lg-12 col-md-12 mb-20"> No Portfolio Found!!! </div>
<?php } ?>
</div>
   

 </div> 
 </div>  
 </section>
<?php include('footer.php');?>
