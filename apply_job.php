<?php include('header.php');

   $filter = array(
       'table'=>'ci_banners',
       'sort'=>'sort_order',
       'order'=>'asc',
       'start'=>'0',
       'limit'=>'1',
       'where'=> 'is_active=1 && name="bannerall"'
   );  
   $bannerData = postData('listing', $filter); 
   
if($_REQUEST['id']){
  $id = $_REQUEST['id'];
}else{
  redirect("Career");
}
$filter = array(
    'table'=>'ci_career',
    'sort'=>'sort_order',
    'order'=>'asc',
    'where'=> "is_active=1 and slug='".$id."'"
);  
$Careerlist = postData('listing', $filter);

$general_settings = getData('setting', 1); 

if(isset($_POST['submit'])){ 
$error ='';

 $targetfolder = "admin/assets/img/apply_job/";
 $new_image_name = $_POST['fname'].rand(10, 20).".pdf";
 $targetfolder = $targetfolder . basename( $new_image_name) ;
 $ok=1;
 $file_type=$_FILES['cv']['type'];
   if ($file_type=="application/pdf" ) {
       if(move_uploaded_file($_FILES['cv']['tmp_name'], $targetfolder))
       {
        $file = "assets/img/apply_job/".$new_image_name;
       }
       else {
        $error = "Problem uploading file";
       }
   }
   else {
     $error=  "You may only upload PDFs files.";
    }

 
    if($error==''){
        $doc = array('cv'=>$file);
        $_POST = array_merge($_POST,$doc);
        
        $data = $_POST;  

         $contactData = postData('saveapplyjob', $data);
         //echo "<pre>";print_r($contactData);die;
        
        $msg = $contactData['message'];
         
    } 
    
}
   
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
      <span itemprop="name">Apply Job</span>
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
         <h2 style="text-align: center">Apply For <?=$Careerlist['data'][0]['name']?></h2>
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
                     <form action="<?=BASE_PATH.'apply_job/'.$_REQUEST['id'] ?>" method="post" id="applyForm" enctype="multipart/form-data">
                           <div class="form-group row">
                              <label class="col-md-3 form-control-label">FirstName</label>
                              <div class="col-md-6">
                                 <input  type="text" class="form-control" name="fname" id="fname" value=""  placeholder="Enter FirstName">
                              </div>
                           </div>
                               <div class="form-group row">
                              <label class="col-md-3 form-control-label">LastName</label>
                              <div class="col-md-6">
                                 <input  type="text" class="form-control" name="lname" id="lname" value=""  placeholder="Enter LastName">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-3 form-control-label">Email address</label>
                              <div class="col-md-6">
                                 <input  type="email" class="form-control" name="email" id="email" value=""  placeholder="Enter Email">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-3 form-control-label">Mobile</label>
                              <div class="col-md-6">
                                 <input  type="text" class="form-control" name="phone" id="phone" value=""  placeholder="Enter phone">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-3 form-control-label">Experience</label>
                                 <div class="col-md-6">
                                     <select class="form-control form-control-select" id="experience" name="experience">
                                      <option value="">Experience</option>
                                      <option value="Fresher">Fresher</option>
                                      <option value="Less than 1 Year">Less than 1 Year</option>
                                      <option value="1 Year"> 1 Year</option>
                                      <option value="2 Year"> 2 Year</option>
                                      <option value="3 Year"> 3 Year</option>
                                      <option value="More than 3 Year"> More than 3 Year</option>
                                    </select>
                                  </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-3 form-control-label">Description</label>
                              <div class="col-md-9">
                                 <textarea
                                    class="form-control"
                                    name="description" id="description"
                                    placeholder="How can we help?"
                                    rows="3"
                                    ></textarea>
                              </div>
                           </div>
                             <div class="form-group row">
                              <label class="col-md-3 form-control-label">Upload Cv</label>
                                <input type="file" name="cv"  id="cv"  >
                              </div>
                               <input type="text" hidden name="career_id" value="<?php echo $_REQUEST['id'] ?>"> 
                               
                           <button type="submit" name="submit" class="btn btn-inverse submit-button submitData">Apply Now</button>
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
   $(document).on("click", ".submitData", function(e){  
    if ($("#applyForm").valid()) {
       /// $('#contactFrom :input[type="submit"]').prop('disabled', true);
        $("#applyForm").submit();
    }
}); 

$("#applyForm").validate({
    rules: {
        fname: "required",
        lname: "required",
        experience:"required",
        email: {required: true, email: true},
        phone: {
            required: true, 
            number: true,
            minlength:10,
            maxlength:10,
        },
        cv: {
            required: true, 
            
        },
        description: "required", 
    },
    messages: {
        fname: "Please Enter First Name",
        lname: "Please Enter First Name",
        experience: "Please Enter Experience",
        email: { 
          "required": "Please Enter Email Address",
          "email": "Please Enter Valid Email Address",
        },
        phone: { 
          "required": "Please Enter Mobile No.",
          "number": "Please Enter Valid Mobile No",
          "minlength": "Mobile No Should Be 10 Digits",
          "maxlength": "Mobile No Should Be 10 Digits",
        },
        cv: { 
          "required": "Please Insert Your CV.",
        },
        description: "Please Enter description", 
    }
}); 
    
</script>