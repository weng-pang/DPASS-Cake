<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting[]|\Cake\Collection\CollectionInterface $settings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Setting'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Managers'), ['controller' => 'Managers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Manager'), ['controller' => 'Managers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="settings index large-9 medium-8 columns content">
    <h3><?= __('Settings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('keyword') ?></th>
                <th scope="col"><?= $this->Paginator->sort('content') ?></th>
                <th scope="col"><?= $this->Paginator->sort('language_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manager_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dpass_rest_enabled') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dpass_rest_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dpass_rest_add_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dpass_rest_key') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staffadd_wait_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('staffadd_view_limit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($settings as $setting): ?>
            <tr>
                <td><?= $this->Number->format($setting->id) ?></td>
                <td><?= h($setting->keyword) ?></td>
                <td><?= h($setting->content) ?></td>
                <td><?= $setting->has('language') ? $this->Html->link($setting->language->id, ['controller' => 'Languages', 'action' => 'view', $setting->language->id]) : '' ?></td>
                <td><?= $setting->has('manager') ? $this->Html->link($setting->manager->id, ['controller' => 'Managers', 'action' => 'view', $setting->manager->id]) : '' ?></td>
                <td><?= $this->Number->format($setting->dpass_rest_enabled) ?></td>
                <td><?= $this->Number->format($setting->dpass_rest_code) ?></td>
                <td><?= h($setting->dpass_rest_add_address) ?></td>
                <td><?= h($setting->dpass_rest_key) ?></td>
                <td><?= $this->Number->format($setting->staffadd_wait_time) ?></td>
                <td><?= $this->Number->format($setting->staffadd_view_limit) ?></td>
                <td><?= h($setting->create_time) ?></td>
                <td><?= h($setting->update_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $setting->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $setting->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]) ?>
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
