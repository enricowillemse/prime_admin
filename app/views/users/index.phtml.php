
 <?php echo $this->getContent() ?>
<div class="col-md-12 portlets">
    <div class="panel">
        <div class="panel-content">

            <section class="page-app app mailbox" style="">
                <aside class=" aside-md emails-list">
                    <section>
                        <div class="mailbox-page clearfix">
                            <h1 class="pull-left">Users</h1>
                        </div>
                        <ul class="nav nav-tabs text-right">
                            <li class="emails-action">
                                <i class="icon-rounded-arrow-curve-left"></i>
                            </li>
                            <li class="f-right active"><a href="#active" data-toggle="tab">Active</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="active">
                                <div class="messages-list withScroll show-scroll" data-padding="180" data-height="window">
                                    <?php foreach ($users as $user) { ?>
                                    <div class="message-item media">
                                        <div class="media">
                                            <img src="/assets/global/images/avatars/avatar11_big.png" alt="avatar 3" width="40" class="sender-img">
                                            <div class="media-body">
                                                <div class="sender"><?php echo $user->full_name; ?></div>
                                                <div class="subject"><span class="subject-text"><?php echo $user->email; ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </aside>
                <button type="button" class="btn btn-primary btn-rounded pull-right" onclick="create_new('users')">Create New</button>
                <div class="email-details">
                    <div class="email-content">
                    </div>

                </div>
            </section>

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

    $('.emails-list').on('click', '.message-item', function () {
        var emailSender = $(this).find('.sender').text();
        var emailSubject = $(this).find('.subject-text').text();

        $('.email-content').load('/users/edit/' + emailSubject);
    });

    $('.emails-list .message-item:first-of-type').trigger('click');



</script>

<script>

    function create_new(dataType) {
        $("#modal_content").load('/' + dataType + '/new', function () {
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


