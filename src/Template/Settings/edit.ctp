<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting $setting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $setting->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Settings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Managers'), ['controller' => 'Managers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manager'), ['controller' => 'Managers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="settings form large-9 medium-8 columns content">
    <?= $this->Form->create($setting) ?>
    <fieldset>
        <legend><?= __('Edit Setting') ?></legend>
        <?php
            echo $this->Form->control('keyword');
            echo $this->Form->control('enabled');
            echo $this->Form->control('content');
            echo $this->Form->control('language_id', ['options' => $languages, 'empty' => false]);
            echo $this->Form->control('manager_id', ['options' => $managers, 'empty' => false]);
            echo $this->Form->control('dpass_rest_enabled');
            echo $this->Form->control('dpass_rest_code');
            echo $this->Form->control('dpass_rest_add_address');
            echo $this->Form->control('dpass_rest_key');
            echo $this->Form->control('staffadd_wait_time');
            echo $this->Form->control('staffadd_view_limit');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
