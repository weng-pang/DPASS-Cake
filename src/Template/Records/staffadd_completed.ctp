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
        <p id="staff-name" class="record-info"><?=$staff->surname?>, <?=$staff->given_names?> (<?=$staff->id?>) <?= __('Report Your Attendance')?></p>
        <p class="alert alert-success record-info"><strong class="fa fa-check-circle"></strong> <?= __('Attendance Reported')?></p>
        <div class="text-center margin-top">
            <?php if(isset($language)): ?>
            <?= $this->Html->link(__('Report your attendance again'),['controller'=>'Records','action'=>'staffadd',$link->link,$language],['class'=>'btn btn-primary btn-lg btn-record','style'=>'white-space: normal;'])?>
            <?php else: ?>
            <?= $this->Html->link(__('Report your attendance again'),['controller'=>'Records','action'=>'staffadd',$link->link],['class'=>'btn btn-primary btn-lg btn-record','style'=>'white-space: normal;'])?>
            <?php endif ?>
        </div>
        <div class="text-center margin-top">
            <?= $this->Html->link(__('View Previous Records'),
                '#', [
                    'onclick'=>'viewRecords()',
                    'class'=>'btn btn-info btn-record'
                ]) ?>
        </div>
    </div>
</div>
