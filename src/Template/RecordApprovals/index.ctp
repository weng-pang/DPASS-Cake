<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecordApproval[]|\Cake\Collection\CollectionInterface $recordApprovals
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Record Approval'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="recordApprovals index large-9 medium-8 columns content">
    <h3><?= __('Record Approvals') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('record_serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('power') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datetime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('revoked') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recordApprovals as $recordApproval): ?>
            <tr>
                <td><?= $this->Number->format($recordApproval->serial) ?></td>
                <td><?= $this->Number->format($recordApproval->record_serial) ?></td>
                <td><?= $this->Number->format($recordApproval->id) ?></td>
                <td><?= $this->Number->format($recordApproval->power) ?></td>
                <td><?= h($recordApproval->datetime) ?></td>
                <td><?= h($recordApproval->revoked) ?></td>
                <td><?= h($recordApproval->update) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $recordApproval->serial]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $recordApproval->serial]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $recordApproval->serial], ['confirm' => __('Are you sure you want to delete # {0}?', $recordApproval->serial)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
