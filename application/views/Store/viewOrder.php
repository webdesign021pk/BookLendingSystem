<!-- Body Content Start -->
<div class="container p-3 pb-5">
    <h3 class="modal-title pb-2 text-center">Order Details</h3>
    <div class="row bg-white pt-4 rounded shadow-sm">
        <?php if($details) {?>
            <div class="col-9 mx-auto">
                <table class="table table-bordered">
                    <tr>
                        <td class="py-1">Order Date</td>
                        <td class="py-1"><?=$details[0]->orderDate?></td>
                    </tr>
                    <tr>
                        <td class="py-1">Customer Name</td>
                        <td class="py-1"><?=$details[0]->buyerName?></td>
                    </tr>
                    <tr>
                        <td class="py-1">Customer Contact</td>
                        <td class="py-1"><?=$details[0]->buyerContact?></td>
                    </tr>
                    <tr>
                        <td class="py-1">Customer Address</td>
                        <td class="py-1">
                            <?=$details[0]->buyerAddress?><br />
                            Near: <?=$details[0]->buyerNearbyPlace?><br />
                            City: <?=$details[0]->buyerCity?>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1">Email</td>
                        <td class="py-1"><?=$details[0]->buyerEmail?></td>
                    </tr>
                </table>
            </div>
            <div class="col-9 bg-white p-2 mx-auto">
                <table class="table table-stripped">
                    <thead class="bg-secondary text-white">
                    <tr>
                        <td>Id</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Amount (in PKR)</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($details as $row) { ?>
                        <tr>
                            <td><?=$row->productIdPK?></td>
                            <td><?=$row->productName?></td>
                            <td><?=$row->qtyRequired?></td>
                            <td><?=$row->cost?></td>
                            <td class="price">
                                <?=($row->cost*$row->qtyRequired)?>
                                <span>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4" align="right">Total</td>
                        <td><span id="total"></span></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-9 mx-auto">
                <h5>Additional Information:</h5>
                <p class="d-block border rounded p-3">
                    <?=$details[0]->aditionalInfo?>
                </p>
            </div>
        <?php }?>

    </div>

    <br />

<!--End Body Content -->
</div>
<script>
    $(document).ready(function(){
        var summ = 0;
        $("td.price").each(function() {
            summ += Number($(this).text());
        });
        //console.log("Result: " + summ);
        $("#total").text(summ);
    });
    //
</script>