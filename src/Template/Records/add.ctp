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
            echo $this->Form->control('record_id');
            echo $this->Form->control('staff_id');
            echo $this->Form->control('longtitude');
            echo $this->Form->control('latitude');
            echo $this->Form->control('accuracy');
            echo $this->Form->control('time', ['empty' => true]);
            echo $this->Form->control('additional_data');
            echo $this->Form->control('http_user_agent');
            echo $this->Form->control('http_cf_ray');
            echo $this->Form->control('http_cf_connecting_ip');
            echo $this->Form->control('http_cookie');
            echo $this->Form->control('create_time', ['empty' => true]);
            echo $this->Form->control('update_time', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
