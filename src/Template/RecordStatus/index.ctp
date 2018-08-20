<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RecordStatus[]|\Cake\Collection\CollectionInterface $recordStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Record Status'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="recordStatus index large-9 medium-8 columns content">
    <h3><?= __('Record Status') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('new_serial') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recordStatus as $recordStatus): ?>
            <tr>
                <td><?= $this->Number->format($recordStatus->serial) ?></td>
                <td><?= $this->Number->format($recordStatus->status) ?></td>
                <td><?= $this->Number->format($recordStatus->new_serial) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $recordStatus->serial]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $recordStatus->serial]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $recordStatus->serial], ['confirm' => __('Are you sure you want to delete # {0}?', $recordStatus->serial)]) ?>
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
