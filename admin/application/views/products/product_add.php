<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/select2.min.css">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Add New Product </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('product'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Product List</a>

          </div>

        </div>

        <div class="card-body">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open_multipart(base_url('product/add'), 'class="form-horizontal" id="productForm"');  ?> 
              <div class="form-group row">                
                <div class="col-sm-12">
                  <label for="main_parent_id" class="col-sm-6 control-label">Category <span class="red">*</span></label>
                  <select class="form-control select2 getsubcategroy" name="main_parent_id" id="main_parent_id">
                   <option value="">Select Category</option> 
                   <?php 
                   foreach ($parcat as $key => $pcat) { ?>
                    <option value="<?php echo $pcat['id']?>" ><?php echo $pcat['name']?></option>
                   <?php } ?>                   
                  </select> 
                </div>
                <div class="col-sm-12" style="margin-top:3px;">
                  <input type="hidden" name="category_id" id="category_id" value="">
                  <div class="form-control minheightdiv" id="product_category_id"> </div>
                <label id="main_parent_id-error" class="error" for="main_parent_id"></label>  
                </div> 
              </div>            
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="model" class="col-sm-6 control-label">Model <span class="red">*</span></label>  
                  <input type="text" name="model" class="form-control" id="model" placeholder="" value="<?= set_value('model'); ?>">
                </div>
                <div class="col-sm-6">
                <label for="sku" class="col-sm-6 control-label">SKU<span class="red">*</span> </label>  
                  <input type="text" name="sku" class="form-control" id="sku" placeholder="" value="<?= set_value('sku'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="name" class="col-sm-6 control-label">Name <span class="red">*</span></label>  
                  <input type="text" name="name" class="form-control" id="name" placeholder="" value="<?= set_value('name'); ?>">
                </div> 
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                <label for="sort_description" class="col-sm-6 control-label">Sort Description </label>   
                  <textarea name="sort_description" class="form-control textarea" id="description" placeholder="" ><?= set_value('sort_description'); ?></textarea> 
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="price" class="col-sm-6 control-label"> Price <span class="red">*</span></label>  
                  <input type="text" name="price" class="form-control" id="price" placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^\d\.]/g, '')" value="<?= set_value('price'); ?>">
                </div>
                <div class="col-sm-6">
                <label for="special_price" class="col-sm-6 control-label">Special Price </label>  
                  <input type="text" name="special_price" class="form-control" id="special_price" placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^\d\.]/g, '')" value="<?= set_value('special_price'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="meta_title" class="col-sm-6 control-label">Meta Title <span class="red">*</span></label>  
                  <input type="text" name="meta_title" class="form-control" id="meta_title" placeholder="" value="<?= set_value('meta_title'); ?>">
                </div>
                <div class="col-sm-6">
                  <label for="meta_keyword " class="col-sm-6 control-label">Meta Keyword </label>
                  <input type="text" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="" value="<?= set_value('meta_keyword'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="meta_description" class="col-sm-6 control-label">Meta Description </label>  
                  <input type="text" name="meta_description" class="form-control" id="meta_description" placeholder="" value="<?= set_value('meta_description'); ?>">
                </div>
                <div class="col-sm-6">
                  <label for="sort_order" class="col-sm-6 control-label">Sort Order <span class="red">*</span></label>
                  <input type="text" name="sort_order" class="form-control" id="sort_order" placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, '')" value="<?= set_value('sort_order'); ?>">
                </div>
              </div>
              <div class="form-group row">               
                <div class="col-sm-12">
                   <label for="description" class="col-sm-6 control-label">Description<span class="red">*</span></label>
                   <textarea name="description"  class="form-control textarea" id="description" placeholder="" ><?= set_value('description'); ?></textarea> 
                </div>  
              </div>
              <div class="form-group row">               
                <div class="col-sm-12">
                   <label for="demo_link" class="col-sm-6 control-label">Demo Link<span class="red">*</span></label>
                   <textarea name="demo_link"  class="form-control textarea" id="demo_link" placeholder="" ><?= set_value('demo_link'); ?></textarea> 
                </div> 
              </div>

              <div class="form-group row"> 
               <div class="col-md-6">
                  <label for="is_feature" class="col-sm-6 control-label">Is Featured<span class="red">*</span></label>                  
                  <select name="is_feature" id="is_feature"class="form-control">
                    <option value="">Select Is Featured</option>
                    <option value="1" <?= (set_value('is_feature') == '1')?'selected': '' ?>>Yes</option>
                    <option value="0" <?= (set_value('is_feature') == '0')?'selected': '' ?>>No</option>
                  </select>
                </div>        
                <div class="col-md-6">
                  <label for="is_topsell" class="col-sm-6 control-label">Select Top Sell <span class="red">*</span></label>                  
                  <select name="is_topsell"  id="is_topsell"class="form-control">
                    <option value="">Select Top Sell</option>
                    <option value="1" <?= (set_value('is_topsell') == '1')?'selected': '' ?>>Yes</option>
                    <option value="0" <?= (set_value('is_topsell') == '0')?'selected': '' ?>>No</option>
                  </select>
                </div>
              </div>
               <div class="form-group row"> 
                <div class="col-sm-6">
                  <label for="slug" class="col-sm-6 control-label">SEO URL <span class="red" style="color: red;
