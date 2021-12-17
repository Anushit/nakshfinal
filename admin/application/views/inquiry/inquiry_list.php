<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-question-circle"></i>&nbsp; Inquiry List </h3>
        </div> 
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20"> 
            <a href="<?= base_url() ?>inquiry/create_inquiry_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>inquiry/export_csv" class="btn btn-secondary">Export as CSV</a>&nbsp
             <?php  if(@$this->general_user_premissions['inquiry']['is_add']==1){ ?>
            <a href="<?= base_url('inquiry/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Inquiry</a>
              <?php } ?>
          </div> 
        </div>
      </div>
    </div>
    

    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#ID</th> 
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Inquiry Type</th>
              <th>IP Address</th>
              <th>Created Date</th> 
              <th width="100" class="text-right">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>  
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Inquery Details</h4>
        </div>
        <div class="modal-body">
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('inquiry/datatable_json')?>",
    "order": [[6,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "ci_inquiry.id", 'searchable':true, 'orderable':true}, 
    { "targets": 1, "name": "ci_inquiry.name", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "ci_inquiry.mobile", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "ci_inquiry.email", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "ci_inquiry.inquiry_type", 'searchable':true, 'orderable':true},
    { "targets": 5, "name": "ip_address", 'searchable':true, 'orderable':true},
    { "targets": 6, "name": "ci_inquiry.created_at", 'searchable':false, 'orderable':false}, 
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
  $("#external-filter").click(function(e) {
        table.on('preXhr.dt', function(e, settings, data) {
            var external_search = false;
            var location_search_added = false; 
            if ($("#search_inquery_date").val() != "") {              
                data.inquery_date = $("#search_inquery_date").val();
                external_search = true
            }
            if ($("#search_inqueryfollowup_date").val() != "") {              
                data.followup_date = $("#search_inqueryfollowup_date").val();
                external_search = true
            }
            
          
            if ($("#inquiry_type").val() != 0 ) {
                data.inquiry_type = $("#inquiry_type").val();
                external_search = true
            }
            if ($("#inquiry_mode").val() != 0 ) {
                data.inquiry_mode = $("#inquiry_mode").val();
                external_search = true
            }
            
            data.external_search = external_search;
        });

        table.draw();
    });

    $("#external-filter-reset").click(function(e) {       
        $("#search_inquery_date").val(""); 
        $("#inquiry_type").val("0");
        $("#inquiry_mode").val("0");
        
        table.on('preXhr.dt', function(e, settings, data) {
            delete data.external_search;
            delete data.search_inquery_date; 
            delete data.inquiry_type;
            delete data.inquiry_mode;             
        });
        table.draw();
    });



    function approveRejectVideo(id, is_approved){
  //alert("hello");
    var message = "You want to done ?"
    if(is_approved==2){
      var message = "You want to reject this?"
    }
    var array = {'id':id,'is_approved':is_approved };

    var confirma = confirm(message);

    if(confirma)
    {
       $.ajax({
                 type: "GET",
                 url: "<?=base_url('inquiry/approvereject')?>",
                 data: array, // serializes the form's elements.
                 success: function(data)
                 {   
                    
                   $.notify("Changed Successfully", "success");
                   location.reload();
                 }
               });
    }

  }

  function Follow_up(id, follow_up){
    //alert("hello");

    var message = "You want to followup?"
    if(follow_up==0){
      var message = "You want to Unfollow?"
    }
    var array = {'id':id,'follow_up':follow_up };

    var confirma = confirm(message);

    if(confirma)
    {
       $.ajax({
                 type: "GET",
                 url: "<?=base_url('inquiry/followup')?>",
                 data: array, // serializes the form's elements.
                 success: function(data)
                 {   
                    
                   $.notify("Changed Successfully", "success");
                   location.reload();
                 }
               });
    }

  }

  function details_view(id){
    //console.log(id);
     alert(id);
    // alert(name);
  }
</script> 
