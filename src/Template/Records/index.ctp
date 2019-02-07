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
<div  style="display: none;">
    <input id="start-date" value="" />
    <input id="end-date" value=""  />
</div>


<?php $this->start('script'); ?>
<!-- Page level plugins -->
<?= $this->Html->script('jquery.dataTables.min') ?>
<?= $this->Html->script('dataTables.bootstrap4.min') ?>
<script>
    var start = moment().subtract(29, 'days');
    var end = moment();
    $(document).ready(function() {
        var theTable = $('#record-dataTable').DataTable({
            "language": {
                "search": "",
                "searchPlaceholder" : "Search records"
            },
            "columnDefs": [
                {
                    "targets": [ 2 ],
                    "visible": false,
                },
            ],
            "dom":
                "<'row datatables_title'<'col-sm-12 col-md-3'l><'toolbar col-sm-12 col-md-3'><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });
        $("div.toolbar").html('<div id="reportrange" class="custom-select" style="background: #fff; cursor: pointer; padding: 5px; border: 1px solid #ccc; width: 100%"><i class="fa fa-calendar"></i>&nbsp;<span></span>&nbsp;<i class="fa fa-caret-down"></i></div>');

        function cb(start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            //TODO Update the table search range
            $('#start-date').val(start.format('YYYY-MM-DD'));
            $('#end-date').val(end.format('YYYY-MM-DD'));
            theTable.draw();
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = Date.parse($('#start-date').val());
                var max = Date.parse($('#end-date').val());
                var age = Date.parse(data[2]) || 0; // search the date column
                // Chaning the max value
                max = max + 86400*1000; // This is one day
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                    ( isNaN( min ) && age <= max ) ||
                    ( min <= age   && isNaN( max ) ) ||
                    ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }
        );
        cb(start, end);
    });
</script>
<?php $this->end(); ?>
