<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>WEB Cuti | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Custom fonts for this template-->
    <link href="<?php echo site_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo site_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- Load css tambahan-->
    <link href="<?php echo base_url()?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    
</head>
<body>

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Hai <?php echo $this->session->userdata('name') ?></a>

    <div class="form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?php echo site_url()?>Dashboard/logout">Logout</a>
            </div>
        </li>
        </ul>
    </div>

  </nav>

  <div id="wrapper">

    <div id="content-wrapper">
      <noscript>Please enable the javascript.</noscript>

      <div class="container list-data">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>List Cuti</a>
          </li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            Filter Pencarian Data
          </div>
          <div class="card-body">
            <?php echo form_open('#','method="get" class="filter_data"'); ?>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Request</label>
                <div class="col-sm-6 row">
                  <div class="col-6">
                    <input type="date" name="startdate" class="form-control" placeholder="Start Date">
                  </div>
                  <div class="col-6">
                    <input type="date" name="enddate" class="form-control" placeholder="End Date">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Requester</label>
                <div class="col-sm-6">
                  <input type="text" name="requester" <?php if($this->session->userdata('priviledge')== 1) { echo 'value="'.$this->session->userdata('name').'" readonly'; } ?> class="form-control" placeholder="Requester">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                  <input type="text" name="desc" class="form-control" placeholder="Keterangan">
                </div>
              </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary float-sm-right" type="submit">Cari</button>
          </div>
          <?php echo form_close(); ?>
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>Tanggal Request</th>
                    <th>Requester</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary float-sm-right" id="add-cuti" href="#add-leave"><i class="fas fa-plus"></i>Tambah</a>
          </div>
        </div>

      </div>

      <div class="container add-data">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Input Cuti</a>
          </li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            Form Input Cuti
          </div>
          <div class="card-body">
            <?php echo form_open('#','method="post" id="form-add" '); ?>
              <input type="hidden" value="<?php echo $this->session->userdata('priviledge'); ?>" name="priviledge">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Request</label>
                <div class="col-sm-6">
                    <input type="date" name="daterequest_add" class="form-control" placeholder="Tanggal Request" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Requester</label>
                <div class="col-sm-6">
                <input type="text" name="requester_add" <?php if($this->session->userdata('priviledge')== 1) { echo 'value="'.$this->session->userdata('name').'" readonly'; } ?> class="form-control" placeholder="Requester" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                  <input type="text" name="desc_add" class="form-control" placeholder="Keterangan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Dari Tanggal</label>
                <div class="col-sm-6">
                    <input type="date" name="startdate_add" class="form-control" placeholder="Dari Tanggal" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                <div class="col-sm-6">
                    <input type="date" name="enddate_add" class="form-control" placeholder="Sampai Tanggal" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Cuti</label>
                <div class="col-sm-6">
                  <input type="text" name="jenis_add" class="form-control" placeholder="Jenis Cuti" required>
                </div>
              </div>
              <button class="btn btn-primary float-sm-right mb-5" type="submit">Add row</button>
            <?php echo form_close(); ?>
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>Jenis Cuti</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="table-add">
                 
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-warning float-sm-left" href="<?php echo site_url();?>">Batal</a>
            <a class="btn btn-primary float-sm-right" id="save-add" href="#">Simpan</a>
          </div>
        </div>

      </div>

      <div class="container detail-data">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Detail Cuti</a>
          </li>
        </ol>

        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2"><h6>Tanggal Request</h6></div>
              <div class="col-sm-6" id="detail_date_request">
                
              </div>
            </div>
            <div class="row">
              <div  class="col-sm-2"><h6>Requester</h6></div>
              <div class="col-sm-6" id="detail_requester">
                
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2"><h6>Keterangan</h6></div>
              <div class="col-sm-6" id="detail_desc">
                
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>Jenis Cuti</th>
                  </tr>
                </thead>
                <tbody id="table-detail">
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary float-sm-right" href="<?php echo site_url() ?>">Kembali ke halaman list</a>
            <a class="btn btn-primary float-sm-left" id="edits_data"  href="#">Edit</a>
          </div>
        </div>

      </div>

      <div class="container edit-data">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Edit Cuti</a>
          </li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            Form Edit Cuti
          </div>
          <div class="card-body">
            <?php echo form_open('#','method="post" id="form-edit" '); ?>
              <input type="hidden" value="<?php echo $this->session->userdata('priviledge'); ?>" name="priviledge">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Request</label>
                <div class="col-sm-6">
                    <input type="date" name="daterequest_edit" class="form-control" placeholder="Tanggal Request" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Requester</label>
                <div class="col-sm-6">
                <input type="text" name="requester_edit" <?php if($this->session->userdata('priviledge')== 1) { echo 'value="'.$this->session->userdata('name').'" readonly'; } ?> class="form-control" placeholder="Requester" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                  <input type="text" name="desc_edit" class="form-control" placeholder="Keterangan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Dari Tanggal</label>
                <div class="col-sm-6">
                    <input type="date" name="startdate_edit" class="form-control" placeholder="Dari Tanggal" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                <div class="col-sm-6">
                    <input type="date" name="enddate_edit" class="form-control" placeholder="Sampai Tanggal" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Cuti</label>
                <div class="col-sm-6">
                  <input type="text" name="jenis_edit" class="form-control" placeholder="Jenis Cuti" required>
                </div>
              </div>
              <button class="btn btn-primary float-sm-right mb-5" type="submit">Add row</button>
            <?php echo form_close(); ?>
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>Jenis Cuti</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="table-edit">
                 
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-warning float-sm-left" href="<?php echo site_url();?>">Batal</a>
            <a class="btn btn-primary float-sm-right" id="save-edit" href="#">Simpan</a>
          </div>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
  <script src="<?php echo base_url()?>assets/js/main.js"></script>

</body>

</html>