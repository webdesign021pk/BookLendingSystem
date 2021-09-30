<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <h4 class="modal-title">Add New Book</h4>
    <form class="mt-3" action="<?= base_url().'Library/Books/add'?>" method="POST">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter title','name'=>'title','value'=>set_value('title')])?>
                    <?php echo form_error('title')?>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter author','name'=>'author','value'=>set_value('author')])?>
                    <?php echo form_error('author')?>
                </div>

                <div class="form-group">
                    <label for="languageId">Language:</label>
                    <?php $bl = 'class="form-control" id="languageId" '; ?>
                    <?= form_dropdown('languageId', $bookLanguage, set_value('languageId'), $bl); ?>
                    <?php echo form_error('languageId')?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="cat">Category:</label>
                    <?php $attr = 'class="form-control" id="cat"'; ?>
                    <?php $bookCategory = array_column($bookCategory, 'category');?>
                    <?php $bookCategory = array_combine($bookCategory, $bookCategory);?>
                    <?= form_dropdown('', $bookCategory, set_value('cat'), $attr); ?>
                </div>
                <div class="form-group">
                    <label for="subCatId">Sub Category</label>
                    <?php $sc = 'class="form-control" id="subCatId" '; ?>
                    <?php
                    $subCategory=[
                        'Select'=>'Select Sub Category'
                    ]
                    ?>
                    <?= form_dropdown('subCatId', $subCategory, set_value('subCatId'), $sc); ?>
                    <?php echo form_error('subCatId')?>
                </div>
                <div class="form-group">
                    <label for="gender">Book Status:</label>
                    <?php $bs = 'class="form-control" id="bookStatus" '; ?>
                    <?php
                    $bookStatus=[
                        'Select'=>'Select Status',
                        '1'=>'Regular',
                        '2'=>'Reference Only',
                    ] ?>
                    <?= form_dropdown('bookStatus', $bookStatus, set_value('bookStatus'), $bs); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="dob">Notes:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter notes','name'=>'notes','value'=>set_value('notes')])?>
                    <?php echo form_error('notes')?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="publisher">Publisher:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Publisher Name','name'=>'publisher','value'=>set_value('publisher')])?>
                    <?php echo form_error('publisher')?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label for="dob">Cost:</label>
                    <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Cost','name'=>'cost','value'=>set_value('cost')])?>
                    <?php echo form_error('cost')?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger" onclick="location.reload();">Reset</button>
        </div>
    </form>
<!--End Body Content -->
</div>
