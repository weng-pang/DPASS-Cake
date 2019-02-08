<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mark $mark
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mark'), ['action' => 'edit', $mark->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mark'), ['action' => 'delete', $mark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mark->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Marks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mark'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="marks view large-9 medium-8 columns content">
    <h3><?= h($mark->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Keyword') ?></th>
            <td><?= h($mark->keyword) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mark->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pass Mark') ?></th>
            <td><?= $this->Number->format($mark->pass_mark) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Add Record') ?></th>
            <td><?= $this->Number->format($mark->staff_add_record) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Add Location') ?></th>
            <td><?= $this->Number->format($mark->staff_add_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Add Photo') ?></th>
            <td><?= $this->Number->format($mark->staff_add_photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mark') ?></th>
            <td><?= $this->Number->format($mark->mark) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Time') ?></th>
            <td><?= h($mark->create_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Time') ?></th>
            <td><?= h($mark->update_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enabled') ?></th>
            <td><?= $mark->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
