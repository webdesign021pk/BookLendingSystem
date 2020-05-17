<!-- Body Content Start -->
<div class="container p-3 mb-5">
<!-- Body Content Start -->
    <h4 class="modal-title"><i class="fas fa-edit"></i> Modify User</h4>
    <div class="jsError"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                    <?php if (($userDetail->userLevel)>2) { if($user->userLevel>2){redirect('Library/Settings/users');}?>
                    <form class="mt-3 modifyInstitute" action="<?= base_url('Library/Settings/modifyUser/').$user->userIdPK?>" method="POST">
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="userName">User Name:</label>
                                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter User Name',
                                    'name'=>'userName','value'=>set_value('userName', $user->userName)])?>
                                <?php echo form_error('userName')?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <?php if (($userDetail->userLevel)>2) { if($user->userLevel>2){redirect('Library/Settings/users');}?>
                            <form class="mt-3 modifyInstitute" action="<?= base_url('Library/Settings/modifyUser/').$user->userIdPK?>" method="POST">
                            <?php } ?>
                                <label for="userLevel">User Level:</label>
                                <div class="input-group mb-3">
                                    <?php $attr3 = 'class="form-control" id="userLevel"'; ?>
                                    <?php
                                    $level=[
                                        ''=>'Select',
                                        '2'=>'Admin/Incharge',
                                        '1'=>'Librarian'
                                    ] ?>
                                    <?= form_dropdown('userLevel', $level, set_value('userLevel', $user->userLevel), $attr3); ?>
                                    <?php echo form_error('userLevel')?>
                                    <div class="input-group-append">
                                        <?php if (($userDetail->userLevel)>2) {?>
                                            <button type="submit" class="btn btn-primary">Update <i class="fas fa-user"></i></button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </form>
                    <?php if (($userDetail->userLevel)>2) { if($user->userLevel>2){redirect('Library/Settings/users');}?>
                    <form class="mt-3 modifyInstitute" action="<?= base_url('Library/Settings/modifyUser/').$user->userIdPK?>" method="POST">
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <?php echo form_password(['class'=>'form-control','placeholder'=>'Enter Password',
                                    'name'=>'password','value'=>set_value('password')])?>
                            </div>
                            <?php echo form_error('password')?>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label for="userLevel">User Level:</label>
                            <div class="input-group mb-3">
                                <?php echo form_password(['class'=>'form-control','placeholder'=>'Re Enter Password',
                                    'name'=>'confirm_pass','value'=>set_value('confirm_pass')])?>
                                <div class="input-group-append">
                                    <?php if (($userDetail->userLevel)>2) {?>
                                        <button type="submit" class="btn btn-primary">Update <i class="fas fa-key"></i></button>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php echo form_error('confirm_pass')?>
                        </div>
                    </form>

                    </div>
                    </form>
            </div>
        </div>
    </div>
<!--End Body Content -->
</div>
<!--End Body Content -->
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>