<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 28/04/2018
 * Time: 1:48 PM
 */
?>

<!DOCTYPE HTML>
<html lang="zxx">
    
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moviepoint - <?= $this->title; ?></title>
        <!-- Favicon Icon -->
        <link rel="icon" type="image/png" href="<?= IMG; ?>favcion.png" />

        <link rel="stylesheet" href="<?= CSS; ?>font-awesome.css" />
        <link rel="stylesheet" href="<?= CSS; ?>sweetalert.css" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS; ?>bootstrap.min.css" media="all" />
        <!-- Slick nav CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS; ?>slicknav.min.css" media="all" />
        <!-- Iconfont CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS; ?>icofont.css" media="all" />
        <!-- Owl carousel CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS; ?>owl.carousel.css">
        <!-- Popup CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS; ?>magnific-popup.css">
        <!-- Main style CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS; ?>style.css?v=<?= time(); ?>" media="all" />
        <!-- Responsive CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS; ?>responsive.css" media="all" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <!-- Page loader -->
        <div id="preloader"></div>
        <!-- header section start -->
        <header class="header">
            <div class="container">

                <?php if (isset($_SESSION["login_error"])): ?>
                    <div class="offset-md-4 col-md-4 alert alert-danger">
                        <?= $_SESSION["login_error"]; ?>
                    </div>
                <?php unset($_SESSION["login_error"]); endif; ?>

                <?php if (isset($message) && !empty($message)): ?>
                    <div class="offset-md-4 col-md-4 alert alert-success">
                        <?= $message; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION["login_success"])): ?>
                    <div class="offset-md-4 col-md-4 alert alert-success">
                        <?= $_SESSION["login_success"]; ?>
                    </div>
                <?php unset($_SESSION["login_success"]); endif; ?>

                <div class="header-area">
                    <div class="logo">
                        <a href="<?= URL; ?>"><img src="<?= IMG; ?>logo.png" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <ul>
                            <?php if (isset($_SESSION["user"])) { ?>
                                <li><a href="javascript:void(0);">Welcome <?= $this->user->name; ?>!</a></li>
                                <li><a href="<?= URL; ?>user/logout">Logout</a></li>
                            <?php } else { ?>
                                <li><a href="javascript:void(0);">Welcome Guest!</a></li>
                                <li><a class="login-popup" href="#">Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="menu-area">
                        <div class="responsive-menu"></div>
                        <div class="mainmenu">
                            <ul id="primary-menu">
                                <li><a class="<?= empty($_SERVER['QUERY_STRING']) ? 'active' : ''; ?>" href="<?= URL; ?>">Home</a></li>
                                <li><a class="<?= stripos($_SERVER['QUERY_STRING'], 'movie/all') || stripos($_SERVER['QUERY_STRING'], 'movie/detail') ? 'active' : ''; ?>" href="<?= URL; ?>movie/all">Movies</a></li>
                                <li><a class="<?= stripos($_SERVER['QUERY_STRING'], 'celebrity') ? 'active' : ''; ?>" href="<?= URL . 'celebrity'; ?>">CelebritiesList</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="login-area">
            <div class="login-box">
                <a href="#"><i class="icofont icofont-close"></i></a>
                <h2>LOGIN</h2>
                <form action="<?= URL . 'user/login' ?>" method="POST">

                    <?= Security::csrf_token(); ?>

                    <h6>EMAIL ADDRESS</h6>
                    <input type="email" name="email" required="" />
                    <h6>PASSWORD</h6>
                    <input type="password" name="password" required="" />
                    <div class="login-signup">
                        <span>SIGNUP</span>
                    </div>

                    <input type="submit" class="theme-btn" value="LOG IN" style="background: #eb315a;">
                </form>
                
            </div>
        </div>

        <div class="signup-area">
            <div class="login-box">
                <a href="#"><i class="icofont icofont-close"></i></a>
                <h2>SIGN UP</h2>
                <form action="<?= URL . 'user/register' ?>" method="POST">

                    <?= Security::csrf_token(); ?>

                    <h6>Name</h6>
                    <input type="text" name="name" required="" />

                    <h6>Mobile number</h6>
                    <input type="number" name="mobile_number" required="" />

                    <h6>EMAIL ADDRESS</h6>
                    <input type="email" name="email" required="" />

                    <h6>PASSWORD</h6>
                    <input type="password" name="password" required="" />
                    
                    <div class="login-popup login-popup-btn">
                        <span>LOGIN</span>
                    </div>
                    <input type="submit" class="theme-btn" value="SIGN UP" style="background: #eb315a;">
                </form>
                
            </div>
        </div>

        <input id="BASE_URL" style="display: none;" type="hidden" value="<?= URL; ?>">
