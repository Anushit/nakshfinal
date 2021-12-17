<?php include('header.php');
   $filter = array(
       'table'=>'ci_career',
       'sort'=>'sort_order',
       'order'=>'asc',
       'where'=> 'is_active=1'
   );  
   $Careerlist = postData('listing', $filter); 
   //echo "<pre>";print_r($Careerlist);die;
   
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
               <span itemprop="name">Career</span>
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
         Latest Jobs
      </h2>
   </div>
   <div class="secondary-blog">
   <div class="row">
      <?php
         if(!empty($Careerlist['data'])){ 
         foreach ($Careerlist['data'] as $mskey => $msvalue) { ?>  
      <div class="col-lg-4 col-md-6">
         <article class="blog-item">
            <div class="blog-image-container">
               <h4 class="title">
                  <a href="" title="Turpis at eleifend leo mi elit Aenean porta ac sed faucibus"><a href=""><?=$msvalue['name'];?></a></a>
               </h4>
               <div class="blog-image">
                  <div class="blog-shortinfo">
                     <p class="text-justify"><?=$msvalue['qualification'];?> </p>
                  </div>
                  <div class="blog-info">
                     <div class="blog-shortinfo">
                        <ul class="category-sub-menu">
                           <?php 
                              if($msvalue['type']='full'){
                                $type='Full Time';
                              }elseif($msvalue['type']='part'){
                                $type='Part Time';
                              }elseif($msvalue['type']='hour'){
                                $type='Hourly Base';
                              }
                              ?>
                           <li><i class="fa fa-check-circle"></i> Job Type :  <?=$type; ?></li>
                           <li><i class="fa fa-check-circle"></i> Opening Date : <?=date('d-m-Y',strtotime($msvalue['opening_date']));?></li>
                        </ul>
                     </div>
                     <p>
                        <?php 
                           if($msvalue['type']='full'){
                             $type='Full Time';
                           }elseif($msvalue['type']='part'){
                             $type='Part Time';
                           }elseif($msvalue['type']='hour'){
                             $type='Hourly Base';
                           }
                           ?>
                        Job Type :  <?=$type; ?><br>
                        Opening Date : <?=date('d-m-Y',strtotime($msvalue['opening_date']));?>
                     </p>
                     <p>
                        <a href="career_detail/<?=$msvalue['slug'];?>" title="At risus pretium urna tortor metus fringilla" class="more btn btn-inverse">See Details</a>
                     </p>
                  </div>
         </article>
         </div>
         <?php }}else{
          echo "<div ><strong>Currently No Job Openings</strong></div>";
         } ?>  
         </div>
      </div>
   </div>
</section>
<?php include('footer.php');?>