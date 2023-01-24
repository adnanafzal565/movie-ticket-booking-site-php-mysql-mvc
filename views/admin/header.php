<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 29/04/2018
 * Time: 8:08 AM
 */

$admin = $this->get_logged_in_admin();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>Stellar Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>simple-line-icons.css">
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>flag-icon.min.css">
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>daterangepicker.css">
    <link rel="stylesheet" href="<?= CSS; ?>font-awesome.css">
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>chartist.min.css">
    <link rel="stylesheet" href="<?= CSS; ?>sweetalert.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH; ?>datetimepicker/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_PATH; ?>datatable/datatables.css" />

    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_PATH; ?>chartjs/Chart.css">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= ADMIN_CSS; ?>style.css?v=<?= time(); ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= ADMIN_IMG; ?>favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="<?= URL; ?>">
            <img src="<?= ADMIN_IMG; ?>logo.svg" alt="logo" class="logo-dark" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="<?= URL; ?>admin"><img src="<?= ADMIN_IMG; ?>logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome stallar dashboard!</h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">
            
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    
                    <?php if (empty($admin->picture)): ?>
                        <img class="img-xs rounded-circle ml-2" src="<?= ADMIN_IMG; ?>faces/face8.jpg" alt="Profile image">
                    <?php else: ?>
                        <img class="img-xs rounded-circle ml-2 admin-picture" src="<?= URL . $admin->picture; ?>" alt="Profile image">
                    <?php endif; ?>

                    <span class="font-weight-normal"> <?= $admin->name; ?> </span>
                    <i style="margin-left: 10px;" class="fa fa-angle-down"></i>
                </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">

                    <?php if (empty($admin->picture)): ?>
                        <img class="img-md rounded-circle" src="<?= ADMIN_IMG; ?>faces/face8.jpg" alt="Profile image">
                    <?php else: ?>
                        <img class="img-md rounded-circle admin-picture admin-picture-dropdown" src="<?= URL . $admin->picture; ?>" alt="Profile image">
                    <?php endif; ?>
                  
                  <p class="mb-1 mt-3"><?= $admin->name; ?></p>
                  <p class="font-weight-light text-muted mb-0"><?= $admin->email; ?></p>
                </div>

                <a class="dropdown-item" href="<?= URL; ?>admin/profile"><i class="dropdown-item-icon icon-user text-primary"></i>Profile</a>
                <a class="dropdown-item" href="<?= URL; ?>admin/settings"><i class="dropdown-item-icon icon-settings text-primary"></i>Settings</a>
                <a class="dropdown-item" href="<?= URL; ?>admin/logout"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">

                    <?php if (empty($admin->picture)): ?>
                        <img class="img-xs rounded-circle" src="<?= ADMIN_IMG; ?>faces/face8.jpg" alt="Profile image">
                    <?php else: ?>
                        <img class="img-xs rounded-circle admin-picture" src="<?= URL . $admin->picture; ?>" alt="Profile image">
                    <?php endif; ?>
                  
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?= $admin->name; ?></p>
                  <p class="designation"><?= $admin->email; ?></p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">Dashboard</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL; ?>admin">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            
            <li class="nav-item nav-category"><span class="nav-link">Movies</span></li>
            <li class="nav-item"> <a class="nav-link" href="<?= URL; ?>admin/category/"> Categories </a></li>
            <li class="nav-item"> <a class="nav-link" href="<?= URL; ?>admin/cinema/"> Cinemas </a></li>
            <li class="nav-item"> <a class="nav-link" href="<?= URL; ?>admin/movie/add/"> Add Movie </a></li>
            <li class="nav-item"> <a class="nav-link" href="<?= URL; ?>admin/movie/all/"> All Movies </a></li>

            <li class="nav-item nav-category"><span class="nav-link">Celebrities</span></li>
            <li class="nav-item"> <a class="nav-link" href="<?= URL; ?>admin/celebrities/add/"> Add Celebrity </a></li>

            <li class="nav-item"> <a class="nav-link" href="<?= URL; ?>admin/celebrities/all/"> All Celebrities </a></li>

          </ul>
        </nav>

        <input id="BASE_URL" style="display: none;" type="hidden" value="<?= URL; ?>">

        <!-- partial -->
        <div class="main-panel">
