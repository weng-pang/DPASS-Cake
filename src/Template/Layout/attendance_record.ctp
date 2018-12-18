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
      <script>
          $( document ).ready(function() {
              $( function() {
                  $("#records").dialog({
                      autoOpen: false,
                      resizable: false,
                      show: {
                          effect: "blind",
                          duration: 1000
                      },
                      hide: {
                          effect: "blind",
                          duration: 1000
                      }
                  });
              });
          });
      </script>
  </head>

  <body class="bg-dark">
    <div class="container">
        <?= $this->fetch('content') ?>
        <div class="card card-login mx-auto mt-5 d-none d-md-block">
            <div class="card-body">
                <p class="alert alert-danger"><span class="ui-icon ui-icon-closethick"></span> <?=__('Please Use Mobile Phone for this page')?></p>
            </div>
        </div>
        <div id="records" class="card card-login mx-auto" title="<?=__('Latest Records')?>">
            <p><?=__('Displaying the latest {0} records',($recordLimit))?></p>
            <?php foreach($records as $item):?>
                <p><?=$item->time?></p>
            <?php endforeach?>
        </div>
    </div>
  </body>
<script>
    function viewRecords(){
        $( "#records" ).dialog( "open" );
    }
</script>
</html>
