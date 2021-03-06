﻿<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Table Data</a></li>
            <li class=""><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Alter Table</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab2_1">



                <?php if ($this->length($data) != 0) { ?>

                <div class="panel-content table-editable" style="overflow-x:auto; ">
                    
                    <table class="table table-hover table-condensed ">
                        <thead>
                            <tr>
                                <?php foreach (array_keys($data[0]) as $cell) { ?>
                                <th><?php echo $cell; ?> </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id="table" style="overflow-y:auto; height:700px">
                            <?php foreach ($data as $row) { ?>
                            <tr>
                                <?php foreach ($row as $cell) { ?>
                                <td contenteditable="true"><?php echo $cell; ?> </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>

                            <tr class="hide">
                                <?php foreach ($data[0] as $cell) { ?>
                                <td contenteditable="true"><?php echo $cell; ?> </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade " id="tab2_2">
                <button type="button" class="btn btn-danger btn-rounded pull-right" onclick="delete_item('table','<?php echo $table_name; ?>')">Delete Table</button>
                <button type="button" class="btn btn-success table-add btn-rounded pull-right" >Add Row</button>

            </div>
        </div>

    </div>
</div>






<?php echo $this->getContent(); ?>

<script>

    function delete_item(dataType, id) {
        $.get('/DatabaseExplorer/deleteTable/' + id, function () {

        });
    }

    $(document).ready(function () {

       

    var $TABLE = $('#table');
    var $BTN = $('#export-btn');
    var $EXPORT = $('#export');

    $('.table-add').click(function () {
        var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLE.append($clone);
    });

    $('.table-remove').click(function () {
        $(this).parents('tr').detach();
    });

    $('.table-up').click(function () {
        var $row = $(this).parents('tr');
        if ($row.index() === 1) return; // Don't go above the header
        $row.prev().before($row.get(0));
    });

    $('.table-down').click(function () {
        var $row = $(this).parents('tr');
        $row.next().after($row.get(0));
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTN.click(function () {
        var $rows = $TABLE.find('tr:not(:hidden)');
        var headers = [];
        var data = [];

        // Get the headers (add special header logic here)
        $($rows.shift()).find('th:not(:empty)').each(function () {
            headers.push($(this).text().toLowerCase());
        });

        // Turn all existing rows into a loopable array
        $rows.each(function () {
            var $td = $(this).find('td');
            var h = {};

            // Use the headers from earlier to name our hash keys
            headers.forEach(function (header, i) {
                h[header] = $td.eq(i).text();
            });

            data.push(h);
        });

        // Output the result
        $EXPORT.text(JSON.stringify(data));
    });
    });

</script>

<?php } ?>