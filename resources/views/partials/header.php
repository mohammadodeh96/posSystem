<?php

use Core\Helpers\Helper; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Of Sales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kodchasan:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/css/styles.css">
</head>

<body class="admin-view">

    <nav class="navbar bg-white navbar-expand-lg border-bottom border-warning">
        <div class="container-fluid">

            <div class="py-2 border-right border-warning" id="main-container">
                <a id="main-text" class="navbar-brand" href="/dashboard"> <span id="main-icon" class="material-symbols-outlined">
                        point_of_sale
                    </span>P<span class="material-symbols-outlined fs-4">
                        sentiment_satisfied
                    </span>S System</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            $current_page = explode("/", $_SERVER['REQUEST_URI']);
            $current_page = $current_page[1];
            ?>
            <?php if ($current_page == 'login') {
            } else { ?>
                <div class="collapse navbar-collapse active" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <?php if (Helper::check_permission(['item:read', 'transaction:create'])) : ?>
                            <li class="nav-item ms-5 fs-5">

                                <a class="nav-link d-lg-none" href="/selling-dashboard"> Selling Dashborad</a>
                            </li>
                        <?php endif;
                        if (Helper::check_permission(['transaction:read'])) : ?>
                            <li class="nav-item ms-5 fs-5">
                                <a class="nav-link d-lg-none" href="/transactions">Transactions Manegment</a>
                            </li>
                        <?php endif;
                        if (Helper::check_permission(["item:read", "item:create", "item:update", "item:delete"])) : ?>
                            <li class="nav-item ms-5 fs-5">
                                <a class="nav-link d-lg-none" href="/items">Stock Manegment</a>
                            </li>
                        <?php endif;
                        if (Helper::check_permission(['user:read'])) : ?>
                            <li class="nav-item ms-5 fs-5">
                                <a class="nav-link d-lg-none" href="/users">Users Manegment</a>
                            </li>
                            
                        <?php endif; ?>
                        <li class="nav-item ms-5 fs-5 d-lg-none">
                                <a class="nav-link d-lg-none" href="/user?id=<?= $get_user['user_id'] ?>">Profile</a>
                            </li>
                        <li class="nav-item ms-5 fs-5 d-lg-none">
                            <a class="nav-link d-lg-none" href="/logout">Logout</a>
                        </li>
                        <?php
                        $get_user = ($_SESSION['user']);
                        $username = $get_user['username'];
                        $avatar = $get_user['profile_picture'];
                        ?>


                    </ul>
                    <div class="bg-light border border-warning rounded-5 d-none d-lg-block">
                        <?php if (Helper::check_login()) : ?>
                            <ul class="navbar-nav mb-2 ms-3">
                                <li class="nav-item dropdown me-4">
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle d-flex align-items-center mt-2 bg-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                                            <?php if ($avatar != null) { ?>
                                                <img src="../../../resources/assets/<?= $avatar ?>" class="rounded-circle" height="30" width="30" alt="" loading="lazy" />
                                            <?php } else { ?>
                                                <img src="../../../resources/assets/avatar.png" class="rounded-circle" height="30" width="30" alt="" loading="lazy" />
                                            <?php } ?>
                                            <span class="mx-2 fs-5">
                                                <?php
                                                echo $username;
                                                ?>
                                            </span>
                                        </a>

                                        <ul id="dropdown-menu" class="dropdown-menu me-5" aria-labelledby="dropdownMenuButton1">
                                            <li class="fs-6"><a class="dropdown-item" href="/logout">Logout</a></li>
                                            <li class="fs-6"><a class="dropdown-item" href="/user?id=<?= $get_user['user_id'] ?>">Profile</a></li>

                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        <?php endif; ?>
                    </div>



                </div>
            <?php } ?>
        </div>
        <?php
        $current_page = explode("/", $_SERVER['REQUEST_URI']);
        $current_page = $current_page[1];
        ?>
    </nav>
    <?php if (Helper::check_login()) : ?>
        <div id="admin-area d-md-block" class="row">
            <div id="sidebar-full" class="col-2 admin-links d-none d-lg-block border-right border-warning">
                <div class="my-5"></div>
                <ul class="list-group list-group-flush mt-3">

                        <li class="list-group-item <?php if ($current_page == 'dashboard') echo 'active' ?>">
                            <div class="border border-warning px-2 py-1 rounded-4 bg-light">
                                <a id="sidebar-text-link" href="/dashboard"><span class="material-symbols-outlined pull-left me-2 bg-light ">
                                        dashboard
                                    </span>Main Dashborad</a>
                            </div>
                        </li>
                        <hr class="py-3 ms-2">

                    <?php if (Helper::check_permission(['item:read', 'transaction:create'])) : ?>
                        <li class="list-group-item <?php if ($current_page == 'selling-dashboard') echo 'active' ?>">
                            <div class="border border-warning px-2 py-1 rounded-4 bg-light">
                                <a id="sidebar-text-link" href="/selling-dashboard"><span class="material-symbols-outlined pull-left me-2 bg-light ">
                                        payments
                                    </span> Selling Dashborad</a>
                            </div>
                        </li>
                    <?php endif;

                    if (Helper::check_permission(['transaction:read'])) : ?>

                        <li class="list-group-item <?php if ($current_page == 'transactions') echo 'active' ?>">
                            <div class="border border-warning px-2 py-1 rounded-4 bg-light">
                                <a id="sidebar-text-link" href="/transactions"><span class="material-symbols-outlined pull-left me-2 bg-light">
                                        receipt_long
                                    </span>Transactions </a>
                            </div>
                        </li>

                    <?php endif;
                    if (Helper::check_permission(["item:create", "item:update", "item:delete"])) :
                    ?>
                        <li class="list-group-item <?php if ($current_page == 'items') echo 'active' ?>">
                            <div class="border border-warning px-2 py-1 rounded-4 bg-light">
                                <a id="sidebar-text-link" href="/items"><span class="material-symbols-outlined pull-left me-2 bg-light">
                                        category
                                    </span>Stock Manegment</a>
                            </div>
                        </li>
                    <?php endif;
                    if (Helper::check_permission(['user:read'])) :
                    ?>
                        <li class="list-group-item <?php if ($current_page == 'users') echo 'active' ?>">
                            <div class="border border-warning px-2 py-1 rounded-4 bg-light">
                                <a id="sidebar-text-link" href="/users"><span class="material-symbols-outlined pull-left me-2 bg-light">
                                        group
                                    </span>Users Manegment</a>
                            </div>
                        </li>
                    <?php endif;
                    ?>

                </ul>

            </div>
            <div class="col-10 admin-area-content">
                <div class="container my-5">
                <?php endif; ?>