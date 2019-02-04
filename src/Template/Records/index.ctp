<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record[]|\Cake\Collection\CollectionInterface $records
 */
$this->start('sidebar');
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul id="side-menu" class="nav in">
            <li><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('New Record'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Staff'), ['controller' => 'Staff', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Staff'), ['controller' => 'Staff', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?></li>
        </ul>
    </div>
</div>
<?php $this->end();?>
<div id="page-wrapper">
    <div class="row">
        <h1 class="page-header"><?= __('All Records') ?></h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table>
                        <thead>
                        <tr>
                            <th scope="col"><?= __('Record#') ?></th>
                            <th scope="col"><?= __('Staff') ?></th>
                            <th scope="col"><?= __('Time') ?></th>
                            <th scope="col"><?= __('Score') ?></th>
                            <th scope="col"><?= __('Upload Machine') ?></th>
                            <th scope="col"><?= __('REST Upload') ?></th>
                            <th scope="col"><?= __('Update') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($records as $record):
                            // Prepare the score value
                            $score_display = __('No Score');
                            if ($record->hasValue('scores')){
                                $score_display = 0; // reset to zero
                                foreach ($record->scores as $score){
                                    $score_display += (int)$score->score;
                                }
                            }
                            ?>
                            <tr>
                                <td><?= $this->Number->format($record->id) ?></td>
                                <td><?= $record->has('staff') ? $this->Html->link($record->staff->id, ['controller' => 'Staff', 'action' => 'view', $record->staff->id]) : '' ?></td>
                                <td><?= h($record->time) ?></td>
                                <td><?= $score_display?></td>
                                <td><?= $this->Number->format($record->machine_code) ?></td>
                                <td><?= is_null($record->rest_serial) ? __('No') : __('Yes') ?></td>
                                <td><?= h($record->update_time) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $record->id]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