">*<small>(Space/special characters doesn't allowed)</small></span></label>
                  <input type="text" oninput="test(this.value)" name="slug" class="form-control" id="slug" placeholder="" value="<?= set_value('slug'); ?>"> 
                </div>
               <div class="col-md-6">
                  <label for="status" class="col-sm-6 control-label">Select Status <span class="red">*</span></label>                  
                  <select name="status"  id="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= (set_value('status') == '1')?'selected': '' ?>>Active</option>
                    <option value="0" <?= (set_value('status') == '0')?'selected': '' ?>>Deactive</option>
                  </select>
                </div>  
              </div>
              <div class="form-group row"> 
              <div class="col-md-6">
                <label class="control-label">Brochure</label> 
                 <input type="file" name="brochure" id="brochure">
                 <p><small class="text-success">Allowed Types: pdf only</small></p>
                 <input type="hidden" name="old_brochure" value="">
               </div>
              
                <?php $image_row = 0; ?>
                <div class="col-md-6">                 
                 <label class="control-label">Image</label><br/> 
                 <input type="file" name="image[<?php echo $image_row?>][image]" id="image">
                 <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                 <input type="hidden" name="old_image[<?php echo $image_row?>][image]" value="<?php echo html_escape(@$pro[$image_row]['image']); ?>">
                 <input type="hidden" name="img_order[<?php echo $image_row?>]" class="form-control" id="img_order[<?php echo $image_row?>]" placeholder="" value="0"> 
                <?php $image_row++; ?>  <input type="button" name="addimg" value="Add New Image" class="btn btn-primary addimg" style="float: right;"> 
              </div>

              </div>
              <div class="form-group row"> 
                <div class="col-md-12" id="images">    
                  <table class="table table-bordered" id="product_image_id">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="form-group row"> 
                <div class="col-sm-6">
                  <label for="amazon_link" class="col-sm-6 control-label">Amazon Link <span class="red">*</span></label>
                  <input type="text" name="amazon_link" class="form-control" id="amazon_link" placeholder="" value="<?= set_value(' amazon_link'); ?>"> 
                </div>
                <div class="col-sm-6">
                  <label for="filpcart_link" class="col-sm-6 control-label">Filpcart Link<span class="red">*</span></label>
                  <input type="text" name="filpcart_link" class="form-control" id="filpcart_link" placeholder="" value="<?= set_value('filpcart_link'); ?>"> 
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add Product" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          <!-- /.box-body -->
        </div>
    </section> 
  </div>
    
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript"> 
  $(function () { 
    var image_row = <?php echo $image_row ?>;

    //Initialize Select2 Elements
    $('.select2').select2();

    $('.getsubcategroy').on('change', function() { 
      var catid = $('#category_id').val();
      var pcatid = $("#main_parent_id option:selected").val();
      var str = $('#category_id').val().split(',');
      if ($.inArray(pcatid, str) !== -1) {
        alert('Category allready added!!!');
        return false;
      }else{
        if(catid==''){
          catid = $("#main_parent_id option:selected").val();
        }else{
          catid = catid+','+$("#main_parent_id option:selected").val();
        }      
        var html = '<div class="col-md-12 cat_'+pcatid+'">'+ $("#main_parent_id option:selected").text()+' <span class="removecat" cid="'+pcatid+'"><i class="fa fa-trash"></i></span></div>';
        $('#category_id').val(catid);
        $('#product_category_id').append(html);
      }
    });
    $('#product_category_id').delegate('.removecat', 'click', function() { 
      var pid = $(this).attr('cid');
      $('.cat_'+pid).remove();
      var ncat = '';
      var str = $('#category_id').val().split(',');
      $.each(str, function(key,value) {
        if (pid!=value) {
          ncat = value+','+ncat;
        }
      }); 
      var lastChar = ncat.slice(-1);
      if (lastChar == ',') {
          ncat = ncat.slice(0, -1);
      }
      $('#category_id').val(ncat);
    }); 

    $('.addimg').on('click', function() {  
      var html ='<tr id="image-row' + image_row + '"><td><input type="file" name="image[' + image_row + '][image]" id="image"> <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p></td><td><input type="text" name="img_order[' + image_row + ']" class="form-control" id="img_order[' + image_row + ']" placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, \'\')" value=""></td><td><span class="removeimg" cid="' + image_row + '"><i class="fa fa-trash"></i></span></td></tr>';

      $('#images tbody').append(html);
      image_row++;
    });   
    $('#product_image_id').delegate('.removeimg', 'click', function() { 
      var pid = $(this).attr('cid');
      $('#image-row'+pid).remove();
    });

    // bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5({
      toolbar: { fa: true, "html": true},
      "html": true,  
      parser: function(html) {
        return html;
      }
    }) 
  })
