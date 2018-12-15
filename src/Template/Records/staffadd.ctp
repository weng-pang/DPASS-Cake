<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Records'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="records form large-9 medium-8 columns content">

    <?= $this->Form->create($record) ?>
    <h2><?= __('Attendance Adding')?></h2>
    <p><?= __('Company Name')?></p>
    <p><?=$link->staff->surname?>, <?=$link->staff->given_names?></p>
    <p id="location-service"></p>
    <fieldset>
        <legend><?= __('Attendance Report') ?></legend>
        <?php // TODO Add the photo field

            echo $this->Form->hidden('staff_id');
            echo $this->Form->hidden('longtitude',['id' => 'longtitude']);
            echo $this->Form->hidden('latitude',['id' => 'latitude']);
            echo $this->Form->hidden('accuracy',['id' => 'accuracy']);
            echo $this->Form->control('photo',[
                    'type' => 'file',
                    'accept' => 'image/*',
                    'capture' => 'camera',
                ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    // Get all the relevant elements
    let latitude = document.getElementById('latitude');
    let longitude = document.getElementById('longtitude');
    let accuracy = document.getElementById('accuracy');
    let locationDisplay =  document.getElementById('location-service');
    function getLocation(){
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition);
            locationDisplay.innerHTML = "<?=__('Location is ready for upload')?>";
        } else {
            // TODO populate the warning message
            locationDisplay.innerHTML = "<?=__('Unable to obtain location')?>";
            locationDisplay.classList.add('failed'); //TODO check with layout
        }
    }

    function showPosition(position){
        latitude.value = position.coords.latitude;
        longitude.value = position.coords.longitude;
        accuracy.value = position.coords.accuracy;
    }

    getLocation();
</script>
