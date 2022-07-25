<div class="container">
    <div class="row gapping">

        <?php if (isset($_SESSION['data'])) {
            $data = $_SESSION['data'];
            if (!$data) echo "<div class='alert alert-info'>NO DATA</div>";
            else {
                foreach ($data as $artical) {
                    $id = $artical['id'];
        ?>
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                        <a href="<?= "index.php?page=viewArtical&id=$id" ?>" class="text-black">
                            <div class="card text-start ">
                                <img class="card-img-top productimg" src="<?= $artical['image'] ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $artical['title'] ?></h5>
                                    <p class="card-text ">
                                        <?= $artical['description'] ?>
                                    </p>
                                    <p class="card-text">
                                        Auther: <?= \App\Models\User::getName($artical['user_id']) ?>
                                    </p>
                                    <span class="fw-lighter">
                                        <?= $artical['created_at'] ?>
                                    </span>

                                </div>
                            </div>
                        </a>

                    </div>
        <?php } //end foreach
            } //end else
        } //end if 
        ?>

    </div>
</div>

</div>