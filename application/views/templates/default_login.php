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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css">
    <script src="<?php echo base_url() ?>js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>js/script.js"></script>

  </head>
  <body>
    
    <?php echo $body ?>

  </body>

  <!-- Swals -->
  <?php if($this->session->flashdata('failed')): ?>
    <script>
      swal({
         title: "Failed!",   
         text: "<?php echo $this->session->flashdata('failed') ?>",   
         type: "error",
         showConfirmButton: "false"
      });
    </script>
  <?php elseif($this->session->flashdata('success')): ?>
    <script>
      swal({
         title: "Success!",   
         text: "<?php echo $this->session->flashdata('success') ?>",   
         type: "success",
         showConfirmButton: "false"
      });
    </script>
  <?php endif; ?>
  
</html>