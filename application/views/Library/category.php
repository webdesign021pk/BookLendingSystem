<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-list-ol"></i> Category List</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <?php if (($userDetail->userLevel)>1) {?>
            <button class="btn btn-info" data-toggle="modal" data-target="#newCat">
                <i class="fas fa-user-plus"></i> New Category
            </button>
            <?php } ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput2" onkeyup="myFunction2()"
                       placeholder="Search by Category">
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
                       placeholder="Search Sub Category">
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
                                <th>Category</th>
                                <th>Sub Category</th>
                                <?php if (($userDetail->userLevel)>1) {?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($category)) :?>
                                <?php foreach ($category as $cat) :?>
                                    <tr>
                                        <td><?= $cat->subCatIdPK; ?></td>
                                        <td>
                                            <?= $cat->category; ?>
                                        </td>
                                        <td>
                                            <span class="" ><?= $cat->subCat; ?></span>
                                            <input type='text' class='txtedit' data-id='<?= $cat->subCatIdPK; ?>'
                                                   data-field='subCat' id='nametxt_<?= $cat->subCatIdPK; ?>'
                                                   value='<?= $cat->subCat; ?>' >
                                        </td>
                                        <?php if (($userDetail->userLevel)>1) {?>
                                        <td>
                                            <button value="<?= $cat->subCatIdPK; ?>"
                                                    class="enable btn btn-outline-info btn-sm">
                                                <i class="fas fa-edit"></i> Modify
                                            </button>
                                        </td>
                                        <?php } ?>
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
<div class="modal" id="newCat">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Category/Sub Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="jsError"></div>
                <form action="#" method="post" class="addNewCategory">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select class="form-control" name="category" id="oldCategory">
                                    <option>Select Category</option>
                                    <?php foreach ($catOnly as $co) {?>
                                        <option><?=$co->category?></option>
                                    <?php } ?>
                                </select>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Add New Category</label>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter New Category"
                                       name="category" id="newCategory" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subCat">Sub Category:</label>
                                <input type="text" class="form-control" placeholder="Enter Sub Category"
                                       name="subCat" id="subCat">
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-warning text-light" onclick="location.reload();"
                                data-dismiss="">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        /*Category toggle*/
        $('#customCheck').change(function(){
            $("#newCategory").prop("disabled", !$(this).is(':checked'));
            $("#oldCategory").prop("disabled", $(this).is(':checked'));
        });
        /*Category toggle*/

        /*add new category*/
        $('form.addNewCategory').on('submit', function(form){
            form.preventDefault();
            $.post('<?=base_url("Library/Transactions/addCategory")?>', $('form.addNewCategory').serialize(), function(data){
                if(data=='1'){
                    location.reload();
                } else {
                    $('div.jsError').html(data);
                }
                /*$('div.jsError').html(data);*/
            });
        });
        /*add new category*/

        // On text click
        $('.enable').click(function(){
            $(this).closest('tr').find('span').addClass("edit");
            var r = confirm("Do you want to edit Sub Category?");
            if(r == true){
                $('.edit').click(function(){
                    // Hide input element
                    $('.txtedit').hide();
                    // Show next input element
                    $(this).next('.txtedit').show().focus();
                    // Hide clicked element
                    $(this).hide();
                    $(this).prev('.edita').hide();
                });
            }

        });

        // Focus out from a textbox
        $('.txtedit').focusout(function(){
            // Get edit id, field name and value
            var edit_id = $(this).data('id');
            var fieldname = $(this).data('field');
            var value = $(this).val();
            if (!/^[A-Za-z -]+$/.test(value)) {
                alert("Category Name must be Alphabets only");
                return false;
            } else {
                // Hide Input element
                $(this).hide();
                // Update viewing value and display it
                $(this).prev('.edit').show();
                $(this).prev('.edit').text(value);
                // Send AJAX request
                $.ajax({
                    url: '<?= base_url("Library/Transactions/modifyCategory") ?>',
                    type: 'post',
                    data: { field:fieldname, value:value, id:edit_id },
                    success:function(response){
                        if(response='1'){
                            alert('Category Modified Successfully');
                        }
                        //console.log(response);
                    }
                });
            }
        });
    });

</script>