<?php echo $this->getContent(); ?>
<ul class="breadcrumb">
    <li>
        <p>YOU ARE HERE</p>
    </li>
    <li>
        <a href="/organisation/index" class="active">Edit Organisation</a>
    </li>
</ul>

<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header panel-controls">
            <h3>Organisation  <strong>Settings</strong></h3>
        </div>
        <div class="panel-content">
            <ul class="nav nav-tabs nav-primary">
                <li class=""><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Basic Information</a></li>
                <li class="active"><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Database Settings</a></li>
                <li class=""><a href="#tab2_3" data-toggle="tab"><i class="icon-lock"></i> Logins</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="tab2_1">
                    <?php echo $this->tag->form(array("organisation/save")) ?>
                    <div class="row column-seperation">

                        <div class="col-md-4" style="min-height:500px;">
                            <h3>
                                <span class="semi-bold">Basic</span> Information
                            </h3>
                        </div>
                        <div class="col-md-8">
                            <div class="grid-body no-border">
                                <br>

                                <div class="form-group">
                                    <label class="form-label">Organisation name</label>
                                    <span class="help">e.g. "Prime Analytics"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Organisation Theme</label>
                                    <div class="">
                                        <select class="form-control" name="theme">
                                            <?php
                        foreach($themeList as $subfile)
                        {
                        $type= strtolower(str_replace(" ","_",$subfile)) ;
                        echo '<option value="'.$type.'" >'.$subfile.'</option>';
                        }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <?php echo $this->tag->hiddenField("id") ?>
                            </div>
                        </div>
                    </div>

                    <div class="pull-right">
                        <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                        <button type="button" class="btn btn-white btn-cons">Cancel</button>
                    </div>
                    </form>
                </div>
                <div class="tab-pane fade active in" id="tab2_2">
                    <?php echo $this->tag->form("database/save") ?>
                    <div class="row column-seperation">

                        <div class="col-md-4" style="min-height:500px;">
                            <h3>
                                <span class="semi-bold">Database</span> Settings
                            </h3>
                        </div>
                        <div class="col-md-8">
                            <div class="grid-body no-border">
                                <br>

                                <div class="form-group">
                                    <label class="form-label">Database Host</label>
                                    <span class="help">e.g. "localhost"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_host", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Database Username</label>
                                    <span class="help">e.g. "root"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_username", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Database Password</label>
                                    <span class="help">e.g. "root"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_password", "class" => "form-control")) ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Database Name</label>
                                    <span class="help">e.g. "prime_analytics_db"</span>
                                    <div class="input-with-icon  right">
                                        <i class=""></i>
                                        <?php echo $this->tag->textField(array("db_name", "class" => "form-control")) ?>
                                    </div>
                                </div>

                               
                                

                                    <?php echo $this->tag->hiddenField("organisation_id") ?>
                                    <?php echo $this->tag->hiddenField("db_id") ?>
</div>
                        </div>
                    </div>

                    <div class="pull-right">
                        <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                        <button type="button" class="btn btn-white btn-cons">Cancel</button>
                    </div>
                    </form>
                </div>


                <div class="tab-pane fade" id="tab2_3">
                    <div class="row column-seperation">
                        <div class="col-md-4">
                            <h3>Create/Edit Logins</h3>
                            <p>Some themes have multiple login skins and you can select your desired look and feel over here.</p>
                            <div class="grid-body no-border">
                                <button type="button" class="btn btn-success btn-rounded pull-right" onclick="create_new_login('Default')">Create New</button>

                            </div>
                        </div>

                        <div class="col-md-8" style="min-height:798px;">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th style="width:20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logins as $login) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $login->url; ?>
                                        </td>
                                        <td>
                                            <?php echo $login->type; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-xs btn-small" onclick="edit_login_modal('<?php echo $login->type; ?>','<?php echo $login->id; ?>')">Edit</button>
                                            <button class="btn btn-danger btn-xs btn-small" onclick="delete_modal('login','<?php echo $login->id; ?>')">Delete</button>
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





