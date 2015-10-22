<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header">
            <h3><i class="fa fa-table"></i> <strong>Dashboards</strong></h3>
            <div class="control-btn">
                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                    <i class="icon-settings"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="#">Action</a>
                    </li>
                    <li>
                        <a href="#">Another action</a>
                    </li>
                    <li>
                        <a href="#">Something else here</a>
                    </li>
                </ul>
                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i class="icons-office-58"></i></a>
                <a href="#" class="panel-maximize hidden"><i class="icon-size-fullscreen"></i></a>
                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
            </div>
        </div>
        <div class="panel-content">


            <ul class="nav nav-tabs nav-primary">
                <li class=""><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Create New</a></li>
                <li class="active"><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Edit Existing</a></li>
                <li class=""><a href="#tab2_3" data-toggle="tab"><i class="icon-user"></i> Create/Edit Dashboard Links</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="tab2_1">
                    <div class="row column-seperation">
                        <div class="col-md-4">
                            <h3>Create New Dashboard</h3>
                            <p>Please select one of the dashboard templates to the right.</p>
                            <div class="grid-body no-border">


                            </div>
                        </div>
                        <div class="col-md-8" style="min-height:798px;">


                            <div class="portfolioContainer grid ">
                                <?php foreach ($dashboardList as $dashboard) { ?>

                                <figure class="effect-lily pull-left" onClick="create_new_dashboard('<?php echo $dashboard; ?>')">
                                    <img src="/assets/global/images/gallery/1.jpg">
                                    <figcaption>
                                        <h2><?php echo $dashboard; ?></h2>
                                        <p>Click to start using this template</p>
                                        <a href="#">Create Dashboard</a>
                                    </figcaption>
                                </figure>
                                <?php } ?>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="tab-pane fade active in" id="tab2_2">
                    <div class="row column-seperation">
                        <div class="col-md-4">
                            <h3>Edit Dashboards</h3>
                            <p>Please select one of the dashboard to the right to start editing.</p>
                            <div class="grid-body no-border">


                            </div>
                        </div>

                        <div class="col-md-8" style="min-height:798px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Weight</th>
                                        <th style="width:20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dashboards as $dashboard) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $dashboard->title ?>
                                        </td>
                                        <td>
                                            <?php echo $dashboard->icon ?>
                                        </td>
                                        <td>
                                            <?php echo $dashboard->weight ?>
                                        </td>
                                        <td>
                                            <?php echo $this->tag->linkTo(array("dashboards/".$dashboard->type."/edit/" . $dashboard->id, "Edit",'class'=>"btn btn-success btn-xs btn-small")); ?>
                                            <button class="btn btn-danger btn-xs btn-small" onclick="delete_modal('dashboard',<?php echo $dashboard->id; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2_3">
                    <div class="row column-seperation">
                        <div class="col-md-4">
                            <h3>Create/Edit Dashboard Links</h3>
                            <p>Dashboard Links are used to create connections among widgets, and dashboards. You can edit the existing links to the right or add a new one below.</p>
                            <div class="grid-body no-border">
                                <button type="button" class="btn btn-success btn-rounded pull-right" onclick="create_new_link()">Create New</button>

                            </div>
                        </div>

                        <div class="col-md-8" style="min-height:798px;">
                            
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Table.Column</th>
                                        <th>Operator</th>
                                        <th>Default Value</th>
                                        <th style="width:20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($links as $link) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $link->name; ?>
                                        </td>
                                        <td>
                                            <?php echo $link->table; ?>.<?php echo $link->column; ?>
                                        </td>
                                        <td>
                                            <?php echo $link->operator; ?>
                                        </td>
                                        <td>
                                            <?php echo $link->default_value; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-xs btn-small" onclick="edit_link_modal(<?php echo $link->id; ?>)">Edit</button>
                                            <button class="btn btn-danger btn-xs btn-small" onclick="delete_modal('links',<?php echo $link->id; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>







        </div>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal">
        <div id="modal_content"></div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    function create_new_dashboard(dataType) {
        $("#modal_content").load('/dashboards/' + dataType + '/new', function () {
            $("#myModal").modal("show");
        });
    }
    
    function edit_link_modal(id) {
        $("#modal_content").load('/links/edit/' + id, function () {
            $("#myModal").modal("show");
        });
    }

    function create_new_link() {
        $("#modal_content").load('/links/new/', function () {
            $("#myModal").modal("show");
        });
    }

           function delete_modal(dataType,id)
            {
                $("#modal_content").load('/form/delete/'+dataType+'/'+id, function () {
                    $("#myModal").modal("show");
                });
            }


</script>


<?php echo $this->getContent() ?>

