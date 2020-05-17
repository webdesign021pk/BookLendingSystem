<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-2">
        <div class="col-md-10">
            <h3><i class="fas fa-book"></i> Orders</h3>
        </div>
    </div>
    <div class="row mb-2 p-3">
        <div class="col-lg-12 bg-white rounded-lg p-2 shadow-sm">
            <h4 class="pb-2">Pending Orders</h4>
            <?php if ($pendingOrder) { ?>
                <div class="table-responsive">
                    <table class="table table-responsive-lg table-stripped table-bordered table-hover">
                        <thead class="">
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Buyer Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Additional Info</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pendingOrder as $row) { ?>
                            <tr>
                                <td><?=$row->orderIdPK?></td>
                                <td><?=$row->orderDate?></td>
                                <td><?=$row->buyerName?></td>
                                <td>
                                    <?=$row->buyerAddress?><br />
                                    Near: <?=$row->buyerNearbyPlace?>
                                </td>
                                <td><?=$row->buyerContact?></td>
                                <td><?=$row->aditionalInfo?></td>
                                <td>
                                    <a href="<?=base_url('Seller/viewOrder/'.$row->orderIdPK)?>" class="btn btn-sm btn-info text-white">
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            <?php  } ?>
        </div>
    </div>
    <br />
    
</div>
<!-- Body Content End -->