<!-- Body Content Start -->
<div class="container p-3 mb-5 rounded">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-list-ol"></i> Books List</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <?php
            if (($userDetail->userLevel)>1) {?>
                <a href="<?= base_url('Library/Books/add')?>" class="btn btn-info" >
                    <i class="fas fa-book-medical"></i> New Book
                </a>
            <?php } ?>
        </div>
    </div>

    <!--Members List Table-->
    <div class="row">
        <div class="col-sm-12 col-lg">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div style="overflow-x:auto;">
                        <table id="memberTable" class="table table-hover " style="width: 100% !important;">
                            <thead >
                            <tr class="bg-secondary text-light">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th style="max-width: 8em">Language</th>
                                <th style="max-width: 11em">Category/Sub</th>
                                <th>Publication</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <th>
                                    <input type="text" class="form-control-sm"
                                           id="myInput1" onkeyup="myFunction1()"
                                           placeholder="Book #" style="max-width: 4em">
                                </th>
                                <th>
                                    <input type="text" class="form-control-sm"
                                           id="myInput2" onkeyup="myFunction2()"
                                           placeholder="Book Title">
                                </th>
                                <th>
                                    <input type="text" class="form-control-sm"
                                           id="myInput3" onkeyup="myFunction3()"
                                           placeholder="Author">
                                </th>
                                <th style="max-width: 8em">
                                    <input type="text" class="form-control-sm"
                                           id="myInput4" onkeyup="myFunction4()"
                                           placeholder="Language" style="max-width: 7em">
                                </th>
                                <th style="max-width: 11em">
                                    <input type="text" class="form-control-sm"
                                           id="myInput5" onkeyup="myFunction5()"
                                           placeholder="Category/Sub" style="max-width: 10em">
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($books)) : ?>
                                <?php foreach ($books as $book) : ?>
                                    <tr>
                                        <td><?= $book->bookIdPK; ?></td>
                                        <td>
                                            <a href="<?=base_url('Library/Books/cover/').$book->bookIdPK;?>">
                                                <?= $book->title; ?>
                                            </a><br />
                                            <?php if ($book->bookStatus=='1') {?>
                                                <span class="badge badge-dark">Regular</span>
                                            <?php } elseif($book->bookStatus=='2') {?>
                                                <span class="badge badge-warning">Reference Only</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Disabled/Deleted</span>
                                            <?php } ?>
                                        </td>
                                        <td><?= $book->author; ?></td>
                                        <td style="max-width: 8em"><?= $book->language; ?></td>
                                        <td style="max-width: 11em">
                                            <?= $book->category; ?>/<br>
                                            <?= $book->subCat; ?>
                                        </td>
                                        <td><?= $book->publisher; ?></td>
                                        <td><?= $book->cost; ?></td>
                                        <td>
                                            <?php if ($book->memberIdPK>0) {?>
                                            Issued to: 
                                            <a href="<?=base_url('Library/Members/checkout/').$book->memberIdPK;?>">
                                                <i class="fas fa-user"></i> <?= $book->memberIdPK; ?>
                                            </a>
                                            <?php } elseif($book->memberIdPK==0) {?>
                                                <span class="badge badge-success">Available</span>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else : ?>
                            <tr>
                                <td colspan="8">No Data Availabe</td>
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
    /*AJAX CALL FOR CATEGORY AND SUB CATEGORY*/
    function getSubCat(val) {
        $.ajax({
            type: "POST",
            data: 'cat=' + val,
            url: "php/subcat.php",
            success: function (result) {
                $("#subCat2").html(result);
            }
        });
    }
    function selectCategory(val) {
        $("#category option:selected").text(val)
    }
    /*AJAX CALL FOR CATEGORY AND SUB CATEGORY*/
</script>