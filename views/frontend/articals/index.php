<main>
    <div class="container-fluid">
        <h1 class="mt-4">My Articals</h1>
        <ol class="breadcrumb mb-4">
            <?php
            if (isset($_SESSION['k'])) {
                $k = $_SESSION['k'];
                echo "<div class='alert alert-success'>$k</div>";
                unset($_SESSION['k']);
            }

            if (isset($_SESSION['errs'])) {
                $errs = $_SESSION['errs'];
                foreach ($errs as $err) {
                    echo "<div class='alert alert-danger'>$err</div>";
                }
                unset($_SESSION['errs']);
            }
            ?>
        </ol>


        <div class="card mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_SESSION['data'])) {
                                $data = $_SESSION['data'];
                                if ($data) {
                                    $counter = 0;
                                    foreach ($data as $artical) {
                                        $counter++;
                                        $id = $artical['id'];
                                        echo "<tr>";
                                        echo "<td>" . $counter . "</td>";
                                        echo "<td>" . $artical['title'] . "</td>";
                                        echo "<td>" . $artical['description'] . "</td>";
                                        echo "<td> <img style='width:200px;max-width:100%;' src='" . $artical['image'] . "'/></td>";
                                        echo "<td>
                                            <form action='articals.php?page=delete&id=$id' method='POST'>
                                                <a href='articals.php?page=edit&id=$id' class='btn btn-primary'>Edit</a>
                                                <input type='submit' class='btn btn-danger' value='Delete'/>
                                            </form> 
                                        </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr class='text-center'><td colspan='6'>NO DATA</td></tr>";
                                }
                                //unset($_SESSION['data']);
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>