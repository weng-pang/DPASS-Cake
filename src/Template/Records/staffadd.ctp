<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 * @var \App\Model\Entity\Staff $staff
 */
?>
<div class="">
    <h3><?= __('Attendance Adding')?></h3>
    <p><?= $staff->organisations[0]->name?></p>
    <p id="staff-name"><?=$staff->surname?>, <?=$staff->given_names?></p>
</div>
<div class="record">

    <?= $this->Form->create($record,['enctype' => 'multipart/form-data']) ?>

    <p id="location-service"></p>
        <?php // TODO Add the photo field

            echo $this->Form->hidden('staff_id');
            echo $this->Form->hidden('longitude',['id' => 'longitude']);
            echo $this->Form->hidden('latitude',['id' => 'latitude']);
            echo $this->Form->hidden('accuracy',['id' => 'accuracy']);
            echo $this->Form->control('photo',[
                    'type' => 'file',
                    'accept' => 'image/*',
                    'capture' => 'camera',
                ]);
        ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<div>
    <p class="Failed"><?=__('Please Use Mobile Phone')?></p>
</div>
<div id="records">
    <p><?=__('Latest Records')?></p>
    <?php foreach($records as $item):?>
    <p><?=$item->time?></p>
    <?php endforeach?>
</div>
<script>
    // Get all the relevant elements
    let latitude = document.getElementById('latitude');
    let longitude = document.getElementById('longitude');
    let accuracy = document.getElementById('accuracy');
    let locationDisplay =  document.getElementById('location-service');
    function getLocation(){
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition, showError);
            locationDisplay.innerHTML = "<?=__('Location is ready for upload')?>";
        } else {
            // TODO populate the warning message
            locationDisplay.innerHTML = "<?=__('Location Service is not supported by this browser.')?>";
            locationDisplay.classList.add('failed'); //TODO check with layout
        }
    }

    function showPosition(position){
        latitude.value = position.coords.latitude;
        longitude.value = position.coords.longitude;
        accuracy.value = position.coords.accuracy;
    }

    function showError(error){
        locationDisplay.classList.add('failed'); //TODO check with layout
        switch(error.code) {
            case error.PERMISSION_DENIED:
                locationDisplay.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                locationDisplay.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                locationDisplay.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                locationDisplay.innerHTML = "An unknown error occurred."
                break;
        }
    }

    getLocation();
</script>
