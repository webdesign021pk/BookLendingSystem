<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-list-ol"></i> Products</h3>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-4">
            <a href="<?=base_url('Seller/addProduct')?>" class="btn btn-info">
                <i class="fas fa-box"></i> New Product
            </a>
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
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Cost Price</th>
                                <th>Sell Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($products)) :?>
                                <?php foreach ($products as $row) :?>
                                    <tr>
                                        <td><?= $row->productIdPK; ?></td>
                                        <td>
                                            <img src="<?=base_url($row->image_path)?>"
                                                 class="rounded-circle" style="width:60px;">
                                        </td>
                                        <td>
                                            <?= $row->productName; ?>
                                        </td>
                                        <td><?= $row->productCode; ?></td>
                                        <td><?= $row->costPrice; ?></td>
                                        <td><?= $row->sellPrice; ?></td>
                                        <td>
                                            <?php
                                            if($row->status=='1') {
                                                echo 'Available';

                                            }else{
                                                echo 'N/A';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?=base_url('Seller/card/'.$row->productIdPK)?>"
                                               class="btn btn-sm btn-outline-info">
                                                EDIT
                                            </a>
                                        </td>
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