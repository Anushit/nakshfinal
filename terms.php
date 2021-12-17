<?php include('header.php');

$terms_data = getData('cms',10);
//echo "<pre>";print_r($terms_data);die;
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
      <span itemprop="name"><?=$terms_data['data']['cms_name']?></span>
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
      <h1>
       <?=$terms_data['data']['cms_name']?>
      </h1>
     </header>
        <?=$terms_data['data']['cms_contant']?>

   
    </section>   
  </div>

  </div>
 </div>

</section>

<?php include('footer.php');?>