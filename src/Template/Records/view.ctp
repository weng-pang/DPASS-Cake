<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 */
$this->start('sidebar'); ?>
    <div class="sidebar-heading"><?= __('Actions') ?></div>
    <li class="nav-item"><?= $this->Html->link('<i class="fas fa-fw fa-table"></i><span>'.__('List All Records').'</span>', ['action' => 'index'],['class' => 'nav-link','escape'=>false]) ?> </li>
    <li class="nav-item"><?= $this->Form->postLink('<span>'.__('Delete Record').'</span>', ['action' => 'delete', $record->id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->id) ,'class' => 'nav-link','escape'=>false]) ?> </li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('New Record').'</span>', ['action' => 'add'],['class' => 'nav-link','escape'=>false]) ?> </li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('List Staff').'</span>', ['controller' => 'Staff', 'action' => 'index'],['class' => 'nav-link','escape'=>false]) ?> </li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('New Staff').'</span>', ['controller' => 'Staff', 'action' => 'add'],['class' => 'nav-link','escape'=>false]) ?> </li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('List Scores').'</span>', ['controller' => 'Scores', 'action' => 'index'],['class' => 'nav-link','escape'=>false]) ?> </li>
    <li class="nav-item"><?= $this->Html->link('<span>'.__('New Score').'</span>', ['controller' => 'Scores', 'action' => 'add'],['class' => 'nav-link','escape'=>false]) ?> </li>
<?php $this->end();?>
<?php $this->start('scores');
    $totalScore = 0; // Set the zero score first
    if (!empty($record->scores)): ?>
        <table class="table table-striped dataTable" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
            <tr>
                <th scope="col"><?= __('Manager Id') ?></th>
                <th scope="col"><?= __('Score') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Update Time') ?></th>
            </tr>
            <?php foreach ($record->scores as $scores): ?>
                <tr>
                    <td><?= h($scores->manager_id) ?></td>
                    <td><?= h($scores->score) ?></td>
                    <td><?= h($scores->notes) ?></td>
                    <td><?= h($scores->update_time) ?></td>
                </tr>
            <?php $totalScore += $scores->score;
            endforeach; ?>
        </table>
    <?php endif; ?>
<?php $this->end(); ?>
<div id="page-wrapper">
    <!-- reserved for flash message -->
    <div class="row">

    </div>
    <div class="row">
        <!-- Staff Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= __('Staff') ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $record->has('staff') ? $this->Html->link($record->staff->id.' '. $record->staff->surname. ' '. $record->staff->given_names, ['controller' => 'Staff', 'action' => 'view', $record->staff->id],[]) : '' ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Time Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?= __('Time') ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($record->time) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><?= __('Machine Code') ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->Number->format($record->machine_code) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Score Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <?php $scoreStatus =  ($totalScore >= $marks->pass_mark) ? 'success' : 'info' ?>
            <div class="card border-left-<?= $scoreStatus ?> shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-<?= $scoreStatus ?> text-uppercase mb-1"><?= __('Score') ?></div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totalScore ?></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-<?= $scoreStatus ?>" role="progressbar" style="width: <?= $totalScore*100/$marks->pass_mark ?>%" aria-valuenow="<?= $totalScore ?>" aria-valuemin="0" aria-valuemax="<?= $marks->pass_mark ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <!-- map -->
            <div class="card shadow-lg mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><?= __('Map ') ?></h6>
                </div>
                <div class="card-body" style="height:300px;">
                    <div id="map"></div>
                </div>
            </div>
            <!-- score table -->
            <div class="card shadow-lg mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><?= __('Approvals') ?></h6>
                </div>
                <div class="card-body">
                    <?= $this->fetch('scores') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- photos -->
            <div class="card shadow-lg mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><?= __('Photos ')  ?></h6>
                </div>
                <div class="card-body">
                    <?php foreach ($scoresWithPhotos as $score) : ?>
                        <?php debug($score); ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- additional information -->
            <div class="card shadow-lg mb-4">
                <a href="#additional-information" class="d-block card-header py-3" data-toggle="collapse" role="button" >
                    <h6 class="m-0 font-weight-bold text-primary"><?= __('Additional Information') ?></h6>
                </a>
                <div class="collapse show" id="additional-information">
                    <div class="card-body">
                        <div><?= h($record->additional_data) ?></div>
                        <table class="table table-condensed table-hover dataTable" style="width: 100%; table-layout: fixed;">
                            <tr>
                                <th scope="row" class="p-1"><?= __('Http User Agent') ?></th>
                                <td class="p-1"><?= h($record->http_user_agent) ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('CF Ray') ?></th>
                                <td class="p-1"><?= h($record->http_cf_ray) ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Connecting Ip') ?></th>
                                <td class="p-1"><?= h($record->http_cf_connecting_ip) ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Cookie') ?></th>
                                <td class="p-1"><?= h($record->http_cookie) ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Machine Code') ?></th>
                                <td class="p-1"><?= $this->Number->format($record->machine_code) ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Rest Serial') ?></th>
                                <td class="p-1"><?= $record->rest_serial ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Longitude') ?></th>
                                <td class="p-1"><?= $record->longitude ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Latitude') ?></th>
                                <td class="p-1"><?= $record->latitude ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Accuracy') ?></th>
                                <td class="p-1"><?= $this->Number->format($record->accuracy) ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Create Time') ?></th>
                                <td class="p-1"><?= h($record->create_time) ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="p-1"><?= __('Update Time') ?></th>
                                <td class="p-1"><?= h($record->update_time) ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->start('css'); ?>
<?= $this->Html->css('dataTables.bootstrap4.min') ?>
<?= $this->Html->css('daterangepicker') ?>
<?= $this->Html->css('DataTablesCell.min') ?>
<?= $this->Html->css('https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.css') ?>
<style>
    #map { position:absolute; top:3rem; bottom:0.5rem; width:90%; }
</style>
<?php $this->end();?>
<?php $this->start('script'); ?>
<?= $this->Html->script('https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.js') ?>
<script>
    L.mapbox.accessToken = '<?= $mapbox['accessToken'] ?>';
    var map = L.mapbox.map('map', 'mapbox.streets')
        .setView([<?= $record->latitude ?>, <?= $record->longitude ?>], 15);
    // Add marker here
    L.marker([<?= $record->latitude ?>, <?= $record->longitude ?>], {
        icon: L.mapbox.marker.icon({
            'marker-size': 'medium',
            'marker-color': '#fa0'
        })
    }).addTo(map);
</script>
<?php $this->end();?>
