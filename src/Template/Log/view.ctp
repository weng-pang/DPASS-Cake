<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Log'), ['action' => 'edit', $log->serial]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Log'), ['action' => 'delete', $log->serial], ['confirm' => __('Are you sure you want to delete # {0}?', $log->serial)]) ?> </li>
        <li><?= $this->Html->link(__('List Log'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="log view large-9 medium-8 columns content">
    <h3><?= h($log->serial) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Key') ?></th>
            <td><?= h($log->key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip') ?></th>
            <td><?= h($log->ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($log->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($log->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Serial') ?></th>
            <td><?= $this->Number->format($log->serial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Time') ?></th>
            <td><?= h($log->time) ?></td>
        </tr>
    </table>
</div>
