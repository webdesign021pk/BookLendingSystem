<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <h4 class="modal-title">Add New Product</h4>
    <br />
    <?php echo form_open_multipart(base_url('Seller/addProduct'));?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">

                <div class="form-group border-secondary">
                    <label for="productName">Product Name:</label>
                    <input class='form-control '
                           id='productName' placeholder='Enter Product name' name='productName'
                           value="<?=set_value('productName')?>"  required >
                </div>
                <?php echo form_error('productName')?>

                <div class="form-group border-secondary">
                    <label for="costPrice">Cost Price:</label>
                    <input class='form-control '
                           id='costPrice' placeholder='Enter cost Price' name='costPrice'
                           value="<?=set_value('costPrice')?>"  required >
                </div>
                <?php echo form_error('costPrice')?>

                <div class="form-group border-secondary">
                    <label for="status">Item Status:</label>
                    <?php $ms = 'class="form-control " id="status" '; ?>
                    <?php
                    $articleStatus=[
                        '1'=>'Active',
                        '0'=>'Inactive'
                    ] ?>
                    <?= form_dropdown('status', $articleStatus, set_value('status'), $ms); ?>
                </div>
                <?php echo form_error('status')?>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group border-secondary">
                    <label for="productCode">Poduct Code:</label>
                    <input class='form-control '
                           id='productCode' placeholder='Enter Article No.' name='productCode'
                           value="<?=set_value('productCode')?>"  required >
                </div>
                <?php echo form_error('productCode')?>

                <div class="form-group border-secondary">
                    <label for="sellPrice">selling Price:</label>
                    <input class='form-control'
                           id='sellPrice' placeholder='Enter selling Price' name='sellPrice'
                           value="<?=set_value('sellPrice')?>" required >
                </div>
                <?php echo form_error('costPrice')?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="memberStatus">Product Picture:</label>
                    <input type="hidden" value="<?=$_SESSION['storeId']?>" name="storeId">
                    <input type="file" name="userfile">
                    <?php if(isset($error)){ echo $error;}?>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-danger" onclick="location.reload();">Reset</button>
        </div>
    </form>
<!--End Body Content -->
</div>
