<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecordStatus $recordStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $recordStatus->serial],
                ['confirm' => __('Are you sure you want to delete # {0}?', $recordStatus->serial)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Record Status'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="recordStatus form large-9 medium-8 columns content">
    <?= $this->Form->create($recordStatus) ?>
    <fieldset>
        <legend><?= __('Edit Record Status') ?></legend>
        <?php
            echo $this->Form->control('new_serial');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
