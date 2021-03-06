﻿    


<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-content">
            <ul class="nav nav-tabs nav-primary">
                <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Designer</a></li>
                <li class=""><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Result</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab2_1">
                    <section class="app">
                        <aside class="aside-sm emails-list">
                            <section>
                                <h1><strong>Edit </strong>Process</h1>
                                <ul class="nav nav-tabs text-right">
                                    <li class="emails-action">
                                        <i class="icon-rounded-arrow-curve-left"></i>
                                        <div class="pos-rel dis-inline">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                                                <i class=" icon-rounded-arrow-down-thin"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="reorder-menu">Select All</a></li>
                                                <li><a href="#" class="remove-menu">Not Read</a></li>
                                                <li><a href="#" class="hide-top-sidebar">Read</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active">
                                        <div class=" form-group">
                                            <label>Table:</label>
                                            <input id="dbTable" class="form-control" data-search="true">
                                            </input>
                                        </div>
                                        <div class="form-group">
                                            <label>Group by:</label>
                                            <input id="groupBy" multiple class="form-control tableColumnMultiple" data-placeholder="Choose one or various columns...">
                                            </input>
                                        </div>
                                        <div class="form-group">
                                            <label>Order by:</label>
                                            <input id="orderBy" multiple class="form-control tableColumnMultiple" data-placeholder="Choose one or various columns...">
                                            </input>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </aside>
                        <div class="email-details">
                            <section>
                                <div class="email-subject">
                                    <h2>Parameters</h2>
                                    <div class="clearfix">
                                        <div class="pos-rel pull-left">
                                            <button type="button" id="addParameter" class="btn btn-sm btn-primary btn-rounded">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="email-details-inner" data-padding="200">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="30%">Name</th>
                                                <th width="30%">Column</th>
                                                <th width="25%">Aggregation</th>
                                                <th width="15%"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="parameterTable"></tbody>
                                    </table>

                                    <div class="form-group pull-right">
                                        <button type="button" id="save" class="btn btn-primary btn-square btn-embossed">Save</button>
                                        <button type="button" class="btn btn-danger btn-square btn-embossed">Use In Analytics Studio</button>
                                    </div>

                                </div>
                            </section>

                        </div>
                    </section>
                </div>
                <div class="tab-pane fade " id="tab2_2">

                    <section class="app">
                        <div class="email-details">
                            <section>
                                <div class="email-subject">
                                    <h2>Process Results</h2>
                                    <div class="clearfix">
                                        <div class="pos-rel pull-left">
                                            <button id="getResult" class="btn btn-sm btn-primary btn-rounded">Get Results</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="email-details-inner" data-padding="200">
                                    
                                    <div id="result"></div>
                                </div>
                            </section>

                        </div>
                    </section>

                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="notification">
    <div id="title-preview" class="preview dis-none">
        <div class="alert alert-success media fade in">
            <h4 class="alert-title">Your info has been updated</h4>
            <p>You have successfully updated your personal informations.</p>
        </div>
    </div>
</div>


<script>



    var aggregationData = [
{ id: 'sum', text: 'Sum' },
{ id: 'count', text: 'Count' },
{ id: 'avg', text: 'Average' },
{ id: 'max', text: 'Max' },
{ id: 'min', text: 'Min' }
    ];

    $.getJSON("/get/DBTables", function (data) {
        $("#dbTable").select2({
            data: data
        });
    });


    var columnData = "[]";

    var table = '';

    $("#dbTable").on('change', function (event) {
        table = $("#dbTable").select2('val');

        $.getJSON("/get/DBColumns/" + table, function (data) {
            columnData = data;

            $(".tableColumn").select2({
                data: columnData
            });

            $(".tableColumnMultiple").select2('data', null)
            $(".tableColumnMultiple").select2({
                multiple: true,
                data: columnData
            });

        });
    });


    $('#addParameter').on('click', function(){
        addParameter ("",columnData[0].id,aggregationData[0].id)
    
    });




    $('#getResult').on('click', function(){
        $("#result").load( "/process/resultTable/<?php echo $process->id; ?>", function(){
            generateNoty("The Process was Succesfully Executed","success");
        });
    
    });
        
        
        
        function addParameter (name,column,aggregation) {
            $('#parameterTable').append('<tr><td><input class="form-control columnName" value="'+name+'"></input></td><td><input class="form-control tableColumn" data-search="true"></input></td><td><input class="form-control columnAggregation" data-search="true"></input></td><td><button type="button" class="btn pull-right btn-sm btn-danger btn-rounded delete">Remove</button></td></tr>');

        $('#parameterTable tr:last').find(".tableColumn").select2({
            data: columnData
        }).val(column).trigger("change");

        $('#parameterTable tr:last').find(".columnAggregation").select2({
            data: aggregationData
        }).val(aggregation).trigger("change");

        

        $(".delete").on('click', function (event) {
            $(this).parent().parent().remove();
        });

    };

    $('#save').click(function () {
        var data = { columns: [] };
        data['table'] = $("#dbTable").select2('val');
        data['group'] = $("#groupBy").select2('val');
        data['order'] = $("#orderBy").select2('val');

        $('#parameterTable tr').each(function () {
            data.columns.push({name: $(this).find(".columnName").val(), column: $(this).find(".tableColumn").select2('val'), aggregation: $(this).find(".columnAggregation").select2('val')});
        });

        var request = $.ajax({
            url: "/process/save/<?php echo $process->id; ?>",
            type: "Post",
            data: { name: "<?php echo $process->name; ?>", parameters: JSON.stringify(data) , storage: "<?php echo $process->storage; ?>"},
            dataType: "json",
            success: function (result) {

                generateNoty("The Process Was Saved Succesfully","success");

            },
            error:function (result) {
                alert(JSON.stringify(result));
                generateNoty("Oh No Something Went Wrong","danger");

            }
        });

    });


    jQuery(document).ready(function(){


        var parameters= <?php echo $process->parameters; ?>;

        var columns = parameters.columns;

        $("#dbTable").val(parameters.table).trigger("change");

        $.getJSON("/get/DBColumns/" + parameters.table, function (data) {
            columnData = data;

            $(".tableColumn").select2({
                data: columnData
            });

            $(".tableColumnMultiple").select2({
                multiple: true,
                data: columnData
            });


            $("#groupBy").val(parameters.group).trigger("change");
            $("#orderBy").val(parameters.order).trigger("change");

            $.each(columns, function(i, item) {
          
                addParameter (columns[i].name,columns[i].column,columns[i].aggregation)

            })

        });


    });

</script>