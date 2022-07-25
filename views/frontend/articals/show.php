<?php
$data = $_SESSION['data'];
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <img style="width:100%" src="<?= $data['image'] ?>" alt="">
        </div>
        <div class="col-6   ">
            <h3><?= $data['title'] ?></h3>
            <p>
                <b>Auther:</b> <?= \App\Models\User::getName($data['user_id']) ?>
            </p>
            <p class=" fw-ligther ">
                <b>Created at:</b> <?= $data['created_at'] ?>
            </p>
            <hr>
            <p>
                <b>description:</b> <?= $data['description'] ?>
            </p>
            <p  class="text-break w-100" >
                <b>Content: </b><?= $data['content'] ?>
            </p>
        </div>
    </div>
</div>