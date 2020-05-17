<?php
if($product->storeId==$_SESSION['storeId']) {
?>
<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-8 col-md-8 col-sm-8 align-content-between">
            <i class="fas fa-box fa-3x"></i><span class="display-4"> Product Details</span>
            <a href="<?=base_url('seller/myProducts')?>">
                << Return to Products
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 pt-3">

        </div>
    </div>
    <div class="row bg-white rounded border p-4 shadow">
        <div class="col-md-4 col-sm-12">
            <img class="img-fluid mt-2 mb-2 d-block mx-auto border rounded-lg shadow-sm" width="80%"
                 src="<?=base_url($product->image_path)?>" alt="Card image">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <br />
                        <form class="form-inline"
                              action="<?=base_url('Seller/modifyImage/'.$product->productIdPK)?>" method="post"
                              enctype="multipart/form-data">
                            <input type="file" class="form-control-file border rounded mb-2 p-1"
                                   name="userfile" id="img">
                            <input type="hidden" name="articleIdPK" value="<?=$product->productIdPK?>">
                            <?php if (isset($error)) { echo $error;}?>
                            <button type="submit" class="btn btn-primary btn-sm mr-auto ml-auto"
                                    id="img-btn" >
                                Change Image
                            </button>
                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <!--Article Form-->
            <form action="<?= base_url('Seller/card/'.$product->productIdPK)?>"
                  id="editMember" method="POST">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <div class="form-group border-secondary">
                            <label for="productName">Products Name:</label>
                            <input class='form-control '
                                   id='productName' placeholder='Enter full name' name='productName'
                            value="<?=set_value('productName', $product->productName)?>"  required >
                        </div>
                        <?php echo form_error('productName')?>

                        <div class="form-group border-secondary">
                            <label for="costPrice">Cost Price:</label>
                            <input class='form-control '
                                   id='costPrice' placeholder='Enter costPrice' name='costPrice'
                                   value="<?=set_value('costPrice', $product->costPrice)?>"  required >
                        </div>
                        <?php echo form_error('costPrice')?>

                        <div class="form-group border-secondary">
                            <label for="status">Item Status:</label>
                            <?php $ms = 'class="form-control " id="status" '; ?>
                            <?php
                            $productStatus=[
                                '0'=>'Inactive',
                                '1'=>'Active'
                            ] ?>
                            <?= form_dropdown('status', $productStatus, $product->status, $ms); ?>
                        </div>
                        <?php echo form_error('status')?>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group border-secondary">
                            <label for="productCode">Article No:</label>
                            <input class='form-control '
                                   id='productCode' placeholder='Enter contact' name='productCode'
                                   value="<?=set_value('productCode', $product->productCode)?>"  required >
                        </div>
                        <?php echo form_error('productCode')?>

                        <div class="form-group border-secondary">
                            <label for="sellPrice">selling Price:</label>
                            <input class='form-control'
                                   id='sellPrice' placeholder='Enter sellPrice' name='sellPrice'
                                   value="<?=set_value('sellPrice', $product->sellPrice)?>" required >
                        </div>
                        <?php echo form_error('costPrice')?>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" onClick="location.reload()"
                                class="btn btn-warning text-light float-right shadow-sm">
                            <i class="fas fa-sync-alt"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success float-right mr-2 shadow-sm">
                            <i class="far fa-check-square"></i> Save
                        </button>
                    </div>

                </div>
            </form>
            <!--End Article Form-->
        </div>
    </div>
</div>
<!-- Body Content End -->

<?php } else {
    echo "<div class='text-center'>";
    echo "No Data Available <br />";
    echo "<a href='".base_url('Seller/myProducts')."'><< Return to Products/Items</a>";
    echo "</div>";
}
?>