<?php
/**
 * Data Tables and Date Range Picker display cell
 * This cells handles Datatables & DateRangePicker as common element
 * To use this component, the table must be id "record-dataTable"
 *
 * @author Weng Long Pang
 * @copyright 2019
 *
 */
// Placeholder for start and end date?>
<div  style="display: none;">
    <input id="start-date" value="" />
    <input id="end-date" value=""  />
</div>
<!-- Page level plugins -->
<?= $this->Html->script('jquery.dataTables.min') ?>
<?= $this->Html->script('dataTables.bootstrap4.min') ?>
<?= $this->Html->script('daterangepicker.moment.min') ?>
<?= $this->Html->script('daterangepicker') ?>
<script>
    var start = moment().subtract(29, 'days');
    var end = moment();
    $(document).ready(function() {
        var theTable = $('#record-dataTable').DataTable({
            "language": {
                "search": "",
                "searchPlaceholder" : "<?= __('Search records') ?>"
            },
            "columnDefs": [
                {
                    "targets": [ <?= $dateControlColumn ?> ],
                    "visible": false,
                },
            ],
            "dom":
                "<'row dataTables_title'<'col-sm-12 col-md-3'l><'toolbar col-sm-12 col-md-3'><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });

        <?php if ($useDatePicker): ?>
        $("div.toolbar").html('<div id="reportrange" class="custom-select form-control p-1"><i class="fa fa-calendar"></i>&nbsp;<span></span>&nbsp;<i class="fa fa-caret-down"></i></div>');

        function cb(start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            $('#start-date').val(start.format('YYYY-MM-DD')); //TODO Change to dynamic setting?
            $('#end-date').val(end.format('YYYY-MM-DD'));
            theTable.draw();
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                '<?= __('Today') ?>': [moment(), moment()],
                '<?= __('Yesterday') ?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '<?= __('Last 7 Days') ?>': [moment().subtract(6, 'days'), moment()],
                '<?= __('Last 30 Days') ?>': [moment().subtract(29, 'days'), moment()],
                '<?= __('This Month') ?>': [moment().startOf('month'), moment().endOf('month')],
                '<?= __('Last Month') ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
        <?php endif; ?>
    });
</script>
