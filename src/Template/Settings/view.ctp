<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting $setting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Setting'), ['action' => 'edit', $setting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Setting'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Settings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Setting'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Languages'), ['controller' => 'Languages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Language'), ['controller' => 'Languages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Managers'), ['controller' => 'Managers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Manager'), ['controller' => 'Managers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="settings view large-9 medium-8 columns content">
    <h3><?= h($setting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Keyword') ?></th>
            <td><?= h($setting->keyword) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Content') ?></th>
            <td><?= h($setting->content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= $setting->has('language') ? $this->Html->link($setting->language->id, ['controller' => 'Languages', 'action' => 'view', $setting->language->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manager') ?></th>
            <td><?= $setting->has('manager') ? $this->Html->link($setting->manager->id, ['controller' => 'Managers', 'action' => 'view', $setting->manager->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dpass Rest Add Address') ?></th>
            <td><?= h($setting->dpass_rest_add_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dpass Rest Key') ?></th>
            <td><?= h($setting->dpass_rest_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($setting->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dpass Rest Enabled') ?></th>
            <td><?= $this->Number->format($setting->dpass_rest_enabled) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dpass Rest Code') ?></th>
            <td><?= $this->Number->format($setting->dpass_rest_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staffadd Wait Time') ?></th>
            <td><?= $this->Number->format($setting->staffadd_wait_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staffadd View Limit') ?></th>
            <td><?= $this->Number->format($setting->staffadd_view_limit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Time') ?></th>
            <td><?= h($setting->create_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Time') ?></th>
            <td><?= h($setting->update_time) ?></td>
        </tr>
    </table>
</div>
