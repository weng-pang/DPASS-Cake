<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 * @var \App\Model\Entity\Staff $staff
 */
?>
<div class="card card-login mx-auto mt-5 d-md-none">
    <h3 class="card-header"><?= __($staff->organisations[0]->name)?></h3>
    <div class="card-body text-center mb-4">
        <?= $this->Form->create($record,[
                'enctype' => 'multipart/form-data',
            'class'=>'form-group',
            'id'=>'record-form']) ?>
        <p class="text-center"><?= __('Report Your Attendance')?></p>
        <p id="staff-name" class="text-center alert alert-info"><?=$staff->surname?>, <?=$staff->given_names?> (<?=$staff->id?>)</p>
        <p id="location-service" class="alert alert-success"></p>
        <p id="message-service" class="alert alert-success d-none"></p>
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
        <?= $this->Form->button(__('Submit'),[
                'onclick'=>'checkPhotoUpload()',
            'class'=>'btn btn-primary btn-block'
        ]) ?>
        <?= $this->Form->end() ?>
        <div class="text-center">
            <?= $this->Html->link(__('View Previous Records'),
                '#', [
                        'onclick'=>'viewRecords()',
                    'class'=>'d-block mt-3'
                ]) ?>
        </div>
    </div>
</div>
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

    function getLocation(){
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition, showError);
            locationDisplay.innerHTML = "<?=__('Location is ready for upload')?>";
        } else {
            // TODO populate the warning message
            locationDisplay.innerHTML = "<?=__('Location Service is not supported by this browser.')?>";
            locationDisplay.classList.add('alert-danger');
            locationDisplay.classList.remove('alert-success');
        }
    }

    function showPosition(position){
        latitude.value = position.coords.latitude;
        longitude.value = position.coords.longitude;
        accuracy.value = position.coords.accuracy;
    }

    function showError(error){
        locationDisplay.classList.add('alert-danger');
        locationDisplay.classList.remove('alert-success');
        switch(error.code) {
            case error.PERMISSION_DENIED:
                locationDisplay.innerHTML = "<?=__('User denied the request for Geolocation.')?>";
                break;
            case error.POSITION_UNAVAILABLE:
                locationDisplay.innerHTML = "<?=__('Location information is unavailable.')?>";
                break;
            case error.TIMEOUT:
                locationDisplay.innerHTML = "<?=__('The request to get user location timed out.')?>";
                break;
            default:
                locationDisplay.innerHTML = "<?=__('An unknown error occurred.')?>:";
                break;
        }
    }
    function checkPhotoUpload(){
        if (document.getElementById("photo").files.length == 0){
            $( "#no-photo-confirm" ).dialog( "open" );
            event.returnValue = false; // Stop the original form submit
        }
    }

    function viewRecords(){
        $( "#records" ).dialog( "open" );
    }

    getLocation();
</script>
