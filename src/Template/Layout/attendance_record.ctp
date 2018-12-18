<?php
/**
 * Created by PhpStorm.
 * User: warre
 * Date: 18/12/2018
 * Time: 10:14
 */
?>
<!DOCTYPE html>
<html>
  <head>
      <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?= $this->fetch('title') ?>
    </title>

    <!-- Bootstrap core CSS-->
      <?= $this->Html->css('bootstrap.min') ?>
    <!-- Custom fonts for this template-->
      <?= $this->Html->css('font-awesome.min') ?>
    <!-- Custom styles for this template-->
      <?= $this->Html->css('sb-admin-2') ?>
      <?= $this->Html->css('jquery-ui') ?>
      <?= $this->Html->css('attendance_record') ?>

      <?= $this->fetch('script') ?>
      <!-- Bootstrap core JavaScript-->
      <?= $this->Html->script('jquery-3.3.1.min') ?>
      <?= $this->Html->script('bootstrap.min') ?>
      <?= $this->Html->script('jquery-ui') ?>
  </head>

  <body class="bg-dark">
    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
  </body>
</html>
