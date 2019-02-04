<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 * @var \App\Model\Entity\Staff $staff
 */
?>
<div class="card card-login mx-auto mt-5 d-md-none">
    <h3 class="card-header"><?= __($staff->organisations[0]->name)?></h3>
    <div class="card-body mb-4">
        <?= $this->Form->create($record,[
                'enctype' => 'multipart/form-data',
            'class'=>'form-group',
            'id'=>'record-form']) ?>
        <p id="staff-name" class="record-info"><?=$staff->surname?>, <?=$staff->given_names?> (<?=$staff->id?>) <?= __('Report Your Attendance')?></p>
        <p id="location-service" class="alert alert-danger fa"><?=__('Location Service is loading')?></p>
        <p id="message-service" class="alert alert-success d-none record-info"></p>
        <?php // TODO Add the photo field
            echo $this->Form->hidden('staff_id');
            echo $this->Form->hidden('longitude',['id' => 'longitude']);
            echo $this->Form->hidden('latitude',['id' => 'latitude']);
            echo $this->Form->hidden('accuracy',['id' => 'accuracy']);?>
        <div class="card-register">
            <?php    echo $this->Form->control('photo',[
                        'type' => 'file',
                        'accept' => 'image/*',
                        'capture' => 'camera',
                        'class' => 'form-control',
                        'label' => __('Take a Photo')
                    ]);
            ?>
        </div>
        <div class="text-center">
        <?= $this->Form->button(__('Submit'),[
                'onclick'=>'checkPhotoUpload()',
            'class'=>'btn btn-primary btn-lg btn-record text-center'
        ]) ?>
        </div>
        <?= $this->Form->end() ?>
        <div class="text-center">
            <?= $this->Html->link(__('View Previous Records'),
                '#', [
                        'onclick'=>'viewRecords()',
                    'class'=>'btn btn-info btn-record'
                ]) ?>
        </div>
    </div>
</div>

<div id="no-photo-confirm" title="<?=__('Photo is not attached')?>" style="display:none">
    <p><?=__('Photo is not attached. Are you sure to continue?')?></p>
</div>
<div id="long-loading" style="display:none">
    <p><?=__('Still Uploading......?')?></p>
    <a href="#" class="btn btn-info btn-record" onclick="window.location.reload(true);"><?=__('Retry again')?></a>
</div>
<?= $this->Html->script('staffadd.modules.min') ?>
<script>
    let ready = " <?=__('Location is ready for upload')?>";
    let notSupported = " <?=__('Location Service is not supported by this browser.')?>";
    let denied = " <?=__('User denied the request for Geolocation.')?>";
    let unavailable = " <?=__('Location information is unavailable.')?>";
    let timeout = " <?=__('The request to get user location timed out.')?>";
    let unknown = " <?=__('An unknown error occurred.')?>:";

    let wait = '<?=__('Please Wait')?>';
    let loading = "<?=__('Still Uploading...')?>";
    let waitTime = <?= $waitTime?>;

    $( function() {
        $( "#no-photo-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            modal: true,
            buttons: {
                "<?=__('Yes')?>": function() {
                    $( "#record-form" ).submit();
                },
                "<?=__('Cancel')?>": function() {
                    event.returnValue = false;
                    $( this ).dialog( "close" );
                }
            }
        });
    } );

    getLocation();
</script>
