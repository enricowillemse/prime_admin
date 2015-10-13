<?php echo $this->getContent(); ?>

<ul class="breadcrumb">
  <li>
    <p>YOU ARE HERE</p>
  </li>
  <li>
    <a href="#" class="active">Edit User</a>
  </li>
</ul>

<div class="row">

    <div class="col-md-12 portlets">
        <div class="panel">
            <div class="panel-header panel-controls">
                <h3>User  <strong>Settings</strong></h3>
            </div>
            <div class="panel-content">
                <ul class="nav nav-tabs nav-primary">
                    <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Basic Information</a></li>
                    <li class=""><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Dashboards</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab2_1">
                        <div class="row column-seperation">
                            <?php echo $this->tag->form(array("users/save")) ?>
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
                                            <label class="form-label">Email</label>
                                            <span class="help">e.g. "User@primeanalytics.io"</span>
                                            <div class="input-with-icon  right">
                                                <i class=""></i>
                                                <?php echo $this->tag->textField(array("email", "class" => "form-control")) ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Full Name</label>
                                            <span class="help">e.g. "John Doe"</span>
                                            <div class="input-with-icon  right">
                                                <i class=""></i>
                                                <?php echo $this->tag->textField(array("full_name", "class" => "form-control")) ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Profile Picture</label>
                                            <span class="help">e.g. "Please select"</span>
                                            <div class="input-with-icon  right">
                                                <i class=""></i>
                                                <?php echo $this->tag->textField(array("image_path", "class" => "form-control")) ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <div class="input-with-icon  right">
                                                <i class=""></i>
                                                <?php echo $this->tag->passwordField(array("password", "class" => "form-control")) ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Role</label>
                                            <div class="input-with-icon  right">
                                                <i class=""></i>
                                                <?php echo $this->tag->textField(array("role", "class" => "form-control")) ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="input-with-icon  right">
                                                <i class=""></i>
                                                <?php echo $this->tag->textField(array("status", "class" => "form-control")) ?>
                                            </div>
                                        </div>

                                        <?php echo $this->tag->hiddenField("organisation_id") ?>

                                        <?php echo $this->tag->hiddenField("id") ?>
                                    </div>
                                </div>
                            </div>
                            <p class="pull-right">
                                <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                                <button type="button" class="btn btn-white btn-cons">Cancel</button>
                            </p>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade " id="tab2_2">
                        <h3>User's <strong>Dashboards</strong></h3>
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Weight</th>
                                    <th style="width:20%">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user_dashboards as $dashboard) { ?>
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
                                        <?php echo $this->tag->linkTo(array("Users/disable_dashboard/" . $dashboard->id."/".$email, "Disable",'class'=>"btn btn-warning btn-xs btn-small")); ?>
                                    </td>
                                </tr>
                                <?php } ?>

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
                                        <?php echo $this->tag->linkTo(array("Users/enable_dashboard/" . $dashboard->id."/".$email, "Enable",'class'=>"btn btn-success btn-xs btn-small")); ?>
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

