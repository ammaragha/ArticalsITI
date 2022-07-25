<main>
    <div class="container-fluid">
        <h1 class="mt-4">Add new Artical</h1>
        <ol class="breadcrumb mb-4">

            <?php
            echo '<br>';
            if (isset($_SESSION['err'])) {
                $Message = $_SESSION['err'];
                foreach ($Message as $key => $value) {
                    echo '* ' . $key . ' : ' . $value . '<br>';
                }
                unset($_SESSION['err']);
            }
            ?>

        </ol>


        <div class="card mb-4">

            <div class="card-body">

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?page=store" ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputName">title</label>
                        <input type="text" class="form-control" id="exampleInputName" name="title" aria-describedby="" placeholder="Enter title">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Description</label>
                        <input type="text" class="form-control" id="exampleInputName" name="description" aria-describedby="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Content/Body</label>
                        <textarea name="content" id="exampleInputName" class="form-control" cols="30" rows="10"></textarea>
                    </div>


                    


                    <hr>
                    <div class="form-group">
                        <label for="exampleInputName">Image</label>
                        <input type="file" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</main>