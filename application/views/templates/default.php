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
    <link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/footable.metro.min.css" type="text/css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>

    <!-- CSS and Javascript -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css">

    
    <script src="<?php echo base_url() ?>js/footable.js"></script>
    <script src="<?php echo base_url() ?>js/footable.filter.js"></script>
    <script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
    <script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>

    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">

    <script src="<?php echo base_url() ?>js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>js/progressbar.min.js"></script>
    <script src="<?php echo base_url() ?>js/chart.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>js/moment.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>js/script.js"></script>
  
    <style>
      /* footable */
    .footable{
      background :white !important;
      border : 2px solid #948A6A !important;
      width: 100% !important;
    }

    .footable>thead>tr>th, .footable>thead>tr>td { 
      
      background-color : #948A6A !important;
      border : 1px solid #948A6A !important;
      color: white !important;

    }

    .footable>tfoot>tr>th, .footable>tfoot>tr>td { 
      
      background-color : #948A6A !important;
      border : 1px solid #948A6A !important

    }
    #body{
      min-height: 450px;
      padding-bottom: 30px;
    }
    </style>
  </head>
  <body>
  <div class="container-fluid">
    <!-- Header and Navs -->
    <section id="header">
      <div id="mySidenav" class="sidenav">

        <a href="javascript:void(0)" class="closebtn" onclick="triggerMenu()" style="border-bottom: none;font-size:25px!important;">&times;</a>
        
        <a href="<?php echo base_url() ?>"><div class="icon-navbar"><i class="fa fa-home" aria-hidden="true"></i></div><span class="menu-text">Halaman Utama</span></a>
        <a href="<?php echo base_url('new_budget/monthly') ?>"><div class="icon-navbar"><i class="fa fa-plus" aria-hidden="true"></i></div><span class="menu-text">Buat Limit Budget Bulanan Baru</span></a>
        <a href="<?php echo base_url('new_budget/transaction') ?>"><div class="icon-navbar"><i class="fa fa-plus" aria-hidden="true"></i></div><span class="menu-text">Buat Transaksi Baru</span></a>
        <a href="<?php echo base_url('main/detail_cicilan/') ?>"><div class="icon-navbar"><i class="fa fa-dollar" aria-hidden="true"></i></div><span class="menu-text">Lihat Detail Cicilan Bulanan</span></a>
        <a href="<?php echo base_url('main/all_transactions/') ?>"><div class="icon-navbar"><i class="fa fa-dollar" aria-hidden="true"></i></div><span class="menu-text">Detail Transaksi Bulanan</span></a> 
        <a href="<?php echo base_url('main/year_overview') ?>"><div class="icon-navbar"><i class="fa fa-bar-chart" aria-hidden="true"></i></div><span class="menu-text">Laporan Limit Tahunan</span></a>
        <a href="<?php echo base_url('accounts/change_password') ?>"><div class="icon-navbar"><i class="fa fa-cogs" aria-hidden="true"></i></div><span class="menu-text">Ubah Password</span></a>
        <a href="<?php echo base_url('main/setting_timer') ?>"><div class="icon-navbar"><i class="fa fa-cogs" aria-hidden="true"></i></div><span class="menu-text">Atur Jam</span></a>
        <a href="<?php echo base_url('accounts/logout') ?>"><div class="icon-navbar"><i class="fa fa-power-off" aria-hidden="true"></i></div><span class="menu-text">Logout</span></a>
        
      </div>
      

    <div class="container-fluid">
      <div class="row">
        <div id="openMenu">
          <a onclick="triggerMenu()"><i class="fa fa-bars fa-3x" aria-hidden="true" id="menu-button"></i></a>
        </div>
        <div style="padding-top:10px;padding-bottom:10px;">
          <img src="<?php echo base_url().'img/logo.png' ?>" alt="Saerah Logo" class="img img-responsive" style="display: block;margin:auto">
        </div>        
      </div>
    </div>
    </section>
  
    <section id="body">
      <?php echo $body ?>
    </section>

    <!-- Footer -->
    
      <footer style="height: 40px; font-size: 12px; width: 100%" class="row">
        <div class="col-xs-12 text-center">
          <p>Budget System by Hassee Under LRM Corporation</p>
          <p>Copyright All Rights Reserved &copy; 2016</p>
        </div>
        
      </footer>
  
  </div>
  </body>

  <!-- Swals -->
  <?php if($this->session->flashdata('failed')): ?>
    <script>
      swal({
         title: "Gagal!",   
         text: "<?php echo $this->session->flashdata('failed') ?>",   
         type: "error",
         showConfirmButton: true,
         closeOnConfirm : true,
      });
    </script>
  <?php elseif($this->session->flashdata('success')): ?>
    <script>
      swal({
         title: "Berhasil!",   
         text: "<?php echo $this->session->flashdata('success') ?>",   
         type: "success",
         showConfirmButton: true,
         closeOnConfirm : true,
      });
    </script>
  <?php endif; ?>
  
</html>