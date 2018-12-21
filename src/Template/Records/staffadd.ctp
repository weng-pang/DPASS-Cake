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



<div id="no-photo-confirm" title="<?=__('Photo is not attached')?>" style="display: none">
    <p><?=__('Photo is not attached. Are you sure to continue?')?></p>
</div>

<script>
    // Get all the relevant elements
    let latitude = document.getElementById('latitude');
    let longitude = document.getElementById('longitude');
    let accuracy = document.getElementById('accuracy');
    let locationDisplay =  document.getElementById('location-service');

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
    function locationSuccess(){
        locationDisplay.classList.remove('alert-danger');
        locationDisplay.classList.remove('fa-times-circle');
        locationDisplay.classList.add('alert-success');
        locationDisplay.classList.add('fa-check-circle');
    }

    function locationFail(){
        locationDisplay.classList.remove('alert-success');
        locationDisplay.classList.remove('fa-check-circle');
        locationDisplay.classList.add('alert-danger');
        locationDisplay.classList.add('fa-times-circle');
    }

    function getLocation(){
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition, showError);

        } else {
            // TODO populate the warning message
            locationDisplay.innerHTML = " <?=__('Location Service is not supported by this browser.')?>";
            locationFail();
        }
    }

    function showPosition(position){
        latitude.value = position.coords.latitude;
        longitude.value = position.coords.longitude;
        accuracy.value = position.coords.accuracy;
        locationDisplay.innerHTML = " <?=__('Location is ready for upload')?>";
        locationSuccess();
    }

    function showError(error){
        switch(error.code) {
            case error.PERMISSION_DENIED:
                locationDisplay.innerHTML = " <?=__('User denied the request for Geolocation.')?>";
                break;
            case error.POSITION_UNAVAILABLE:
                locationDisplay.innerHTML = " <?=__('Location information is unavailable.')?>";
                break;
            case error.TIMEOUT:
                locationDisplay.innerHTML = " <?=__('The request to get user location timed out.')?>";
                break;
            default:
                locationDisplay.innerHTML = " <?=__('An unknown error occurred.')?>:";
                break;
        }
        locationFail();
    }
    function checkPhotoUpload(){
        if (document.getElementById("photo").files.length == 0){
            $( "#no-photo-confirm" ).dialog( "open" );
            event.returnValue = false; // Stop the original form submit
        }
    }

    getLocation();
</script>
