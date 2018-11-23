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
                <th scope="col"><?= $this->Paginator->sort('record_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staff_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longtitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accuracy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_data') ?></th>
                <th scope="col"><?= $this->Paginator->sort('http_user_agent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('http_cf_ray') ?></th>
                <th scope="col"><?= $this->Paginator->sort('http_cf_connecting_ip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('http_cookie') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
            <tr>
                <td><?= $this->Number->format($record->record_id) ?></td>
                <td><?= $this->Number->format($record->staff_id) ?></td>
                <td><?= $this->Number->format($record->longtitude) ?></td>
                <td><?= $this->Number->format($record->latitude) ?></td>
                <td><?= $this->Number->format($record->accuracy) ?></td>
                <td><?= h($record->time) ?></td>
                <td><?= h($record->additional_data) ?></td>
                <td><?= h($record->http_user_agent) ?></td>
                <td><?= h($record->http_cf_ray) ?></td>
                <td><?= h($record->http_cf_connecting_ip) ?></td>
                <td><?= h($record->http_cookie) ?></td>
                <td><?= h($record->create_time) ?></td>
                <td><?= h($record->update_time) ?></td>
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
