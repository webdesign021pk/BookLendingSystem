<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3>
                <i class="fas fa-boxes"></i>
                All Products of -<?=$storeName?>
            </h3>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            <form>
            <div class="form-group mb-2">
                <label>Search All Products</label>
                <input type="text" class="form-control " id="filter" onkeyup=""
                       placeholder="Enter keyword">
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg">
            <div class="row" id="results">
                <?php
                foreach ($products as $row) {
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4 results">
                        <div class="card bg-white p-0">
                            <img src="<?=base_url($row->image_path)?>" class="img-fluid" style="height: 170px">

                            <div class="card-body align-content-center">
                                <h4 class="card-title" style="max-height: 28px; overflow: hidden; text-overflow: ellipsis;">
                                    <?= $row->productName; ?></h4>
                                <p class="card-text">
                                    Product Code: <?= $row->productCode; ?><br />
                                    Price: <?= $row->sellPrice; ?></li><br />
                                </p>
                                <a href="<?=base_url('Store/newOrder/'.$row->productIdPK.'/'.$row->storeId)?>"
                                   class="btn btn-sm btn-success">Order Now</a>&nbsp;
                                <a href="http://www.facebook.com/share.php?u=http://webdesign021.pk/&amp;
                                title=<?=$row->productName;?>" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fab fa-facebook"></i> Share
                                </a>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>

        </div>
    </div>
    <!--End Members List Table-->
</div>
<!-- Body Content End -->
<script>

    $("#filter").keyup(function() {

        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(),
            count = 0;

        // Loop through the comment list
        $('#results div').each(function() {


            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();

                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }

        });
    });

</script>