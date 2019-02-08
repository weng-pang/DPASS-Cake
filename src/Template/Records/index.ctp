<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record[]|\Cake\Collection\CollectionInterface $records
 */
$this->start('sidebar'); ?>
    <div class="sidebar-heading"><?= __('Actions') ?></div>
    <li class="nav-item"><?= $this->Html->link('<i class="fas fa-fw fa-folder"></i><span>'.__('New Record').'</span>', ['action' => 'add'],['class' => 'nav-link','escape'=>false]) ?></li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('List Staff').'</span>', ['controller' => 'Staff', 'action' => 'index'],['class' => 'nav-link','escape'=>false]) ?></li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('New Staff').'</span>', ['controller' => 'Staff', 'action' => 'add'],['class' => 'nav-link','escape'=>false]) ?></li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('List Scores').'</span>', ['controller' => 'Scores', 'action' => 'index'],['class' => 'nav-link','escape'=>false]) ?></li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('New Score').'</span>', ['controller' => 'Scores', 'action' => 'add'],['class' => 'nav-link','escape'=>false]) ?></li>
<?php $this->end();?>
<div id="page-wrapper">
    <h1 class="h3 mb-2 text-gray-800"><?= __('All Records') ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="record-dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col"><?= __('Record#') ?></th>
                        <th scope="col"><?= __('Staff') ?></th>
                        <th scope="col"><?= __('Date') ?></th>
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
                            <td><?= (is_null($record->time)) ? '' : $record->time->format('Y-m-d H:i:s') ?></td>
                            <td><?= h($record->time) ?></td>
                            <td><?= $score_display?></td>
                            <td><?= $this->Number->format($record->machine_code) ?></td>
                            <td><?= is_null($record->rest_serial) ? __('No') : __('Yes') ?></td>
                            <td><?= h($record->update_time) ?></td>
                            <td class="actions">
                                <?= $this->Html->link('<span class="icon text-gray-600"><i class="fas fa-arrow-right"></i></span><span class="text">'.__('View').'</span>', ['action' => 'view', $record->id],['class' => 'btn btn-light btn-icon-split','escape'=>false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->start('css'); ?>
<?= $this->Html->css('dataTables.bootstrap4.min') ?>
<?= $this->Html->css('daterangepicker') ?>
<?php
$this->end();
$this->start('script'); ?>
<?= $this->cell('DataTables',[],['useDatePicker'=>true,'dateControlColumn'=> 2]) ?>
<?php $this->end(); ?>
