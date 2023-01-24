<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Movies Page</h1>

                    <?php if (isset($_SESSION["success"])): ?>
                        <div class="offset-md-4 col-md-4 alert alert-success">
                            <?= $_SESSION["success"]; ?>
                        </div>
                    <?php unset($_SESSION["success"]); endif; ?>

                    <?php if (isset($_SESSION["error"])): ?>
                        <div class="offset-md-4 col-md-4 alert alert-danger">
                            <?= $_SESSION["error"]; ?>
                        </div>
                    <?php unset($_SESSION["error"]); endif; ?>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->

<!-- portfolio section start -->
<section class="portfolio-area pt-60">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-6 text-center text-lg-left">
                <div class="section-title">
                    <h1><i class="icofont icofont-movie"></i> Spotlight of Months</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="portfolio-menu">
                    <ul>
                        <li data-filter=".all" class="active">All</li>
                        <li data-filter=".latest">Latest</li>
                        <li data-filter=".soon">Comming Soon</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-9">
                <div class="row portfolio-item spotlight">

                    <?php
                        foreach ($movies as $movie):
                            $is_comming_soon = false;
                            foreach ($comming_soon as $comming_soon_movie)
                            {
                                if ($comming_soon_movie->id == $movie->movie->id)
                                {
                                    $is_comming_soon = true;
                                    break;
                                }
                            }
                    ?>
                        <div class="col-md-4 col-sm-6 all <?= $is_comming_soon ? 'soon' : 'latest'; ?>">
                            <div class="single-portfolio">
                                <div class="single-portfolio-img">
                                    <?php foreach ($movie->thumbnails as $thumbnail): ?>
                                        <img src="<?= URL . $thumbnail->file_path; ?>" alt="portfolio" />
                                        <?php foreach ($movie->trailers as $trailer): ?>
                                            <video class="mfp-hide" controls src="<?= URL . $trailer->file_path; ?>" id="spotlight-trailer-video-<?= $trailer->id; ?>"></video>
                                            <a href="#spotlight-trailer-video-<?= $trailer->id; ?>" class="popup-youtube">
                                                <i class="icofont icofont-ui-play"></i>
                                            </a>
                                        <?php break; endforeach; ?>
                                    <?php break; endforeach; ?>
                                </div>
                                <div class="portfolio-content">
                                    <h2>
                                        <a href="<?= URL . 'movie/detail/' . $movie->movie->id; ?>">
                                            <?= $movie->movie->name; ?>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
            <div class="col-lg-3 text-center text-lg-left">
                <div class="portfolio-sidebar">
                    <img src="<?= IMG; ?>sidebar/sidebar1.png" alt="sidebar" />
                    <img src="<?= IMG; ?>sidebar/sidebar2.png" alt="sidebar" />
                    <img src="<?= IMG; ?>sidebar/sidebar3.png" alt="sidebar" />
                    <img src="<?= IMG; ?>sidebar/sidebar4.png" alt="sidebar" />
                </div>
            </div>
        </div>
    </div>

    <style>
        .spotlight img {
            width: 255px !important;
            height: 409px !important;
            object-fit: cover;
        }
        .mfp-container video {
            width: 100% !important;
            height: 700px !important;
        }
    </style>

</section><!-- portfolio section end -->

<!-- video section start -->
<section class="video ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title pb-20">
                    <h1><i class="icofont icofont-film"></i> Trailers & Videos</h1>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="video-slider mt-20">

                    <?php foreach ($movies as $movie): ?>
                        <div class="video-area">
                            
                            <?php if (count($movie->thumbnails) > 0): ?>
                                <img src="<?= URL . $movie->thumbnails[0]->file_path; ?>" alt="video" style="height: 300px; object-fit: cover;" />
                            <?php endif; ?>

                            <a href="javascript:void(0);" data-id="<?= $movie->movie->id; ?>" onclick="showTrailer(this);" class="popup-youtube">
                                <i class="icofont icofont-ui-play"></i>
                            </a>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>

    <?php foreach ($movies as $movie): ?>
        <div class="show-trailers movie-trailer-<?= $movie->movie->id; ?>" style="top: 60% !important;">
            <div class="container">
                <div class="buy-ticket-area" style="padding-top: 50px; background: black;">
                    <a href="javascript:void(0);" style="color: white;"><i class="icofont icofont-close" data-id="<?= $movie->movie->id; ?>" onclick="closeTrailer(this);"></i></a>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="movie-trailer-box">
                                <div class="movie-trailer-videos">
                                    <?php
                                        if (count($movie->trailers) > 0):
                                    ?>
                                        <video style="width: 100%; height: 600px;" controls src="<?= URL . $movie->trailers[0]->file_path; ?>"></video>
                                    <?php
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function showTrailer(self) {
            var id = self.getAttribute("data-id");
            $('.movie-trailer-' + id).show();
        }

        function closeTrailer(self) {
            var id = self.getAttribute("data-id");
            $('.movie-trailer-' + id).hide();
            $('.movie-trailer-' + id + ' video').each(function() {
                $(this).get(0).pause();
            });
        }
    </script>

</section><!-- video section end -->