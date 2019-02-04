<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Record'), ['action' => 'edit', $record->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Record'), ['action' => 'delete', $record->id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Records'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Record'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Staff'), ['controller' => 'Staff', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Staff'), ['controller' => 'Staff', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="records view large-9 medium-8 columns content">
    <h3><?= h($record->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Staff') ?></th>
            <td><?= $record->has('staff') ? $this->Html->link($record->staff->id, ['controller' => 'Staff', 'action' => 'view', $record->staff->id]) : '' ?></td>
        </tr>
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
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($record->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Machine Code') ?></th>
            <td><?= $this->Number->format($record->machine_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rest Serial') ?></th>
            <td><?= $this->Number->format($record->rest_serial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($record->longitude) ?></td>
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
    <div class="related">
        <h4><?= __('Related Scores') ?></h4>
        <?php if (!empty($record->scores)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Record Id') ?></th>
                <th scope="col"><?= __('Manager Id') ?></th>
                <th scope="col"><?= __('Score') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Create Time') ?></th>
                <th scope="col"><?= __('Update Time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($record->scores as $scores): ?>
            <tr>
                <td><?= h($scores->id) ?></td>
                <td><?= h($scores->record_id) ?></td>
                <td><?= h($scores->manager_id) ?></td>
                <td><?= h($scores->score) ?></td>
                <td><?= h($scores->notes) ?></td>
                <td><?= h($scores->create_time) ?></td>
                <td><?= h($scores->update_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Scores', 'action' => 'view', $scores->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Scores', 'action' => 'edit', $scores->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Scores', 'action' => 'delete', $scores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scores->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
