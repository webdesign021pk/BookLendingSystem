<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3><i class="fas fa-sign-out-alt"></i> Checkout/Issue Book</h3>
        </div>
    </div>

    <!--Members List Table-->
    <div class="row mb-2">
        <div class="col-sm-12 col-lg">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <table class="table border-0">
                                <tr>
                                    <td>Member ID:</td>
                                    <td>
                                        <span class="font-weight-bold" id="memId">
                                            <?=$member->memberIdPK?>
                                        </span>
                                        <a href="<?=base_url('Library/Members/card/'.$member->memberIdPK)?>">
                                            <i class="fas fa-eye"></i> view
                                        </a>
                                        <span class="float-right">
                                            <?php
                                            if (($fineDue->dues)>0) {?>
                                                Dues:
                                            <span class="badge badge-pill badge-danger"><?=$fineDue->dues?></span>
                                            <button type="button" class="badge badge-pill badge-primary" data-toggle="modal" data-target="#myModal">
                                                Pay
                                            </button>
                                            <?php  } ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Member Name:</td>
                                    <td>
                                        <span class="font-weight-bold">
                                            <?=$member->fullName?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Member Status:</td>
                                    <td>
                                        <input type="hidden" value="<?=$member->booksAllowed?>" id="">
                                        <span class="font-weight-bold">
                                            <?php if($member->memberStatus=='0'){echo "Inactive";} ?>
                                            <?php if($member->memberStatus=='1'){echo "Regular";} ?>
                                            <?php if($member->memberStatus=='2'){echo "Free";} ?>
                                        </span>
                                        [<?=$member->booksAllowed?> Book(s) allowed]
                                    </td>
                                </tr>
                            </table>
                            <div class="jsError"></div>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-0">
                            <img class="img-thumbnail img-fluid mx-auto d-block"
                                 src="<?=base_url($member->image_path)?>"
                                 style="max-width: 200px !important;" width="90%" alt="image">
                        </div>
                        <div class="col-lg-5 border-left border-bottom">
                            <span class="font-weight-bold">
                                Books Already Issued:
                            </span>
                            <table class="table table-responsive" id="jj">
                                <?php if (isset($issuedBooks)) {?>
                                    <?php foreach ($issuedBooks as $issuedBook) {?>
                                        <tr>
                                        <td><?=$issuedBook->bookIdPK;?></td>
                                        <td><?=$issuedBook->title;?></td>
                                        <td>
                                            <?=$issuedBook->dueDate;?>
                                            <?php
                                            $diff = date_diff(date_create($issuedBook->dueDate), date_create(date("Y-m-d")));
                                            $fine = $diff->format("%R%a");
                                            if ($fine>0) {?>
                                                <span class="badge badge-pill badge-danger">Late</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <form method="post" action="#" class="jsformCheckIn2">
                                                <input type="hidden" value="<?=$issuedBook->bookIdPK;?>" name="bookNumber">
                                                <button type="submit" class="btn btn-sm btn-outline-info">Check-In</button>
                                            </form>
                                        </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group mb-2 shadow-sm">
                                <?php $dueDays=$instituteDetails->dueDays;?>
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary text-light border-secondary">
                                        <i class="fas fa-hashtag text-light"></i>&nbsp;of Due Days
                                    </span>
                                </div>
                                <input type="text" class="form-control border-secondary" value="<?=$dueDays?>" id="due_Days">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="input-group mb-2 shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary text-light border-secondary">
                                        <i class="fas fa-book text-light"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border-secondary" id="bookId"
                                       onchange="/*getBookDetails(this.value)*/" placeholder="Enter Book ID">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <button onclick='getBookDetails(document.getElementById("bookId").value)'
                                       class="btn btn-outline-secondary">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <form action="<?=base_url('Library/Transactions/checkOut')?>" method="post" id="issueBooks">
                            <input type="hidden" value="<?=$member->memberIdPK?>" name="memberId">
                            <input type="hidden" value="<?=$member->booksAllowed?>" name="booksAllowed" id="booksAllowed">
                            <table id="checkOutTable" class="table table-hover " style="width: 100% !important;">
                                <thead class="bg-secondary text-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Expiry</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="checkOutItems">
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-right"
                                    id="submit" value="submit" name="checkOut">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Members List Table-->
</div>
<!-- Body Content End -->
<!-- Dues Modal Start-->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pay Fine/Dues</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form name="form3" class="payLateFine" id="form3" method="post" action="<?=base_url('Library/Transactions/payFine/'.$member->memberIdPK)?>">

            <div class="col-lg-12 col-md-12 col-sm-12">
                <table class="table" id="">
                    <thead class="bg-light text-">
                    <tr>
                        <th>BookID</th>
                        <th>Fine</th>
                        <th>Select</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?=$payFine;?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" align="right">
                            <div>Your Total is: <input id="total" class="font-weight-bold form-control-sm w-50" required readonly></div>
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
<!-- Dues Modal End-->
<script type="text/javascript">
    $(document).ready(function(){
        $( "#issueBooks" ).submit(function( event ) {
            var rows = $('#checkOutTable >tbody >tr').length;
            if (rows>0) {
                //$( "span" ).text( "Validated..." ).show();
                return;
            }
            alert('Please Select a book first!');
            //$( "span" ).text( "Not valid!" ).show().fadeOut( 1000 );
            event.preventDefault();
        });
        $("#paid").change(function(){
            var totalDue = $("#total").val();
            var paid = $("#paid").val();
            $("#changeDue").val(totalDue-paid);
        });
    });
    function getBookDetails(val)
    {
        var booksAllowed = document.getElementById("booksAllowed").value;
        var due_Days = document.getElementById("due_Days").value;
        var booksIssued = document.getElementById("jj").rows.length;
        //var x = document.getElementById("jj").rows.length;
        var rows = $('#checkOutTable >tbody >tr').length;
        //alert(booksIssued);
        var newBooks = (booksAllowed-(booksIssued+rows));
        if(newBooks>0){
            var tdlength= $("td").filter(function() {
                return $(this).text().toLowerCase() == val ;//get td with item_x
            }).length;
            if(!tdlength){ //td with html item_x  does not exists.
                //code here
                $.ajax({
                    type: "POST",
                    data: {
                        bookId: val,
                        dueDays: due_Days
                    },
                    url: "<?=base_url('Library/Transactions/checkoutTable')?>",
                    success: function (result) {
                        if(!result){
                            alert('Book is already issued OR discarded');
                        }
                        else {
                            $("#checkOutItems").append(result);
                        }
                    }
                });
            }
            else {
                alert('Book is already entered! / OR Dues Pending, Please Pay First!');
            }
        }
        else{
            alert('Please return issued books first');
        }
        document.getElementById("bookId").value = "";
    }
    function deleteRow(r)
    {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("checkOutTable").deleteRow(i);
    }
    function updateAmountDue(){
        //alert('jj');
        var totalDue = $("#total").innerHTML();
        $("#changeDue").val(totalDue);
    }
    $('form.payLateFine').on('submit', function(form){
        form.preventDefault();
        if(($("#paid").val()>$("#total").val())||($("#paid").val()==$("#total").val())) {
            $(this).unbind('submit').submit();
        } else {
            alert('Amount paid must be equal or greater to Total Amount');
        }
    });
</script>