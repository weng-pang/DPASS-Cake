<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record[]|\Cake\Collection\CollectionInterface $records
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Record'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="records index large-9 medium-8 columns content">
    <h3><?= __('Records') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datetime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('machineid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('entryid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ipaddress') ?></th>
                <th scope="col"><?= $this->Paginator->sort('portnumber') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update') ?></th>
                <th scope="col"><?= $this->Paginator->sort('key') ?></th>
                <th scope="col"><?= $this->Paginator->sort('revoked') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
            <tr>
                <td><?= $this->Number->format($record->serial) ?></td>
                <td><?= $this->Number->format($record->id) ?></td>
                <td><?= h($record->datetime) ?></td>
                <td><?= $this->Number->format($record->machineid) ?></td>
                <td><?= $this->Number->format($record->entryid) ?></td>
                <td><?= h($record->ipaddress) ?></td>
                <td><?= $this->Number->format($record->portnumber) ?></td>
                <td><?= h($record->update) ?></td>
                <td><?= h($record->key) ?></td>
                <td><?= h($record->revoked) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $record->serial]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $record->serial]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $record->serial], ['confirm' => __('Are you sure you want to delete # {0}?', $record->serial)]) ?>
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
