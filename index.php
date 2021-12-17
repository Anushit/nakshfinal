<?php include('header.php');
   $filter = array(
       'table'=>'ci_banners',
       'sort'=>'sort_order',
       'order'=>'asc',
       'start'=>'0',
       'limit'=>'3',
       'where'=> 'is_active=1 && name !="bannerall"'
   );  
   $bannerData = postData('listing', $filter); 
   //print_r($bannerData);die;
      $filter = array( 
       'sort'=>'p.sort_order',
       'order'=>'asc',
       'start'=>'0',
       'limit'=>'10',
       'where'=> 'is_active=1'
   );  
   $productData = postData('productlist', $filter); 
   //echo "<pre>";print_r($productData);die;
   
   
    $filter = array(
       'table'=>'ci_services',
       'sort'=>'sort_order',
       'order'=>'asc',
       'start'=>'0',
       'limit'=>'10',
       'where'=> 'is_active=1'
   );  
   $serviceData = postData('listing', $filter); 
   
   $cms = getData('cms',11);
   $side_image = getData('sideimage',2);
   $home_about = getData('cms',12);
    
   /*if(isset($_POST['submit'])){ 
            $msg = '';
           if($msg==''){
            $data = $_POST;
            
            $contactData = postData('saveinquery', $data);
            
        } 
    } 
   */
    $filter = array(
       'table'=>'country',
       'where' => 'phonecode',
       
   );  
    //print_r($filter);die;
   $con_data = postData('countrylisting', $filter); 
   //print_r($con_data);die;
   $filename = $side_image['data']['image'];
   $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
   ?>

    <div class="banner" >
    <div class="sliding-banner-container">
      <ul class="sliding-banner">
        
        <?php if(!empty($bannerData['data'])){
                                      foreach ($bannerData['data'] as $key => $bvalue) { ?>
                <li class="sliding-banner-item">
                  <img class='sliding-banner-img' src="<?=getimage($bvalue['image'],'noimage.png') ?>">
                  <div class="sliding-banner-content">
                    <div class="hero" style="width: 280px;">
                      <hgroup>
                          <h1 class="text-color"><?=$bvalue['title_first']?> </h1>
                          <a href="<?=BASE_PATH?>products" class="btn btn-inverse">Explore Our Product</a>  
                      </hgroup>
                      
                    </div>
                  </div>
                </li>
                 <?php }} ?>
              </ul>
            </div>
          </div>

                 <!-- End new html -->
               </div>
            </div>
            <div class="wrapper" style="background: #f9f9f9 no-repeat">
               <div class="container">
                  <div class="row ApRow  has-bg bg-fullwidth-container" style="">
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12  ApColumn ">
                        <div class="block ApRawHtml">
                           <div class="service-box">
                              <div class="row">
                                 <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sp-12">
                                    <div class="service-item mt-2">
                                       <h2 class="Calibri" style="display: flex;
                                          justify-content: center;font-size: 25px;"><?=$cms['data']['cms_title']?></h2>
                                       <p><?=mb_strimwidth($home_about['data']['cms_contant'],0,600,'....')?></p>
                                       <p class="meta">"<?=$cms['data']['meta_description']?>"</p>
                                       <p class="read-btn">
                                          <a href="<?=BASE_PATH?>about" class="btn btn-inverse">Read More</a>
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12">
                                    <div class="service-item">
                                       <p>
                                        <?php 
                                        if($file_extension == 'mp4') {

                                          echo '<video width="400" height="240" controls>
                                           <source src='.ADMIN_PATH.$side_image['data']['image'].' type="video/mp4">
                                           </video>'; 

                                       }else{
                                              echo '<img src="'.getimage($side_image['data']['image'],'noimage').'"  width=200px; height="200;">';
                                       } ?>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="wrapper">
               <div class="container">
                  <div        class="row ApRow  has-bg bg-boxed"
                     data-bg=" no-repeat"                style="background: no-repeat;"        >
                     <div    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12  ApColumn "
                        >
                        
                   <div class="block products_block exclusive appagebuilder ApProductCarousel">
                           <h4 class="title_block">
                              Our Products
                           </h4>
                          <!--  <div class="sub-title-widget"><span>Our</span> Products</div> -->
                           <div class="block_content">
                              <div class="owl-row">
                                 <div id="carousel-2453061249" class="owl-carousel owl-theme owl-loading profile-default">
                                    <?php if(!empty($productData['data'])){
                                       foreach ($productData['data'] as $key => $pvalue) { ?>
                                    <div class="item first">
                                       <article class="product-miniature js-product-miniature" data-id-product="1" data-id-product-attribute="1" itemscope itemtype="http://schema.org/Product">
                                          <div class="thumbnail-container">
                                             <div class="product-image">
                                                <a href="<?=BASE_PATH?>product/<?=$pvalue['slug']?>">
                                                   <img
                                                      class="img-fluid"
                                                      src = "<?=getimage($pvalue['image'],'noimage')?>"
                                                      alt = "Caraway"
                                                      data-full-size-image-url = "<?=getimage($pvalue['image'],'noimage')?>"
                                                      >
                                                   <span class="product-additional" data-idproduct="1"></span>
                                                   <div class="product-price-and-shipping">
                                                   </div>
                                                </a>
                                                
                                             </div>
                                             <div class="product-meta">
                                                
                                                <h3 class="h3 product-title" itemprop="name"><a href="<?=BASE_PATH?>product/<?=$pvalue['id']?>"><?=$pvalue['name']?></a></h3>
                                                
                                                <div class="row">
                                                   <p>
                                                      <a href="<?=$pvalue['amazon_link']?>" target="_blank"<?php if(empty($pvalue['amazon_link'])) { ?>style="display: none;<?php }?>"><img class="pro-btn" src="<?=ADMIN_PATH?>assets/img/amazon.png" ></a>
                                                      <a href="<?=$pvalue['filpcart_link']?>" target="_blank" <?php if(empty($pvalue['filpcart_link'])) { ?>style="display: none;<?php }?>"><img class="pro-btn" src="<?=ADMIN_PATH?>assets/img/flip.png" ></a>
                                                   </p>
                                                </div>
                                                
                                             </div>
                                          </div>
                                       </article>
                                    </div>
                                    <?php }} ?>
                                 </div>
                              </div>
                           </div>
                        </div> 
                     </div>
                  </div>
               </div>
               <!-- @file modules\appagebuilder\views\templates\hook\ApRow -->
               <div class="container">
                  <div class="row">
                     <div id="left-column" class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <div class="contact-rich">
                           <h4>Store information</h4>
                           <div class="block">
                              <div class="icon"><i class="material-icons">&#xE55F;</i></div>
                              <div class="data" <?php if (empty($header_setting['data']['address'])){?>style="display:none"<?php }?>><?=$header_setting['data']['address']?></div>
                           </div>
                           <hr/>
                           <div class="block">
                              <div class="icon"><i class="material-icons">&#xE0CD;</i></div>
                              <div class="data">
                                 Call us:<br/>
                                 <a href="tel:0123-456-789"<?php if (empty($header_setting['data']['phone'])){?>style="display:none"<?php }?>><?=$header_setting['data']['phone']?></a>
                              </div>
                           </div>
                           <hr/>
                           <div class="block">
                              <div class="icon"><i class="material-icons">&#xE158;</i></div>
                              <div class="data email" <?php if (empty($header_setting['data']['email'])){?>style="display:none"<?php }?>>
                                 <span>Email us:<br/></span>
                                 <a href="mailto:<?=$header_setting['data']['email']?>"><?=$header_setting['data']['email']?></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="contact" class="left-column col-xs-12 col-sm-12 col-md-8 col-lg-9">
                        <section id="main">
                           <section id="content" class="page-content card card-block">
                              <div style="background-color: white; border:0;">
                                 <?php  
                                    if(!empty($error)){
                                    echo "<div class='alert alert-danger text-center'>".$error."</div>";
                                    } 
                                    if(!empty($msg)){
                                    echo "<div class='alert alert-success text-center'>".$msg."</div>";
                                    } 
                                    ?>
                              </div>
                              <section class="contact-form">
                                 <form  method="post" id="contact-form">
                                    <section class="form-fields">
                                       <div class="form-group row">
                                          <div class="col-md-9 col-md-offset-3">
                                             <h3>Contact us</h3>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-md-3 form-control-label">Name</label>
                                          <div class="col-md-8">
                                             <input  type="text" class="form-control" name="name" id="name" value=""  placeholder="Enter Your Name">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-md-3 form-control-label">Email address</label>
                                          <div class="col-md-8">
                                             <input  type="email" class="form-control" name="email" id="email" value=""  placeholder="Enter Your Email">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-md-3 form-control-label">Mobile</label>
                                          <div class="col-md-2">
                                             <select class="form-control" name="code" id="code" value="India">
                                              <option value="91">(+91 India)</option>
                                                <?php 
                                                   foreach ($con_data['data'] as $key => $value) { ?>
                                                <option value="<?php echo $value['phonecode']?>"<?php if($value['phonecode'] == $value['name']): ?> selected="selected"<?php endif; ?>>(+<?php echo $value['phonecode']." ".$value['name']?>)</option>
                                                <?php } 
                                                   ?>
                                             </select>
                                          </div>
                                          <div class="col-md-6">
                                             <input  type="text" class="form-control" name="mobile" id="mobile" value=""  placeholder="Enter Your Mobile">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-md-3 form-control-label">Subject</label>
                                          <div class="col-md-8">
                                             <input  type="text" class="form-control" name="subject" id="subject" value=""  placeholder="Enter Your Subject">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-md-3 form-control-label">Message</label>
                                          <div class="col-md-8">
                                             <textarea
                                                class="form-control"
                                                name="message" id="message"
                                                placeholder="How can we help?"
                                                rows="3"
                                                ></textarea>
                                          </div>
                                       </div>
                                       <button type="submit" name="submit" id="buttn" class="btn btn-inverse submit-button submitData">Send Message</button>
                                    </section>
                                 </form>
                              </section>
                           </section>
                        </section>
                     </div>
                  </div>
               </div>
         </section>
      </section>
      </div>
   </div>
</section>
<?php include('footer.php');?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

 <script src='https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js' ></script>  
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
       </script>
<script type="text/javascript"> 
   //Refresh Captcha
   jQuery(document).ready(function(){
   
      $('.owl-carousel').owlCarousel({
         loop:false,
         margin:10,
         nav:true,
         responsive:{
            0:{
                  items:1
            },
            600:{
                  items:3
            },
            1000:{
                  items:5
            }
         }
      })
     jQuery(document).on("click", ".submitData", function(e){  
       if (jQuery("#contact-form").valid()) { 
           // alert("asdf");
           jQuery("#contact-form").submit();
         }
       });
   
     jQuery("#contact-form").validate({
       rules: {
         name: "required",
         email: {required: true, email: true},
         mobile: {
           required: true, 
           number: true,
           minlength:10,
           maxlength:10,
         },
         subject: "required",
         message: "required", 
       },
       messages: {
         name: "Please Enter Full Name",
         email: { 
           "required": "Please Enter Email Address",
           "email": "Please Enter Valid Email Address",
         },
         mobile: { 
           "required": "Please Enter Mobile No.",
           "number": "Please Enter Valid Mobile No",
           "minlength": "Mobile No Should Be 10 Digits",
           "maxlength": "Mobile No Should Be 10 Digits",
         },
         subject: "Please Enter Subject",
         message: "Please Enter Message",  
       }
     });
   
   });
   $("#buttn").click(function(){
   
   
    if($("#name").valid() && $("#email").valid()){
   
       var form_data = new FormData();
       form_data.append('name',$("#name").val());
       form_data.append('email',$("#email").val());
        form_data.append('code',$("#code").val());
       form_data.append('mobile',$("#mobile").val());
       form_data.append('subject',$("#subject").val());
       form_data.append('message',$("#message").val());
   
       $.ajax({
           url: "<?=BASE_PATH?>submitForm.php",
           type:"post",
           data: form_data,
           dataType: "text",
           cache: false,
           contentType: false,
           processData: false,
   
           success: function(response){
           //$.notify("submission successful");
           }
       });
   }else{
        alert("Please fill required field.", "errors")
   }
   });
   
     $("#code").select2();
</script>