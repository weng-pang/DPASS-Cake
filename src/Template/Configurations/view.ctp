<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuration'), ['action' => 'edit', $configuration->parameter]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuration'), ['action' => 'delete', $configuration->parameter], ['confirm' => __('Are you sure you want to delete # {0}?', $configuration->parameter)]) ?> </li>
        <li><?= $this->Html->link(__('List Configurations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configurations view large-9 medium-8 columns content">
    <h3><?= h($configuration->parameter) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Parameter') ?></th>
            <td><?= h($configuration->parameter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Setting') ?></th>
            <td><?= $this->Number->format($configuration->setting) ?></td>
        </tr>
    </table>
</div>
