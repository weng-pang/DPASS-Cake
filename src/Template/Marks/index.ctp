<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mark[]|\Cake\Collection\CollectionInterface $marks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Mark'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="marks index large-9 medium-8 columns content">
    <h3><?= __('Marks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('keyword') ?></th>
                <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pass_mark') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staff_add_record') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staff_add_location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staff_add_photo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mark') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($marks as $mark): ?>
            <tr>
                <td><?= $this->Number->format($mark->id) ?></td>
                <td><?= h($mark->keyword) ?></td>
                <td><?= h($mark->enabled) ?></td>
                <td><?= $this->Number->format($mark->pass_mark) ?></td>
                <td><?= $this->Number->format($mark->staff_add_record) ?></td>
                <td><?= $this->Number->format($mark->staff_add_location) ?></td>
                <td><?= $this->Number->format($mark->staff_add_photo) ?></td>
                <td><?= $this->Number->format($mark->mark) ?></td>
                <td><?= h($mark->create_time) ?></td>
                <td><?= h($mark->update_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mark->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mark->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mark->id)]) ?>
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