<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-header panel-controls">
            <h3>Data <strong>Connectors</strong></h3>
        </div>
        <div class="panel-content">
            <ul class="nav nav-tabs nav-primary">
                <li class="width-16p active">
                    <a href="#connectors" data-toggle="tab">
                        <span class="text-center">Connectors</span>
                    </a>
                </li>
   <?php
                $directory = '../app/data_connectors/';
                //get all files in specified directory
                $files = glob($directory . "*", GLOB_BRACE);
                //print each file name
                foreach($files as $file)
                {
                //check to see if the file is a folder/directory
                if(is_dir($file))
                {
                echo '
                <li class="width-16p"><a href="#'.basename($file).'" data-toggle="tab"><span class="text-center">'.ucwords (basename($file)).'</span></a></li>';
                }
                }
                ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="connectors">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th style="width:30%">Authentication</th>
                                <th style="width:20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_connectors as $data_connector) { ?>
                            <tr>
                                <td>
                                    <?php echo $data_connector->id ?>
                                </td>
                                <td>
                                    <?php echo $data_connector->name ?>
                                </td>
                                <td>
                                    <?php echo $data_connector->type ?>
                                </td>
                                <td>

                                    <button class="btn btn-primary btn-xs btn-small" onClick="new_modal('<?php echo "/data_connectors/".$data_connector->type."/refreshToken/". $data_connector->id ?>')">Refresh Token</button>
                                    <button class="btn btn-white btn-xs btn-small" onClick="new_modal('<?php echo "/data_connectors/".$data_connector->type."/getToken/". $data_connector->id ?>')">Get Token</button>

                                </td>
                                <td>
                                    <button class="btn btn-success btn-xs btn-small" onClick="edit_connector('<?php echo '/data_connectors/'.$data_connector->type.'/new/'. $data_connector->organisation_id.'/'. $data_connector->id ?>')">Edit</button>

                                    <?php echo $this->tag->linkTo(array("/data_connectors/".$data_connector->type."/delete/" . $data_connector->id, "Delete",'class'=>"btn btn-danger btn-xs btn-small")) ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
   <?php
                //path to directory to scan
                $directory = '../app/data_connectors/';
                //get all files in specified directory
                $files = glob($directory . "*", GLOB_BRACE);
                //print each file name
                foreach($files as $file)
                {
                //check to see if the file is a folder/directory
                if(is_dir($file))
                {
                echo '<div class="tab-pane fade" id="'.basename($file).'">
                    ';
                    $subdirectory = '../app/data_connectors/'.basename($file).'/';
                    //get all files in specified directory
                    $subfiles = glob($subdirectory."*.{php}", GLOB_BRACE);
                    foreach($subfiles as $subfile)
                    {
                    $type = str_replace("Controller.php","",basename($subfile));
                    $name = trim(implode(' ', preg_split('/(?=\p{Lu})/u', $type)));
                    $type= "data_connectors/".basename($file)."/".strtolower(str_replace(" ","_",$name)) ;
                    echo '<div class="alert bg-primary">
                        <div data-type="'.$type.'" class="Data_Connector heading" onClick="create_new(\''.$type.'\')">'.$name.'</div>
                    </div>';
                    }
                    echo '
                </div>';
                }
                }
                ?>
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

    function create_new_login(dataType) {
        $("#modal_content").load('/logins/' + dataType + '/new', function () {
            $("#myModal").modal("show");
        });
    }

    function edit_login_modal(dataType,id) {
        $("#modal_content").load('/logins/' + dataType + '/edit/' + id, function () {
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


<script>

            function create_new(datatype)
            {
                $("#modal_content").load("/"+datatype+"/new/<?php echo $organisation_id ?>", function () {
                    $("#myModal").modal("show");
                });
            }

            function edit_connector(link)
            {
                $("#modal_content").load(link, function () {
                    $("#myModal").modal("show");
                });
            }

            function new_modal(link)
            {

                window.open(link);
                return false;

            }

</script>

<script>

    function editXml(id) {
        DesktopClient.AnalyticsGui(id);
    }
</script>


