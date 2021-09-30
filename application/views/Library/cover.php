<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8 align-content-between">
            <i class="fas fa-book fa-3x"></i>
            <span class="display-4"> Book's Details</span>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4 pt-3">
            <?php if (($userDetail->userLevel)>1) {?>
            <button onclick="enableEdit()" class="btn btn-info float-right shadow-sm">
                <i class="far fa-edit"></i> Edit Details
            </button>
            <?php } ?>
        </div>
    </div>
    <form action="<?= base_url().'Library/Books/cover'?>/<?=$book->bookIdPK;?>" id="editMember" method="POST">
        <!--Form Details-->
        <div class="row bg-white p-4 border rounded shadow">
            <div class="col-lg-6">
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Title: </span>
                    </div>
                    <input type="hidden" value="<?=$book->bookIdPK;?>" name="">
                    <input type="text" value="<?=set_value('title', $book->title);?>" name="title"
                           class="form-control text-right border-0 bg-transparent" id="title"
                           placeholder="Enter Title" required disabled >
                </div>
                <?php echo form_error('title')?>
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Author: </span>
                    </div>
                    <input type="text" value="<?=set_value('author', $book->author);?>"
                           class="form-control text-right border-0 bg-transparent" name="author"
                           placeholder="Enter author" id="author" disabled>
                </div>
                <?php echo form_error('author')?>
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Language: </span>
                    </div>
                    <?php $bl = 'class="form-control border-0 bg-transparent text-right" id="languageId" dir="rtl" disabled'; ?>
                    <?= form_dropdown('languageId', $bookLanguage, set_value('languageId', $book->languageId), $bl); ?>
                    <?php echo form_error('languageId')?>
                </div>
                <?php echo form_error('languageId')?>
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Cost: </span>
                    </div>
                    <input type="text" value="<?=set_value('cost', $book->cost);?>" name="cost"
                           class="form-control text-right border-0 bg-transparent" id="cost"
                           placeholder="Enter cost" disabled>
                </div>
                <?php echo form_error('cost')?>
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Notes: </span>
                    </div>
                    <input type="text" value="<?=set_value('notes', $book->notes);?>" name="notes"
                           class="form-control text-right border-0 bg-transparent" id="notes"
                           placeholder="Enter notes" disabled>
                </div>
                <?php echo form_error('notes')?>
            </div>
            <div class="col-lg-6">
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Category: </span>
                    </div>
                    <?php $bookCategory = array_column($bookCategory, 'category');?>
                    <?php $bookCategory = array_combine($bookCategory, $bookCategory);?>
                    <?php $attr = 'class="form-control border-0 bg-transparent text-right" id="cat" dir="rtl" disabled'; ?>
                    <?= form_dropdown('', $bookCategory, $book->category, $attr); ?>
                </div>
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Sub Category: </span>
                    </div>
                    <select name="subCatId" class="form-control border-0 bg-transparent text-right" id="subCatId" dir="rtl" disabled>
                        <option value="<?=$book->subCatId?>" selected><?=$book->subCat?></option>
                    </select>
                </div>
                <?php echo form_error('subCatId')?>
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Book Status: </span>
                    </div>
                    <?php $attr3 = 'class="form-control border-0 bg-transparent text-right" id="bookStatus" dir="rtl" disabled'; ?>
                    <?php
                    $bookStatus=[
                        '0'=>'Disable/Deleted',
                        '1'=>'Regular',
                        '2'=>'Reference Only'
                    ] ?>
                    <?= form_dropdown('bookStatus', $bookStatus, $book->bookStatus, $attr3); ?>
                </div>
                <?php echo form_error('bookStatus')?>
                <div class="input-group mb-3 border-bottom border-dark">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 text-info">Publisher: </span>
                    </div>
                    <input type="text" value="<?=set_value('publisher', $book->publisher);?>" name="publisher"
                           class="form-control text-right border-0 bg-transparent" id="publisher"
                           placeholder="Enter publisher" disabled>
                </div>
                <?php echo form_error('publisher')?>
                <?php if (($userDetail->userLevel)>1) {?>
                    <div id="buttons" style="display: none">
                        <button type="button" onClick="location.reload()"
                                class="btn btn-warning text-light float-right shadow-sm">
                            <i class="fas fa-sync-alt"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success float-right shadow-sm mr-2">
                            <i class="far fa-check-square"></i>
                            Save
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!--End Form Details-->
    </form>
</div>
<!-- Body Content End -->
<script>
    function enableEdit() {
        $("#title, #languageId, #cat, #author, #publisher, #subCatId, #bookStatus, #notes, #cost").attr('disabled',false);
        $("#buttons").show();
        $("#title, #languageId, #cat, #author, #publisher, #subCatId, #bookStatus, #notes, #cost").removeClass("border-0");
    }
</script>