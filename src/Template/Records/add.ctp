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
    <fieldset>
        <legend><?= __('Add Record') ?></legend>
        <?php
            echo $this->Form->control('id');
            echo $this->Form->control('datetime');
            echo $this->Form->control('machineid');
            echo $this->Form->control('entryid');
            echo $this->Form->control('ipaddress');
            echo $this->Form->control('portnumber');
            echo $this->Form->control('update');
            echo $this->Form->control('key');
            echo $this->Form->control('revoked');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
