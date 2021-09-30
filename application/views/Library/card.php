<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-8 col-md-8 col-sm-8 align-content-between">
            <i class="fas fa-user fa-3x"></i><span class="display-4"> Member's Card</span>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 pt-3">
            <?php if (($userDetail->userLevel)>1) {?>
            <button onclick="enableEdit()" class="btn btn-info float-right shadow-sm">
                <i class="far fa-edit"></i> Edit Details
            </button>
            <?php } ?>
            <a  href="<?=base_url('Library/Members/checkout/'.$member->memberIdPK)?>"
                class="btn btn-warning text-white mr-1 float-right shadow-sm">
                <i class="fas fa-sign-in-alt"></i> Checkout
            </a>
        </div>
    </div>
    <div class="row bg-white rounded border p-4 shadow">
        <div class="col-md-4 col-sm-12">
            <img class="img-fluid mt-2 rounded-circle border shadow-sm" width="96%"
                 src="<?=base_url($member->image_path)?>" alt="Card image">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <?php if (($userDetail->userLevel)>1) {?>
                        <form class="form-inline" action="<?=base_url().'Library/Members/modifyImage'?>/<?=$member->memberIdPK;?>" method="post" enctype="multipart/form-data">
                            <input type="file" class="form-control border rounded-0 mb-2 p-1" name="userfile" id="img" style="display: none">
                            <input type="hidden" name="cnic" value="<?=$member->cnic?>">
                            <?php if (isset($error)) { echo $error;}?>
                            <button type="submit" class="btn btn-primary btn-sm mr-auto ml-auto"
                                    id="img-btn" style="display: none">
                                Change Image
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <!--Member Form-->
            <form action="<?= base_url().'Library/Members/card'?>/<?=$member->memberIdPK;?>"
                  id="editMember" method="POST">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group border-bottom border-dark">
                            <label for="name">Full Name:</label>
                            <input class='form-control border-0 bg-transparent'
                                   id='fullName' placeholder='Enter full name' name='fullName'
                            value="<?=set_value('fullName', $member->fullName)?>" required disabled>
                        </div>
                        <?php echo form_error('fullName')?>
                        <div class="form-group border-bottom border-dark">
                            <label for="contact">Contact:</label>
                            <input class='form-control border-0 bg-transparent'
                                   id='contact' placeholder='Enter contact' name='contact'
                                   value="<?=set_value('contact', $member->contact)?>" required disabled>
                        </div>
                        <?php echo form_error('contact')?>
                        <div class="form-group border-bottom border-dark">
                            <label for="address">Address:</label>
                            <input class='form-control border-0 bg-transparent'
                                   id='address' placeholder='Enter address' name='address'
                                   value="<?=set_value('address', $member->address)?>" required disabled>
                        </div>
                        <?php echo form_error('address')?>
                        <div class="form-group border-bottom border-dark">
                            <label for="memberStatus">Member Status:</label>
                            <?php $ms = 'class="form-control border-0 bg-transparent" id="memberStatus" disabled'; ?>
                            <?php
                            $memberStatus=[
                                '0'=>'Inactive',
                                '1'=>'Regular',
                                '2'=>'Free'
                            ] ?>
                            <?= form_dropdown('memberStatus', $memberStatus, $member->memberStatus, $ms); ?>
                        </div>
                        <?php echo form_error('memberStatus')?>
                        <div class="form-group border-bottom border-dark">
                            <label for="booksAllowed">No. Books Allowed:</label>
                            <input class='form-control border-0 bg-transparent'
                                   id='booksAllowed' placeholder='# of books Allowed' name='booksAllowed'
                                   value="<?=set_value('booksAllowed', $member->booksAllowed)?>" required disabled>
                            <?php echo form_error('booksAllowed')?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group border-bottom border-dark">
                            <label for="dob">DOB:</label>
                            <input type="date" class='form-control border-0 bg-transparent'  id='dob'
                                   placeholder='# of books Allowed' name='dob'
                                   value="<?=set_value('dob', date("Y-m-d", strtotime($member->dob)))?>"
                                   required disabled>
                        </div>
                        <?php echo form_error('dob')?>
                        <div class="form-group border-bottom border-dark">
                            <label for="cnic">CNIC #:</label>
                            <input class='form-control border-0 bg-transparent'  id='cnic'
                                   placeholder='Enter CNIC No. without `-`' name='cnic'
                                   value="<?=set_value('cnic', $member->cnic)?>"
                                   required disabled>
                            <?php echo form_error('cnic')?>
                        </div>
                        <div class="form-group border-bottom border-dark">
                            <label for="gender">Gender:</label>
                            <?php $attr3 = 'class="form-control border-0 bg-transparent" id="gender" disabled'; ?>
                            <?php
                            $gender=[
                                '1'=>'Male',
                                '2'=>'Female'
                            ] ?>
                            <?= form_dropdown('gender', $gender, $member->gender, $attr3); ?>

                        </div>
                        <?php echo form_error('gender')?>
                        <div class="form-group border-bottom border-dark">
                            <label for="expiry">
                                Membership Expiry:
                            <?php
                            if (($member->expiry < date("Y-m-d") || $member->expiry == date("Y-m-d")) && ($member->memberStatus!='2')) {
                                echo "<span class='badge badge-danger'>Expired</span>";
                                echo "<button type='button' class='badge badge-pill badge-primary ml-2' data-toggle='modal' data-target='#myModal'>
                                        Renew Now!
                                    </button>";
                            }
                            ?>
                            </label>
                            <input value="<?php if ($member->expiry>0) {
                                echo date("Y-m-d", strtotime($member->expiry));
                                          } else {
                                              echo "New Account" ;
                                          } ?>"
                            type="text" class="form-control text-info border-0 bg-transparent" id="expiry" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="buttons" style="display: none;">
                            <?php if (($userDetail->userLevel)>1) {?>
                                <button type="button" onClick="location.reload()"
                                        class="btn btn-warning text-light float-right shadow-sm">
                                    <i class="fas fa-sync-alt"></i>
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-success float-right mr-2 shadow-sm">
                                    <i class="far fa-check-square"></i> Save
                                </button>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </form>
            <!--End Member Form-->
        </div>
    </div>
</div>
<!-- Body Content End -->
<!-- Fees Modal Start-->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pay Monthly Fees</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form name="form3" id="form3" method="post" class="payMonthlyFees" action="<?=base_url('Library/Transactions/payMonthlyFees/'.$member->memberIdPK)?>">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="table">
                        <thead class="bg-light text-">
                        <tr>
                            <th>Member ID</th>
                            <td><?=$member->memberIdPK?></td>
                        </tr>
                        <tr>
                            <th>Ful Name</th>
                            <td><?=$member->fullName?></td>
                        </tr>
                        <tr>
                            <th>Expiry Date</th>
                            <td><?=$member->expiry?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-secondary text-white">
                            <th colspan="2">Renewal Details</th>
                        </tr>
                        <tr>
                            <th>Monthly Fees</th>
                            <td>
                                <input type="hidden" id="mFees" value="<?=$institution->monthlyFees?>">
                                <?=$institution->monthlyFees?>
                            </td>
                        </tr>
                        <tr>
                            <th>No. of Months</th>
                            <td>
                                <input type="number" name="months" id="months" max="24"
                                       placeholder="Enter # of Months"
                                       class="form-control-sm" required>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" align="right">
                                <div>Your Total is: <input id="total" name="amount" class="font-weight-bold form-control-sm w-50" required readonly></div>
                                <div>Amount Paid: <input id="paid" class="font-weight-bold form-control-sm w-50" type="number" min="1" max="9999" required></div>
                                <div>Change Due: <input id="changeDue" class="font-weight-bold form-control-sm w-50" readonly required></div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Pay <i class="far fa-money-bill-alt"></i></button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Fees Modal End-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#months").change(function(){
            var months = $("#months").val();
            var monthlyFee = $("#mFees").val();
            $("#total").val(months*monthlyFee);
            var totalDue = $("#total").val();
            var paid = $("#paid").val();
            $("#changeDue").val(totalDue-paid);
        });
        $("#paid").change(function(){
            var totalDue = $("#total").val();
            if(totalDue != 0){
                var paid = $("#paid").val();
                $("#changeDue").val(totalDue-paid);
            } else {
                $("#paid").val('0');
                alert('Enter No. of Months First');
                $("#months").focus();
            }
        });
    });
    $('form.payMonthlyFees').on('submit', function(form){
        form.preventDefault();
        if(($("#paid").val()>$("#total").val())||($("#paid").val()==$("#total").val())) {
            $(this).unbind('submit').submit();
        } else {
            alert('Amount paid must be equal or greater to Total Amount');
        }
    });
    function enableEdit() {
        $("#fullName, #contact, #address, #dob, #cnic, #gender, #memberStatus, #booksAllowed").attr('disabled',false);
        $("#fullName, #contact, #address, #dob, #cnic, #gender, #memberStatus, #booksAllowed").removeClass("border-0");
        $("#buttons").show();
        $("#img, #img-btn").css("display", "block");
    }
</script>