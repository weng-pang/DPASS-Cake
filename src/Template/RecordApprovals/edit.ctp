<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecordApproval $recordApproval
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $recordApproval->serial],
                ['confirm' => __('Are you sure you want to delete # {0}?', $recordApproval->serial)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Record Approvals'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="recordApprovals form large-9 medium-8 columns content">
    <?= $this->Form->create($recordApproval) ?>
    <fieldset>
        <legend><?= __('Edit Record Approval') ?></legend>
        <?php
            echo $this->Form->control('record_serial');
            echo $this->Form->control('id');
            echo $this->Form->control('power');
            echo $this->Form->control('datetime');
            echo $this->Form->control('revoked');
            echo $this->Form->control('update');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
