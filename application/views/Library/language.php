<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-list-ol"></i> Language List</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <?php if (($userDetail->userLevel)>1) {?>
            <button class="btn btn-info" data-toggle="modal" data-target="#newLanguage">
                <i class="fas fa-user-plus"></i> New Language
            </button>
            <?php } ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="input-group mb-2 shadow-sm">
                <input type="text" class="form-control border-secondary" id="myInput2" onkeyup="myFunction2()"
                       placeholder="Search by Language">
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
                                <th>Language</th>
                                <?php if (($userDetail->userLevel)>1) {?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($language)) :?>
                                <?php foreach ($language as $lang) :?>
                                    <tr>
                                        <td><?= $lang->languageIdPK; ?></td>
                                        <td>
                                            <span class="" ><?= $lang->language; ?></span>
                                            <input type='text' class='txtedit' data-id='<?= $lang->languageIdPK; ?>' data-field='language' id='nametxt_<?= $lang->languageIdPK; ?>' value='<?= $lang->language; ?>' >
                                        </td>
                                        <?php if (($userDetail->userLevel)>1) {?>
                                        <td>
                                            <button value="<?= $lang->languageIdPK; ?>"
                                                    class="enable btn btn-outline-info btn-sm">
                                                <i class="fas fa-edit"></i> Modify
                                            </button>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php endforeach ?>
                            <?php else :?>
                                <tr>
                                    <td colspan="3">No Data Available</td>
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
<div class="modal" id="newLanguage">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Language</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="jsError"></div>
                <form action="#" method="post" class="addNewLanguage">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="language">Language:</label>
                                <input type="text" class="form-control"
                                       placeholder="Enter language" name="language" pattern="^[A-Za-z -]+$">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-danger" onclick="resetForm()">Reset</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        /*add new language*/
        $('form.addNewLanguage').on('submit', function(form){
            form.preventDefault();
            $.post('<?=base_url("Library/Transactions/addLanguage")?>', $('form.addNewLanguage').serialize(), function(data){
                if(data=='1'){
                    location.reload();
                } else {
                    $('div.jsError').html(data);
                }
                //location.reload();
            });
        });
        /*add new language*/

        // On text click
        $('.enable').click(function(){
            $(this).closest('tr').find('span').addClass("edit");
            var r = confirm("Do you want to edit Language?");
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
                alert("Language Name must be Alphabets only");
                return false;
            } else {
                // Hide Input element
                $(this).hide();
                // Update viewing value and display it
                $(this).prev('.edit').show();
                $(this).prev('.edit').text(value);
                // Send AJAX request
                $.ajax({
                    url: '<?= base_url("Library/Transactions/modifyLanguage") ?>',
                    type: 'post',
                    data: { field:fieldname, value:value, id:edit_id },
                    success:function(response){
                        if(response='1'){
                            alert('Language Modified Successfully');
                        }
                        //console.log(response);
                    }
                });
            }
        });
    });
</script>