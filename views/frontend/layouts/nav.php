<?php

use App\Models\Core\Auth;

?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">ArticalsITI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <?php if (Auth::check()) { ?>
                        <a class="nav-link active" aria-current="page" href="articals.php?page=create">Add artical</a>
                    <?php } ?>
                </li>

                <li class="nav-item">
                    <?php if (Auth::check()) { ?>
                        <a class="nav-link active" aria-current="page" href="articals.php">My articals</a>
                    <?php } ?>
                </li>

            </ul>

            <?php
            //login or not ? 
            if (Auth::check()) { ?>

                <span class="navbar-text username">
                    <span><?= Auth::check()::$user['first_name'] ?></span>
                    <a href="auth.php?page=logout">logout</a>
                </span>
            <?php } else { ?>
                <span class="navbar-text username">
                    <a href="auth.php?page=login">login</a>
                </span>
                /
                <span class="navbar-text username">
                    <a href="auth.php?page=register">register</a>
                </span>
            <?php } ?>
        </div>
    </div>
</nav>