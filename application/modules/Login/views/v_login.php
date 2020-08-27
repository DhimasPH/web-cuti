<!-- =====================================================================================================
============================== Halooo !!! ngintip aja bro ================================================
==========================================================================================================

NYARI APA NIH? HEHE...
SELAMAT BELAJAR, JANGAN JADI ORANG BIASA !!! HUSST JANGAN BILANG BILANG UDAH LIAT INI !

==========================================================================================================
==========================================================================================================
=======================================================================================================-->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="soladev.id">
  
  <title>WEB Cuti - Masuk</title>
  
  <!-- Custom fonts for this template-->
  <link href="<?php echo site_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo site_url()?>assets/css/bootstrap.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card card-login mx-auto mt-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Masuk</h1>
                  </div>
                  <?php if ($this->session->flashdata('alert')) { ?>
                  <div class="alert alert-<?php echo $this->session->flashdata('alert')?> alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('message')?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php } ?>
                  <?php echo form_open('Login/check','method="post" class="user"');?>
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" required placeholder="Enter username ..." autocomplete="off" value="<?php echo $this->session->flashdata('username')?>">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                    </div>
                    <button type="submit" href="index.html" class="btn btn-primary btn-user btn-block">
                      Submit
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo site_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo site_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
