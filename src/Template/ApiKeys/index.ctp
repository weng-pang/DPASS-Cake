<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApiKey[]|\Cake\Collection\CollectionInterface $apiKeys
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Api Key'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="apiKeys index large-9 medium-8 columns content">
    <h3><?= __('Api Keys') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('key') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('revoked') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($apiKeys as $apiKey): ?>
            <tr>
                <td><?= h($apiKey->key) ?></td>
                <td><?= h($apiKey->created) ?></td>
                <td><?= h($apiKey->expire) ?></td>
                <td><?= h($apiKey->revoked) ?></td>
                <td><?= h($apiKey->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $apiKey->key]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $apiKey->key]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $apiKey->key], ['confirm' => __('Are you sure you want to delete # {0}?', $apiKey->key)]) ?>
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
