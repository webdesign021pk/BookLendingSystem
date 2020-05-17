<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-4">
        <div class="col-lg-10 col-md-8 col-sm-8">
            <h3><i class="fas fa-boxes"></i> All Products</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 bg-white p-4 shadow-sm">
            <div class="row" id="results">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 ">
                    <img src="<?=base_url($article->image_path)?>" class="img-fluid d-block-mx-auto" style="">
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <h4 class="card-title" style="max-height: 28px; overflow: hidden; text-overflow: ellipsis;">
                        Product: <?= $article->articleName; ?></h4>
                    <p class="card-text">
                        Article# <?= $article->articleNo; ?><br />
                        Price: <?= $article->sellPrice; ?></li><br />
                        Seller's Name: <?= $article->sellerName; ?><br />
                    </p>
                    <a href="<?=base_url('Catalogue/Products/newOrder/'.$article->articleIdPK)?>"
                       class="btn btn-primary">Catalogue Now</a>
                    <br/>
                    <a href="http://www.facebook.com/share.php?u=http://webdesign021.pk/&amp;
                                title=<?=$article->articleName;?>" target="_blank">Share on Facebook</a>
                </div>

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