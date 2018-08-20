<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff[]|\Cake\Collection\CollectionInterface $staffs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Staff'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="staffs index large-9 medium-8 columns content">
    <h3><?= __('Staffs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('checkin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('checkout') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lunch') ?></th>
                <th scope="col"><?= $this->Paginator->sort('overtime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('repeatedrange') ?></th>
                <th scope="col"><?= $this->Paginator->sort('overtimeapproval') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffs as $staff): ?>
            <tr>
                <td><?= $this->Number->format($staff->id) ?></td>
                <td><?= h($staff->name) ?></td>
                <td><?= h($staff->name2) ?></td>
                <td><?= h($staff->checkin) ?></td>
                <td><?= h($staff->checkout) ?></td>
                <td><?= $this->Number->format($staff->lunch) ?></td>
                <td><?= $this->Number->format($staff->overtime) ?></td>
                <td><?= $this->Number->format($staff->repeatedrange) ?></td>
                <td><?= $this->Number->format($staff->overtimeapproval) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $staff->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $staff->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $staff->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]) ?>
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
