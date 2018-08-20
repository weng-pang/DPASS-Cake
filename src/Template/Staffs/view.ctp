<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff $staff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Staff'), ['action' => 'edit', $staff->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Staff'), ['action' => 'delete', $staff->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staff->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Staffs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Staff'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="staffs view large-9 medium-8 columns content">
    <h3><?= h($staff->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($staff->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name2') ?></th>
            <td><?= h($staff->name2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($staff->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lunch') ?></th>
            <td><?= $this->Number->format($staff->lunch) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Overtime') ?></th>
            <td><?= $this->Number->format($staff->overtime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Repeatedrange') ?></th>
            <td><?= $this->Number->format($staff->repeatedrange) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Overtimeapproval') ?></th>
            <td><?= $this->Number->format($staff->overtimeapproval) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Checkin') ?></th>
            <td><?= h($staff->checkin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Checkout') ?></th>
            <td><?= h($staff->checkout) ?></td>
        </tr>
    </table>
</div>
