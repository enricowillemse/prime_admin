<?php echo $this->getContent(); ?>



<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs nav-primary">
            <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Basic Information</a></li>
            <li class=""><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i> Dashboards</a></li>
            <li class=""><a href="#tab2_3" data-toggle="tab"><i class="icon-user"></i> Processes</a></li>
            <li class=""><a href="#tab2_4" data-toggle="tab"><i class="icon-user"></i> Scheduled Processes</a></li>
            <li class=""><a href="#tab2_5" data-toggle="tab"><i class="icon-user"></i> Database Tables</a></li>
            <li class=""><a href="#tab2_6" data-toggle="tab"><i class="icon-user"></i> Global Variables</a></li>
            <li class=""><a href="#tab2_7" data-toggle="tab"><i class="icon-user"></i> Users </a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab2_1">
                <?php echo $this->tag->form(array("security_group/save")) ?>
                <div class="row">
                    <div class="grid-body no-border">
                        <br>

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <span class="help">e.g. "General Management"</span>
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <span class="help">e.g. "Security Group For General Management"</span>
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <?php echo $this->tag->textField(array("description", "class" => "form-control")) ?>
                            </div>
                        </div>

                      

                        <?php echo $this->tag->hiddenField("organisation_id") ?>

                        <?php echo $this->tag->hiddenField("id") ?>
                    </div>

                </div>
                <p class="pull-right">
                    <?php echo $this->tag->submitButton(array("Save", "class" => "btn btn-success btn-cons")) ?>
                    <button type="button" onclick="delete_modal('security_group','<?php echo $security_group; ?>')" class="btn btn-danger btn-cons">Delete</button>
                </p>
                </form>

            </div>
            <?php
            $count=1;
                      ?>
            <?php foreach ($types as $type) { ?>

            <?php
            $count++;
            ?>

            <div class="tab-pane fade " id="tab2_<?php echo $count; ?>">
                
                <?php $permissions= array("read","write","disable"); ?>

                <?php foreach ($permissions as $permission) { ?>
                <?php if ($this->length($type[$permission]) != 0) { ?>

                <h3><?php echo $type['name']; ?> with <strong><?php echo $permission; ?> access</strong></h3>

                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th><?php echo $type['id']; ?></th>
                            <th><?php echo $type['title']; ?></th>
                            <th style="width:30%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>


                       <?php foreach ($type[$permission] as $item) { ?>
                        <tr>
                            <td>
                                <?php echo $item->$type['id'] ?>
                            </td>
                            <td>
                                <?php echo $item->$type['title'] ?>
                         
                            </td>
                            <td>
                                <?php if($permission != "write") { 
                                          echo $this->tag->linkTo(array("security_group/set/".$security_group."/".$type['name']."/write/" . $item->$type['id'], "Read/Write",'class'=>"btn btn-danger btn-xs btn-small"));
                                              }
                                ?>
                                <?php if($permission != "read") { 
                                          echo $this->tag->linkTo(array("security_group/set/".$security_group."/".$type['name']."/read/" . $item->$type['id'], "Read",'class'=>"btn btn-warning btn-xs btn-small"));
                                          } 
                                      ?>

                                <?php if($permission != "disable") { 
                                          echo $this->tag->linkTo(array("security_group/set/".$security_group."/".$type['name']."/disable/" . $item->$type['id'], "Disable",'class'=>"btn btn-default btn-xs btn-small"));
                                              } 
                                      ?>
                            </td>
                        </tr>
                        

                        <?php } ?>

                    </tbody>

                </table>
                <?php } ?>
                <?php } ?>
            </div>
            
            <?php } ?>

        </div>

    </div>
</div>
