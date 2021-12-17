<?php include('config.php');

    $filter = array(
        'table'=>'ci_banners',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'1',
        'where'=> 'is_active=1 && name="bannerall"'
    );  
    $bannerData = postData('listing', $filter); 
    
if(isset($_POST['submit'])){ 
          $msg = '';
           if($msg==''){
            $data = $_POST;
            //echo "<pre>";print_r($data);die;
            $contactData = postData('saveinquery', $data);
            //echo "<pre>";print_r($contactData);die;
            $msg = $contactData['message'];
        } 
} 
include('header.php');
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
      <span itemprop="name">Contact</span>
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
  <div id="content-wrapper" class="left-column col-xs-12 col-sm-12 col-md-8 col-lg-9">
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
       <form action="<?=BASE_PATH.'contact'?>" method="post" id="contact-form">


        <section class="form-fields">
            
         <div class="form-group row">
          <div class="col-md-9 col-md-offset-3">
           <h3>Contact us</h3>
          </div>
         </div>

     <div class="form-group row">
          <label class="col-md-3 form-control-label">Name</label>
          <div class="col-md-6">
           <input  type="text" class="form-control" name="name" id="name" value=""  placeholder="Enter Your Name">
            </div>
          </div>
    

         <div class="form-group row">
          <label class="col-md-3 form-control-label">Email address</label>
          <div class="col-md-6">
           <input  type="email" class="form-control" name="email" id="email" value=""  placeholder="Enter Your Email">
          </div>
          </div>
         
         <div class="form-group row">
          <label class="col-md-3 form-control-label">Mobile</label>
          <div class="col-md-6">
           <input  type="text" class="form-control" name="mobile" id="mobile" value=""  placeholder="Enter Your Mobile">
            </div>
          </div>


           <div class="form-group row">
          <label class="col-md-3 form-control-label">Subject</label>
          <div class="col-md-6">
           <input  type="text" class="form-control" name="subject" id="subject" value=""  placeholder="Enter Your Subject">
            </div>
          </div>
     

         <div class="form-group row">
          <label class="col-md-3 form-control-label">Message</label>
          <div class="col-md-9">
           <textarea
           class="form-control"
           name="message" id="message"
           placeholder="How can we help?"
           rows="3"
           ></textarea>
           </div>
          </div>
          <button type="submit" name="submit" class="btn btn-inverse submit-button submitData">Send Message</button>
    </section>
   </form>
  </section>
 </section>
</section>
</div>
</div>
</div>
</section>


<?php include('footer.php');?>

<script type="text/javascript"> 
        //Refresh Captcha
        jQuery(document).ready(function(){

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
  

</script>
