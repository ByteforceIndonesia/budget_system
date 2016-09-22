<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> <?php echo $title ?> | Budget System</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>

    <!-- CSS and Javascript -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css">
    <script src="<?php echo base_url() ?>js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>js/progressbar.min.js"></script>
    <script src="<?php echo base_url() ?>js/chart.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>js/moment.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>js/script.js"></script>

  </head>
  <body>
  <div class="container-fluid">
    <!-- Header and Navs -->
    <section id="header">
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="triggerMenu()" style="border-bottom: none;font-size:25px!important;">&times;</a>
        
        <a href="<?php echo base_url() ?>"><div class="icon-navbar"><i class="fa fa-home" aria-hidden="true"></i></div><span class="menu-text">Home</span></a>
        <a href="<?php echo base_url('new_budget/monthly') ?>"><div class="icon-navbar"><i class="fa fa-plus" aria-hidden="true"></i></div><span class="menu-text">New Monthly Limit</span></a>
        <a href="<?php echo base_url('new_budget/transaction') ?>"><div class="icon-navbar"><i class="fa fa-plus" aria-hidden="true"></i></div><span class="menu-text">New Transaction</span></a>
        <a href="<?php echo base_url('main/all_transactions/') ?>"><div class="icon-navbar"><i class="fa fa-dollar" aria-hidden="true"></i></div><span class="menu-text">All Transactions This Month</span></a> 
        <a href="<?php echo base_url('main/year_overview') ?>"><div class="icon-navbar"><i class="fa fa-bar-chart" aria-hidden="true"></i></div><span class="menu-text">See Yearly Overview</span></a>
        <a href="<?php echo base_url('accounts/logout') ?>"><div class="icon-navbar"><i class="fa fa-power-off" aria-hidden="true"></i></div><span class="menu-text">Logout</span></a>
      </div>
      

    <div class="container">
      <div class="row">
        <div id="openMenu">
          <a onclick="triggerMenu()"><i class="fa fa-bars fa-3x" aria-hidden="true" id="menu-button"></i></a>
        </div>
        <div class="text-center" style="padding-top:10px;padding-bottom:10px;">
          <img src="<?php echo base_url().'img/logo.png' ?>">
        </div>        
      </div>
    </div>
    </section>

    <?php echo $body ?>

    <!-- Footer -->
    
  </div>
  </body>

  <!-- Swals -->
  <?php if($this->session->flashdata('failed')): ?>
    <script>
      swal({
         title: "Failed!",   
         text: "<?php echo $this->session->flashdata('failed') ?>",   
         type: "error",
         showConfirmButton: false,
         timer:2000
      });
    </script>
  <?php elseif($this->session->flashdata('success')): ?>
    <script>
      swal({
         title: "Success!",   
         text: "<?php echo $this->session->flashdata('success') ?>",   
         type: "success",
         showConfirmButton: false,
         timer:2000
      });
    </script>
  <?php endif; ?>
  
</html>