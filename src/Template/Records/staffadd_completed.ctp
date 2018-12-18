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
        <p class="text-center alert alert-success"><?= __('Attendance Reported')?></p>
        <p id="staff-name" class="text-center alert alert-info"><?=$staff->surname?>, <?=$staff->given_names?> (<?=$staff->id?>)</p>
        <p>
            <?php if(isset($language)): ?>
            <?= $this->Html->link(__('Report your attendance'),['controller'=>'Records','action'=>'staffadd',$link->link,$language])?>
            <?php else: ?>
            <?= $this->Html->link(__('Report your attendance'),['controller'=>'Records','action'=>'staffadd',$link->link])?>
            <?php endif ?>
        </p>
        <div class="text-center">
            <?= $this->Html->link(__('View Previous Records'),
                '#', [
                    'onclick'=>'viewRecords()',
                    'class'=>'d-block mt-3'
                ]) ?>
        </div>
    </div>
</div>
