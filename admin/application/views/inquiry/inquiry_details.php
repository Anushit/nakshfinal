  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Show Details </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('inquiry'); ?>" class="btn btn-success"><i class="fa fa-list"></i>Inquiry List</a>

          </div>

        </div>

        <div class="card-body">   
          <div class="container">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action"><strong>Show Details</strong></a>


              <a href="#" class="list-group-item list-group-item-action "><strong>Name</strong>  : <?=$details['name']?></a>
              <a href="#" class="list-group-item list-group-item-action "><strong>Email</strong> : <?=$details['email']?></a>
              <a href="#" class="list-group-item list-group-item-action "><strong>Mesaage</strong> : <?=$details['message']?></a>
              <a href="#" class="list-group-item list-group-item-action "><strong>Subject</strong> : <?=$details['subject']?></a>
              <a href="#" class="list-group-item list-group-item-action "><strong>Mobile</strong> : <?=$details['mobile']?></a>
            </div>

          </div>

        </div>
    </section> 
  </div> 
