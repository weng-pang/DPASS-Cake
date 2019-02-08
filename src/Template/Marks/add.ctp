<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mark $mark
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Marks'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="marks form large-9 medium-8 columns content">
    <?= $this->Form->create($mark) ?>
    <fieldset>
        <legend><?= __('Add Mark') ?></legend>
        <?php
            echo $this->Form->control('keyword');
            echo $this->Form->control('enabled');
            echo $this->Form->control('pass_mark');
            echo $this->Form->control('staff_add_record');
            echo $this->Form->control('staff_add_location');
            echo $this->Form->control('staff_add_photo');
            echo $this->Form->control('mark');
            echo $this->Form->control('create_time');
            echo $this->Form->control('update_time');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
