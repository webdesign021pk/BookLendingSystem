<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-2">
        <div class="col-md-10">
            <h3><i class="fas fa-home"></i> Dashboard</h3>
        </div>
    </div>
    <div class="row p-3 border bg-white shadow-sm text-center rounded-xl">
        <div class="col-lg-2 col-md-12 col-sm-12">
            <p class="mt-3 text-info">Check-In/Return</p>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 mt-auto mb-auto">
            <span class="font-28 text-info">
                <form class="form-inline jsform" method="post" action="#">
                    <input type="text" class="form-control rounded w-75 mr-1" name="bookNumber" autocomplete="off">
                    <button type="submit" class="btn btn-success rounded">Check-In</button>
                </form>
            </span>
        </div>
        <div class="col-lg-2 text-left">
            <div class="jsError"></div>
        </div>
    </div>
    <br />
    <div class="row mb-2">
        <div class="col-lg-12 bg-white rounded-lg">
            <div class="row p-3 pt-4">
                <div class="col-lg-3 col-md-6 col-sm-6 text-white mr-auto ml-auto">
                    <div class="row border bg-light-blue shadow-sm p-3">
                        <div class="col-lg-3 col-md-12 col-md-12 text-center">
                            <i class="far fa-id-badge fa-4x opacity-80"></i>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto text-center">
                            <span style="font-size: 1.2em">Books Issued: </span>
                            <br>
                            <span style="font-size: 1.2em"><?=$booksIssued->issued?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 text-white mr-auto ml-auto">
                    <div class="row border bg-light-brown shadow-sm p-3">
                        <div class="col-lg-3 col-md-12 col-md-12 text-center">
                            <i class="fas fa-dollar-sign fa-4x opacity-80"></i>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto text-center">
                            <span style="font-size: 1.2em">Unpaid Fine: </span>
                            <br>
                            <span style="font-size: 1.2em"><?=$fineDue->dues?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 text-white mr-auto ml-auto">
                    <div class="row border bg-light-green text-white shadow-sm p-3">
                        <div class="col-lg-3 col-md-12 col-md-12 text-center">
                            <i class="fas fa-user-graduate fa-4x"></i>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto text-center">
                            <span style="font-size: 1.2em">Total Members: </span>
                            <br>
                            <span style="font-size: 1.2em"><?=$totalMembers->members?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 text-white mr-auto ml-auto">
                    <div class="row border bg-light-green text-white shadow-sm p-3">
                        <div class="col-lg-3 col-md-12 col-md-12 text-center">
                            <i class="fas fa-book fa-4x"></i>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto text-center">
                            <span style="font-size: 1.2em">Total Books: </span>
                            <br>
                            <span style="font-size: 1.2em"><?=$totalBooks->books?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br />
    <div class="row mt-2 mb-3 bg-white shadow-sm p-2">
        <div class="col-lg-12 text-center text-danger">
            <h5>Over Due Books</h5>
        </div>
        <div class="col-lg-12 table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-bordered">
                <thead class="bg-dark text-white">
                    <tr>
                        <th width="35%">Member</th>
                        <th width="35%">Book</th>
                        <th>Due Date</th>
                        <th>Over Due Days</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($overDueBooks as $overDueBook) { ?>
                    <tr>
                        <td class="p-0">
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item border-0">
                                    Member ID:<br />
                                    Full Name:
                                </li>
                                <li class="list-group-item border-0">
                                    <a href="<?=base_url('Library/Members/checkout/'.$overDueBook->memberIdPK)?>" class="text-dark">
                                    <?=$overDueBook->memberIdPK;?><br />
                                    <?=$overDueBook->fullName;?>
                                    </a>
                                </li>
                            </ul>
                        </td>
                        <td class="p-0">
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item border-0">
                                    Book ID:<br />
                                    Title:
                                </li>
                                <li class="list-group-item border-0">
                                    <a href="<?=base_url('Library/Books/cover/'.$overDueBook->bookIdPK)?>" class="text-dark">
                                    <?=$overDueBook->bookIdPK;?><br />
                                    <?=$overDueBook->title;?>
                                    </a>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <?=$overDueBook->dueDate;?>
                        </td>
                        <td class="text-danger">
                            <?php
                            $today = date("Y-m-d");
                            $date1 = date_create($today);
                            $date2 = date_create($overDueBook->dueDate);
                            $diff = date_diff($date2, $date1);
                            $fine = $diff->format("%R%a");
                            ?>
                            <?=$fine;?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>        
        </div>
    </div>
    
    
</div>
<!-- Body Content End -->