  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
   
        <div class="row">
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['banner']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $allcounts['ci_banners']; ?></h3>

                <p>Total Banner</p>
              </div>
              <div class="icon">
                <i class="fa fa-picture-o"></i>
              </div>
              <a href="<?= base_url('banner')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['career']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $allcounts['ci_career']; ?></h3>

                <p>Career Records</p>
              </div>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <a href="<?= base_url('career')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
            <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['category']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $allcounts['ci_categories']; ?></h3>

                <p>Total Category</p>
              </div>
              <div class="icon">
                <i class="fa fa-tags"></i>
              </div>
              <a href="<?= base_url('category')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <?php if(@$this->general_user_premissions['cms']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $allcounts['ci_cms']; ?></h3>
                <p>Total CMS Pages</p>
              </div>
              <div class="icon">
                <i class="fa fa fa-file-text-o"></i>
              </div>
              <a href="<?= base_url('cms')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
        
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['photo_gallery']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $photo_gallery; ?></h3>
                <p>Total Image Albums </p>
              </div>
              <div class="icon">
                <i class="fa fa-file-image-o"></i>
              </div>
              <a href="<?= base_url('photo_gallery')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
           <?php if(@$this->general_user_premissions['video_gallery']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $video_gallery; ?></h3>
                <p>Total Video Albums</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-video-o"></i>
              </div>
              <a href="<?= base_url('video_gallery')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
         
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['career']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $allcounts['ci_job_application']; ?></h3>

                <p>Job Applictions</p>
              </div>
              <div class="icon">
                <i class="fa fa-briefcase"></i>
              </div>
              <a href="<?= base_url('career')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php  }?>
         
        
          <?php if(@$this->general_user_premissions['portfolio']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $allcounts['ci_portfolio']; ?></h3>
                <p>Total Portfolio</p>
              </div>
              <div class="icon">
                <i class="fa fa-briefcase"></i>
              </div>
              <a href="<?= base_url('portfolio')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
          
          <?php if(@$this->general_user_premissions['portfolio']['is_allow']==1){ ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $allcounts['ci_products']; ?></h3>

                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-basket"></i>
              </div>
              <a href="<?= base_url('products')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
         
         
          <!-- ./col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
