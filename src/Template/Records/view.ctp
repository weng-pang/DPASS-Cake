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
            <th scope="row"><?= __('Ipaddress') ?></th>
            <td><?= h($record->ipaddress) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Key') ?></th>
            <td><?= h($record->key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Serial') ?></th>
            <td><?= $this->Number->format($record->serial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($record->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Machineid') ?></th>
            <td><?= $this->Number->format($record->machineid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Entryid') ?></th>
            <td><?= $this->Number->format($record->entryid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Portnumber') ?></th>
            <td><?= $this->Number->format($record->portnumber) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datetime') ?></th>
            <td><?= h($record->datetime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update') ?></th>
            <td><?= h($record->update) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Revoked') ?></th>
            <td><?= $record->revoked ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
