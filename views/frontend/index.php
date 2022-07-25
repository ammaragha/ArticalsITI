
    <div class="products text-center">
        <div class="row gapping">

            <?php if (isset($_SESSION['data'])) {
                $data = $_SESSION['data'];
                if (!$data) echo "<div class='alert alert-info'>NO DATA</div>";
                else {
                    foreach ($data as $product) {
            ?>
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                            <div class="card productHolder">
                                <img class="card-img-top productimg" src="<?= $product['image'] ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['name'] . '(' . \App\Models\Category::getName($product['cat_id']) . ')'; ?></h5>
                                    <p class="card-text"><span>price:</span>
                                        <span> <?= $product['price'] ?> </span> <span>LE</span>
                                    </p>

                                </div>
                            </div>
                        </div>
            <?php } //end foreach
                } //end else
            } //end if 
            ?>

        </div>
    </div>

</div>