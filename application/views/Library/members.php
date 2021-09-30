<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-list-ol"></i> Members</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <?php if (($userDetail->userLevel)>1) {?>
            <a href="<?=base_url('Library/Members/add')?>" class="btn btn-info">
                <i class="fas fa-user-plus"></i> New Member
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput1" onkeyup="myFunction1()"
                       placeholder="Search by Member ID">
                <div class="input-group-append">
                    <span class="input-group-text bg-secondary border-secondary">
                        <i class="fas fa-search text-light"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput2" onkeyup="myFunction2()"
                       placeholder="Search by Full Name">
                <div class="input-group-append">
                    <span class="input-group-text bg-secondary border-secondary">
                        <i class="fas fa-search text-light"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput4" onkeyup="myFunction4()"
                       placeholder="Search by Expiry Month/Year">
                <div class="input-group-append">
                    <span class="input-group-text bg-secondary border-secondary">
                        <i class="fas fa-search text-light"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!--Members List Table-->
    <div class="row">
        <div class="col-sm-12 col-lg">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div style="overflow-x:auto;">
                        <table id="memberTable" class="table table-hover " style="width: 100% !important;">
                            <thead class="bg-secondary text-light">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Contact</th>
                                <th>Expiry</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($members)) :?>
                                <?php foreach ($members as $member) :?>
                                    <tr>
                                        <td><?= $member->memberIdPK; ?></td>
                                        <td>
                                            <img src="<?=base_url($member->image_path)?>"
                                                 class="rounded-circle" style="width:60px;">
                                            <a href="<?=base_url('Library/Members/card/'.$member->memberIdPK)?>">
                                            <?= $member->fullName; ?>
                                            <?php 
                                            if($member->memberStatus=='1') { 
                                                echo '<span class="badge badge-pill badge-primary">Regular</span>';
                                                
                                            }elseif($member->memberStatus=='2'){
                                                echo '<span class="badge badge-pill badge-secondary">Free</span>';
                                            }
                                            ?>
                                            </a>
                                        </td>
                                        <td><?= $member->contact; ?></td>
                                        <td>
                                            <?= $member->expiry; ?>
                                            <?php
                                            if($member->memberStatus=='0'){
                                                echo "<br /><span class='badge badge-dark'>Inactive</span>";
                                            } else {
                                                if (($member->expiry < date("Y-m-d") || $member->expiry == date("Y-m-d")) && ($member->memberStatus!='2')) {
                                                echo "<br /><span class='badge badge-danger'>Expired</span>";
                                                }
                                            }
                                            
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?=base_url('Library/Members/checkout/'.$member->memberIdPK)?>"
                                               class="btn btn-outline-info">
                                                <i class="fas fa-sign-in-alt"></i> Checkout
                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach ?>
                            <?php else :?>
                                <tr>
                                    <td colspan="5">No Data Available</td>
                                </tr>
                            <?php endif ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Members List Table-->
</div>
<!-- Body Content End -->