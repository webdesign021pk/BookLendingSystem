<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <h4 class="modal-title">Add New Member</h4>
    <?php echo form_open_multipart(base_url().'Library/Members/add');?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter full name','name'=>'fullName','value'=>set_value('fullName')])?>
                    <?php echo form_error('fullName')?>
                </div>
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter contact','name'=>'contact','value'=>set_value('contact')])?>
                    <?php echo form_error('contact')?>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'eg. Flat/House#, Plot#, Block#, Area, City','name'=>'address','value'=>set_value('address')])?>
                    <?php echo form_error('address')?>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="dob">DOB:</label>
                    <input type="hidden" value="<?=date("Y-m-d");?>" name="initialDate">
                    <input type="hidden" value="<?=date("Y-m-d");?>" name="expiry">
                    <?php echo form_input(['class'=>'form-control','type'=>'date','placeholder'=>'Enter Date of Birth','name'=>'dob','value'=>set_value('dob')])?>
                    <?php echo form_error('dob')?>
                </div>
                <div class="form-group">
                    <label for="cnic">CNIC #:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter CNIC No. without `-`','name'=>'cnic','value'=>set_value('cnic')])?>
                    <?php echo form_error('cnic')?>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <?php $attr3 = 'class="form-control" id="gender"'; ?>
                    <?php
                    $gender=[
                        ''=>'Select',
                        '1'=>'Male',
                        '2'=>'Female'
                    ] ?>
                    <?= form_dropdown('gender', $gender, set_value('gender'), $attr3); ?>
                    <?php echo form_error('gender')?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="memberStatus">Member Status:</label>
                    <select class="form-control" id="memberStatus" name="memberStatus">
                        <option value="1">Regular</option>
                        <option value="2">Free</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="booksAllowed">No. Books Allowed:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'No. of Books Allowed','name'=>'booksAllowed','value'=>set_value('booksAllowed')])?>
                    <?php echo form_error('booksAllowed')?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="memberStatus">Profile Picture:</label>
                    <input type="file" name="userfile">
                    <?php if(isset($error)){ echo $error;}?>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-danger" onclick="location.reload();">Reset</button>
        </div>
    </form>
<!--End Body Content -->
</div>
