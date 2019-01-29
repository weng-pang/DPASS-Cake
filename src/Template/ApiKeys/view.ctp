<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApiKey $apiKey
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Api Key'), ['action' => 'edit', $apiKey->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Api Key'), ['action' => 'delete', $apiKey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apiKey->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Api Keys'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Api Key'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="apiKeys view large-9 medium-8 columns content">
    <h3><?= h($apiKey->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Key') ?></th>
            <td><?= h($apiKey->key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($apiKey->comment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($apiKey->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($apiKey->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expire') ?></th>
            <td><?= h($apiKey->expire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Revoked') ?></th>
            <td><?= $apiKey->revoked ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
