<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 29/04/2018
 * Time: 8:08 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stellar Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= ADMIN_VENDOR; ?>css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= ADMIN_CSS; ?>style.css" ><!-- End layout styles -->
    <link rel="shortcut icon" href="<?= ADMIN_IMG; ?>favicon.png" />
  </head>
  <body>

    <input id="BASE_URL" style="display: none;" type="hidden" value="<?= URL; ?>">

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">

                <?php
                    if (!empty($error))
                    {
                        ?>
                        <div class="alert alert-danger">
                            <?= $error; ?>
                        </div>
                        <?php
                    }

                    if (!empty($message))
                    {
                        ?>
                        <div class="alert alert-success">
                            <?= $message; ?>
                        </div>
                        <?php
                    }
                ?>

                <div class="brand-logo">
                  <img src="<?= ADMIN_IMG; ?>logo.svg">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" action="<?= URL; ?>admin/login">
                    <?= Security::csrf_token(); ?>
                  <div class="form-group">
                    <input type="email" value="admin@gmail.com" class="form-control form-control-lg" name="email" id="email" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" value="admin" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                        SIGN IN
                    </button>

                    <br>
                    <p>Email = admin@gmail.com<br>
                    Pass&nbsp; = &nbsp;admin</p>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= ADMIN_VENDOR; ?>js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= ADMIN_JS; ?>off-canvas.js"></script>
    <script src="<?= ADMIN_JS; ?>misc.js"></script>

    <script src="<?= ADMIN_JS; ?>script.js?v=<?= time(); ?>"></script>
    <script src="<?= ADMIN_JS; ?>sweetalert.min.js"></script>
    <!-- endinject -->
  </body>
</html>
