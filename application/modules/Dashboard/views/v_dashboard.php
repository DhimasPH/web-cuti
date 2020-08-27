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

    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
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
            <?php echo form_open('#','method="post"'); ?>
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
                  <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary float-sm-right" href="#">Cari</a>
          </div>
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
            <a class="btn btn-primary float-sm-right" href="#"><i class="fas fa-plus"></i>Tambah</a>
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
            Filter Pencarian Data
          </div>
          <div class="card-body">
            <?php echo form_open('#','method="post"'); ?>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Request</label>
                <div class="col-sm-6">
                    <input type="date" name="daterequest_add" class="form-control" placeholder="Start Date">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Requester</label>
                <div class="col-sm-6">
                <input type="text" name="requester_add" <?php if($this->session->userdata('priviledge')== 1) { echo 'value="'.$this->session->userdata('name').'" readonly'; } ?> class="form-control" placeholder="Requester">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                  <input type="text" name="keterangan_add" class="form-control" placeholder="Keterangan">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Dari Tanggal</label>
                <div class="col-sm-6">
                    <input type="date" name="startdate_add" class="form-control" placeholder="Start Date">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                <div class="col-sm-6">
                    <input type="date" name="enddate_add" class="form-control" placeholder="Start Date">
                </div>
              </div>
            <?php echo form_close(); ?>
            <a class="btn btn-primary float-sm-right mb-5" href="#">Add row</a>
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>Keterangan</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a class="btn btn-success float-sm-right" href="#">Simpan</a>
            <a class="btn btn-danger float-sm-left" href="#">Batal</a>
          </div>
        </div>

      </div>

      <div class="container detail-data">

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
            <?php echo form_open('#','method="post"'); ?>
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
                  <input type="text" name="requester" class="form-control" placeholder="Requester">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                  <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary float-sm-right" href="#">Cari</a>
          </div>
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
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
            <a class="btn btn-primary float-sm-right" href="#"><i class="fas fa-plus"></i>Tambah</a>
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

  <script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script>

</body>

</html>