<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-list-ol"></i> Users List</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <?php if (($userDetail->userLevel)>1) {?>
            <a href="#" class="btn btn-info">
                <i class="fas fa-user-plus"></i> New User
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput2" onkeyup="myFunction2()"
                       placeholder="Search by User Name">
                <div class="input-group-append">
                    <span class="input-group-text bg-secondary border-secondary">
                        <i class="fas fa-search text-light"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput3" onkeyup="myFunction3()"
                       placeholder="Search by First Name">
                <div class="input-group-append">
                    <span class="input-group-text bg-secondary border-secondary">
                        <i class="fas fa-search text-light"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput1" onkeyup="myFunction1()"
                       placeholder="Search by Last Name">
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
                                <th>No.</th>
                                <th>User Name</th>
                                <th>First Name</th>
                                <th>last Name</th>
                                <th>User level</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($userList)) :?>
                                <?php foreach ($userList as $user) :?>
                                    <tr>
                                        <td><?= $user->userIdPK; ?></td>
                                        <td>
                                            <span class="" ><?= $user->userName; ?></span>
                                        </td>
                                        <td>
                                            <span class="" ><?= $user->firstName; ?></span>
                                        </td>
                                        <td>
                                            <span class="" ><?= $user->lastName; ?></span>
                                        </td>
                                        <td>
                                            <span class="" >
                                                <?php if($user->userLevel==1){
                                                    echo"User/Librarian";
                                                }elseif($user->userLevel==2){
                                                    echo"Admin/Incharge";
                                                }elseif($user->userLevel==3){
                                                    echo"Super Admin";
                                                }?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($user->userLevel<3){?>
                                            <a href="<?=base_url('Library/Settings/modifyUser/').$user->userIdPK; ?>"
                                                    class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-edit"></i> Modify
                                            </a>
                                            <?php }?>
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

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>