<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecordApproval $recordApproval
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Record Approval'), ['action' => 'edit', $recordApproval->serial]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Record Approval'), ['action' => 'delete', $recordApproval->serial], ['confirm' => __('Are you sure you want to delete # {0}?', $recordApproval->serial)]) ?> </li>
        <li><?= $this->Html->link(__('List Record Approvals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Record Approval'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="recordApprovals view large-9 medium-8 columns content">
    <h3><?= h($recordApproval->serial) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Serial') ?></th>
            <td><?= $this->Number->format($recordApproval->serial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Serial') ?></th>
            <td><?= $this->Number->format($recordApproval->record_serial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($recordApproval->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Power') ?></th>
            <td><?= $this->Number->format($recordApproval->power) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datetime') ?></th>
            <td><?= h($recordApproval->datetime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update') ?></th>
            <td><?= h($recordApproval->update) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Revoked') ?></th>
            <td><?= $recordApproval->revoked ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
