<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 * @var \App\Model\Entity\Staff $staff
 */
?>
<div class="">
    <h3><?= __('Attendance Reported')?></h3>
    <p><?= $staff->organisations[0]->name?></p>
    <p id="staff-name"><?=$staff->surname?>, <?=$staff->given_names?></p>
    <?php if(isset($language)): ?>
    <p><?= $this->Html->link(__('Report your attendance'),['controller'=>'Records','action'=>'staffadd',$link->link,$language])?></p>
    <?php else: ?>
    <p><?= $this->Html->link(__('Report your attendance'),['controller'=>'Records','action'=>'staffadd',$link->link])?></p>
    <?php endif ?>
</div>
<div id="records">
    <p><?=__('Latest Records')?></p>
    <?php foreach($records as $item):?>
        <p><?=$item->time?></p>
    <?php endforeach?>
</div>