</script>  
<script type="text/javascript">
  $(document).ready(function(){     
     $("#productForm").validate({
        rules: {
            
            main_parent_id:"required",
            category_id:"required",
            //model:"required",
            //sku:"required",
           // price: {
                //required: true,
                //number: true,
            //},
            //special_price: {
                //required: true,
                //number: true,
            //},
           // is_feature:"required",
            
            //is_topsell:"required",
            name:"required",
            //sort_description: "required",
            //demo_link: "required",
            meta_title:"required",
            sort_order: "required",
            status: "required",
            slug: "required",
            //brochure:{
                    
                    //extension:"pdf",
                    //},
            image:{
                    required:true,
                    extension:"jpg|png|gif|jpeg",
                    },
           //amazon_link:"required",
           //filpcart_link:"required",
         },
        messages: {
            main_parent_id:"Please Select Perent",
            category_id:"Please Select Category",
            //model:"Please Enter Model",
            //sku:"Please Enter sku",
            //price: {
                //required:"Please Enter Price",
            //},
            //special_price: {
                //required:"Please Enter special price",
            //},

            //is_feature:"Please Select  is_feature",
            //is_topsell:"Please Select is topsell",
            name:"Please Enter Product Name",
            //sort_description: "Please Enter Product Sort Description",
            //demo_link: "Please Enter Product Demo Link",
            meta_title: "Please Meta Title",
            sort_order: "Please Enter Sort Order", 
            status: "Please Select Status",
            slug: "Please Enter SEO URL",
           // brochure:{
                    //extension:"Please upload file in these format only (jpg, jpeg, png, gif)",
                    // },
            
            image:{
                    required:"Please Select Photo",
                    extension:"Please upload file in these format only (jpg, jpeg, png, gif)",
                     },
            //amazon_link: "Please Enter Amazon Link",
            //filpcart_link: "Please Enter Filpcart Link",
        }
    });
    $("body").on("click", ".btn-submit", function(e){
        if ($("#productForm").valid()){
            $("#productForm").submit();
        }
    });
  });  
</script>
<script type="text/javascript">
  function test(tal){
  var vall= ToSeoUrl(tal);
  //alert(vall);
  $("#slug").val(vall);
}
function ToSeoUrl(url) {
  // make the url lowercase         
  var encodedUrl = url.toString().toLowerCase(); 

  // replace & with and           
  encodedUrl = encodedUrl.split(/\&+/).join("-and-")

  // remove invalid characters 
  encodedUrl = encodedUrl.split(/[^a-z0-9]/).join("-");       

  // remove duplicates 
  encodedUrl = encodedUrl.split(/-+/).join("-");

  // trim leading & trailing characters 
  encodedUrl = encodedUrl.trim('-'); 

  return encodedUrl; 
}
  
</script>