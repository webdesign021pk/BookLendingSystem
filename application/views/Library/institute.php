<!-- Body Content Start -->
<div class="container p-3 mb-5">
<!-- Body Content Start -->
    <h4 class="modal-title"><i class="fas fa-university"></i> Institution Details</h4>
    <div class="jsError"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                Note: Modification of Institution Details is Disabled in Demo Version.
            </div>
        </div>
        <div class="col-lg-3">
            <img class="img-fluid mt-2 rounded-circle shadow-sm mx-auto d-block" width="90%"
                 src="<?=base_url($institute->image_path)?>"
                 style="max-width: 260px;" alt="Card image">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php if (($userDetail->userLevel)>2) {?>
                            <form class="form-inline" action="<?=base_url('Library/Settings/modifyInstituteImage')?>" method="post" enctype="multipart/form-data">
                                <input type="file" class="form-control w-100 border rounded-0 mb-2 p-1" name="userfile">
                                <input type="hidden" name="institutionIdPK" value="<?=$institute->institutionIdPK?>">
                                <?php if (isset($imageError)) { echo $imageError;}?>
                                <button type="submit" class="btn btn-primary btn-sm mr-auto ml-auto">Change Image</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <?php if (($userDetail->userLevel)>2) {?>
            <form class="mt-3 modifyInstitute" action="<?= base_url().'Library/Settings/institute'?>" method="POST">
            <?php } ?>
                <div id="instituteForm">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="name">Name of Institution:</label>
                            <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Name of Institution',
                                'name'=>'name','value'=>set_value('name', $institute->name)])?>
                            <?php echo form_error('name')?>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact:</label>
                            <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter contact',
                                'name'=>'contact','value'=>set_value('contact', $institute->contact)])?>
                            <?php echo form_error('contact')?>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <?php echo form_input(['class'=>'form-control','placeholder'=>'eg. Flat/House#, Plot#, Block#, Area, City',
                                'name'=>'address','value'=>set_value('address', $institute->address)])?>
                            <?php echo form_error('address')?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="establishedIn">Established In:</label>
                            <?php echo form_input(['class'=>'form-control','type'=>'date','placeholder'=>'Enter Date of Birth',
                                'name'=>'establishedIn','value'=>set_value('establishedIn', date("Y-m-d", strtotime($institute->establishedIn)))])?>
                            <?php echo form_error('establishedIn')?>
                        </div>
                        <div class="form-group">
                            <label for="registrationNo">Registration #:</label>
                            <?php echo form_input(['class'=>'form-control','placeholder'=>'Registration No.',
                                'name'=>'registrationNo','value'=>set_value('registrationNo', $institute->registrationNo)])?>
                            <?php echo form_error('registrationNo')?>
                        </div>
                    </div>
                </div>
                <div class="row border-top pt-2">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="dueDays">Due Days:</label>
                            <?php echo form_input(['class'=>'form-control','type'=>'text','placeholder'=>'Enter Due Days',
                                'name'=>'dueDays','value'=>set_value('dueDays', $institute->dueDays)])?>
                            <?php echo form_error('dueDays')?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="monthlyFees">Monthly Fees:</label>
                            <?php echo form_input(['class'=>'form-control','placeholder'=>'Monthly Fees',
                                'name'=>'monthlyFees','value'=>set_value('monthlyFees', $institute->monthlyFees)])?>
                            <?php echo form_error('monthlyFees')?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="w-100">
                        <?php if (($userDetail->userLevel)>2) {?>
                            <button type="submit" class="btn btn-success float-right">Save</button>
                            <button type="reset" class="btn btn-danger float-right mr-2" onclick="location.reload()">Reset</button>
                        <?php } ?>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
<!--End Body Content -->
</div>
<!--End Body Content -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#instituteForm :input").attr("disabled", true);
    });
</script>