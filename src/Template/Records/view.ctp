<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Record'), ['action' => 'edit', $record->serial]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Record'), ['action' => 'delete', $record->serial], ['confirm' => __('Are you sure you want to delete # {0}?', $record->serial)]) ?> </li>
        <li><?= $this->Html->link(__('List Records'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Record'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="records view large-9 medium-8 columns content">
    <h3><?= h($record->serial) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Additional Data') ?></th>
            <td><?= h($record->additional_data) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Http User Agent') ?></th>
            <td><?= h($record->http_user_agent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Http Cf Ray') ?></th>
            <td><?= h($record->http_cf_ray) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Http Cf Connecting Ip') ?></th>
            <td><?= h($record->http_cf_connecting_ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Http Cookie') ?></th>
            <td><?= h($record->http_cookie) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Id') ?></th>
            <td><?= $this->Number->format($record->record_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Id') ?></th>
            <td><?= $this->Number->format($record->staff_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longtitude') ?></th>
            <td><?= $this->Number->format($record->longtitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($record->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accuracy') ?></th>
            <td><?= $this->Number->format($record->accuracy) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Time') ?></th>
            <td><?= h($record->time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Time') ?></th>
            <td><?= h($record->create_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Time') ?></th>
            <td><?= h($record->update_time) ?></td>
        </tr>
    </table>
</div>
