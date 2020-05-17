<!-- Body Content Start -->
<?php
if($this->uri->segment(3) != ''){
?>
<div class="container p-3 pb-5">
    <h3 class="modal-title">
        Place Order <small style="font-size: 1rem"><a href="<?=base_url('Store/index/'.$this->uri->segment(3))?>"> << Return to Products</a></small>
    </h3>
    <br />
    <form action="#" method="post" class="">
        <!--Order Items-->
        <div class="row">
            <div class="col-sm-12 col-lg">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-lg-3 col-md-6">
                                <div class="input-group mb-2 shadow-sm">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary text-light border-secondary">
                                        Product
                                    </span>
                                    </div>
                                    <input type="text" class="form-control border-secondary" value="" id=""
                                           placeholder="Search Product">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="input-group mb-2 shadow-sm">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text bg-secondary text-light border-secondary">
                                        Qty
                                    </span>
                                    </div>
                                    <input type="text" class="form-control border-secondary" id="bookId"
                                           onchange="/*getBookDetails(this.value)*/" placeholder="Enter Quantity">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <button onclick=''
                                            class="btn btn-outline-secondary">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table id="" class="table table-hover " style="width: 100% !important;">
                                <thead class="bg-secondary text-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="orderItems">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Order Items-->
        <br />
        <!--Customer Details-->
        <div class="row p-2">
            <div class="col-12 py-3 bg-white shadow-sm rounded border">
                <div class="row">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">Customer Details</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group-sm border-secondary">
                            <label for="buyerName">Customer's Name*:</label>
                            <input class='form-control ' name="buyerName"
                                   value="<?=set_value('buyerName')?>" required>
                            <?php echo form_error('buyerName')?>
                        </div>
                        <div class="form-group-sm border-secondary">
                            <label for="buyerContact">Contact*:</label>
                            <input class='form-control ' name="buyerContact"
                                   value="<?=set_value('buyerContact')?>" required>
                            <?php echo form_error('buyerContact')?>
                        </div>
                        <div class="form-group-sm border-secondary">
                            <label for="buyerAddress">Address*:</label>
                            <input class='form-control ' name="buyerAddress"
                                   value="<?=set_value('buyerAddress')?>" required>
                            <?php echo form_error('buyerAddress')?>
                        </div>
                        <div class="form-group border-secondary">
                            <label for="buyerNearbyPlace">Nearby Place:</label>
                            <input class='form-control ' name="buyerNearbyPlace"
                                   value="<?=set_value('buyerNearbyPlace')?>">
                            <?php echo form_error('buyerNearbyPlace')?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group-sm border-secondary">
                            <label for="buyerEmail">Email (If you have):</label>
                            <input class='form-control ' name="buyerEmail"
                                   value="<?=set_value('buyerEmail')?>">
                            <?php echo form_error('buyerEmail')?>
                        </div>
                        <div class="form-group-sm border-secondary">
                            <label for="buyerCity">City:</label>
                            <?php $bs = 'class="form-control" id="buyerCity" '; ?>
                            <?php
                            $buyerCity=[
                                ''=>'Select City',
                                'Karachi'=>'Karachi',
                                'Hyderabad'=>'Hyderabad',
                                'Sukhar'=>'Sukhar',
                                'Mirpur Khas'=>'Mirpur Khas',
                                'Lahore'=>'Lahore',
                                'Multan'=>'Multan',
                                'Faisalabad'=>'Faisalabad',
                                'Islamabad'=>'Islamabad',
                                'Peshawar'=>'Peshawar',
                                'Quetta'=>'Quetta',
                                'Other'=>'Other',
                            ] ?>
                            <?= form_dropdown('buyerCity', $buyerCity, set_value('buyerCity'), $bs); ?>
                            <?php echo form_error('buyerCity')?>
                        </div>
                        <div class="form-group-sm border-secondary">
                            <label for="aditionalInfo">Aditional Info:</label>
                    <textarea class='form-control ' name="aditionalInfo" rows="4">
                        <?=set_value('aditionalInfo')?>
                    </textarea>
                            <?php echo form_error('aditionalInfo')?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--Customer Details-->
        <div class="float-right mt-3">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-danger" onclick="location.reload();">Reset</button>
        </div>
    </form>
    <br />

<!--End Body Content -->
</div>
<script>
    $('#quantity').change(function(){
        var price = $('#price').val();
        var qty = $('#quantity').val();
        var total = price*qty;
        $('#total').val(total);
    });
    $('form.newOrder').on('submit', function(form){
        form.preventDefault();
        if (confirm('Are you sure you want to purchase?')) {
            $(this).unbind('submit').submit();
        } else {
            // Do nothing!
        }
    });
</script>
<?php } ?>
