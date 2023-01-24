<section class="hero-area" id="home">
    <div class="container">

        <div class="hero-area-slider">
            <?php
                foreach ($movies as $movie):
            ?>

                <div class="row hero-area-slide">
                    <div class="col-lg-6 col-md-5 movie-thumbnail-<?= $movie->movie->id; ?>">
                        <div class="movie-thumbnails hero-area-content">
                            <?php $count = 0; foreach ($movie->thumbnails as $thumbnail): ?>
                                <img class="<?= $count == 0 ? 'active' : ''; ?>" src="<?= URL . $thumbnail->file_path; ?>" alt="about" />
                            <?php $count++; endforeach; ?>
                        </div>

                        <div class="offset-md-5 movie-thumbnail-indicators">
                            <?php $count = 0; foreach ($movie->thumbnails as $thumbnail): ?>
                                <div onclick="gotoThumbnail(this);" data-id="<?= $movie->movie->id; ?>" data-index="<?= $count; ?>" class="owl-dot <?= $count == 0 ? 'active' : ''; ?>"></div>
                            <?php $count++; endforeach; ?>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-7">
                        <div class="hero-area-content pr-50">
                            <h2>
                                <a href="<?= URL . 'movie/detail/' . $movie->movie->id; ?>">
                                    <?= $movie->movie->name; ?>
                                </a>
                            </h2>
                            
                            <p><?= substr($movie->movie->description, 0, 100); ?></p>
                            
                            <div class="slide-trailor">
                                <h3 data-id="<?= $movie->movie->id; ?>" onclick="showTrailers(this);" style="cursor: pointer;">Watch Trailer</h3>
                            </div>
                        </div>
                    </div>

                    <div class="show-trailers movie-trailer-<?= $movie->movie->id; ?>" style="top: 50px !important;">
                        <div class="container">
                            <div class="buy-ticket-area" style="padding-top: 50px; background: black;">
                                <a href="javascript:void(0);" style="color: white;"><i class="icofont icofont-close" data-id="<?= $movie->movie->id; ?>" onclick="closeTrailers(this);"></i></a>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="movie-trailer-box">
                                            
                                            <div class="movie-trailer-videos">
                                                <?php $count = 0; foreach ($movie->trailers as $trailer): ?>
                                                    <video class="<?= $count == 0 ? 'active' : ''; ?>" style="width: 100%; height: 400px;" controls src="<?= URL . $trailer->file_path; ?>"></video>
                                                <?php $count++; endforeach; ?>
                                            </div>

                                            <div class="offset-md-5 movie-trailer-indicators">
                                                <?php $count = 0; foreach ($movie->trailers as $trailer): ?>
                                                    <div onclick="gotoTrailer(this);" data-id="<?= $movie->movie->id; ?>" data-index="<?= $count; ?>" class="owl-dot <?= $count == 0 ? 'active' : ''; ?>"></div>
                                                <?php $count++; endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <?php if (count($movies) > 1) { ?>

            <div class="hero-area-thumb">

                <?php
                    $movie = $movies[1];
                ?>

                <div class="thumb-next">
                    <div class="row hero-area-slide">
                        <div class="col-lg-6">
                            <div class="movie-thumbnails hero-area-content">
                                <?php $count = 0; foreach ($movie->thumbnails as $thumbnail): ?>
                                    <img class="<?= $count == 0 ? 'active' : ''; ?>" src="<?= URL . $thumbnail->file_path; ?>" alt="about" />
                                <?php $count++; endforeach; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-area-content pr-50">
                                <h2><?= $movie->movie->name; ?></h2>
                                
                                <p><?= $movie->movie->description; ?></p>
                                <div class="slide-trailor">
                                    <h3>Watch Trailer</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if (count($movies) > 2) {
                        $movie = $movies[2];
                    }
                ?>

                <div class="thumb-prev">
                    <div class="row hero-area-slide">
                        <div class="col-lg-6">
                            <div class="movie-thumbnails hero-area-content">
                                <?php $count = 0; foreach ($movie->thumbnails as $thumbnail): ?>
                                    <img class="<?= $count == 0 ? 'active' : ''; ?>" src="<?= URL . $thumbnail->file_path; ?>" alt="about" />
                                <?php $count++; endforeach; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero-area-content pr-50">
                                <h2><?= $movie->movie->name; ?></h2>
                                
                                <p><?= $movie->movie->description; ?></p>
                                <div class="slide-trailor">
                                    <h3>Watch Trailer</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php } ?>

        <style>
            .movie-trailer-box video.active {
                display: block !important;
            }

            .movie-thumbnails img,
            .movie-trailer-box video {
                display: none !important;
            }
            .movie-thumbnails img.active {
                display: block !important;
                height: 500px;
                object-fit: cover;
            }
            .movie-thumbnail-indicators {
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .movie-thumbnail-indicators div,
            .movie-trailer-indicators div {
                cursor: pointer;
            }
        </style>

        <script>

            function gotoTrailer(self) {
                var index = self.getAttribute("data-index");
                var id = self.getAttribute("data-id");

                var movieTrailerVideos = document.querySelector(".movie-trailer-" + id + " .movie-trailer-videos").children;
                if (movieTrailerVideos.length > index) {
                    for (var a = 0; a < movieTrailerVideos.length; a++) {
                        movieTrailerVideos[a].className = "";
                    }
                    movieTrailerVideos[index].className = "active";
                }

                var movieTrailerIndicators = document.querySelector(".movie-trailer-" + id + " .movie-trailer-indicators").children;
                for (var a = 0; a < movieTrailerIndicators.length; a++) {
                    movieTrailerIndicators[a].className = "owl-dot";
                }
                self.className = "owl-dot active";
            }

            function gotoThumbnail(self) {
                var index = self.getAttribute("data-index");
                var id = self.getAttribute("data-id");

                var movieThumbnails = document.querySelector(".movie-thumbnail-" + id + " .movie-thumbnails").children;
                if (movieThumbnails.length > index) {
                    for (var a = 0; a < movieThumbnails.length; a++) {
                        movieThumbnails[a].className = "";
                    }
                    movieThumbnails[index].className = "active";
                }

                var movieThumbnailIndicators = document.querySelector(".movie-thumbnail-" + id + " .movie-thumbnail-indicators").children;
                for (var a = 0; a < movieThumbnailIndicators.length; a++) {
                    movieThumbnailIndicators[a].className = "owl-dot";
                }
                self.className = "owl-dot active";
            }

            function showTrailers(self) {
                var id = self.getAttribute("data-id");
                $('.movie-trailer-' + id).show();
            }

            function closeTrailers(self) {
                var id = self.getAttribute("data-id");
                $('.movie-trailer-' + id).hide();
                $('.movie-trailer-' + id + ' video').each(function() {
                    $(this).get(0).pause();
                });
            }
        </script>

    </div>
</section><!-- hero area end-->

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
            <div class="col-md-9">
                <div class="video-area">

                    <?php
                        if (count($movies) > 0):

                            if (count($movies[0]->thumbnails) > 0):
                    ?>

                            <img src="<?= URL . $movies[0]->thumbnails[0]->file_path; ?>" class="movie-thumbnail-trailers" alt="video" />

                        <?php
                            endif;

                            if (count($movies[0]->trailers) > 0):
                        ?>

                            <video class="mfp-hide" controls src="<?= URL . $movies[0]->trailers[0]->file_path; ?>" id="trailer-and-video-<?= $movies[0]->trailers[0]->id; ?>"></video>
                            <a href="#trailer-and-video-<?= $movies[0]->trailers[0]->id; ?>" class="popup-youtube">
                                <i class="icofont icofont-ui-play"></i>
                            </a>

                        <?php endif; ?>

                        <div class="video-text">
                            <h2>
                                <a href="<?= URL . 'movie/detail/' . $movies[0]->movie->id; ?>">
                                    <?= $movies[0]->movie->name; ?>
                                </a>
                            </h2>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="row">

                    <?php

                        for ($a = 1; $a < count($movies); $a++):

                            if ($a == 4)
                            {
                                break;
                            }

                            ?>

                            <div class="col-md-12 col-sm-6">
                                <div class="video-area">

                            <?php

                            if (count($movies[$a]->thumbnails) > 0):
                    ?>

                            <img style="width: 100%; height: 200px; object-fit: cover;" src="<?= URL . $movies[$a]->thumbnails[0]->file_path; ?>" alt="video" />

                        <?php
                            endif;

                            if (count($movies[$a]->trailers) > 0):
                        ?>

                            <video class="mfp-hide" controls src="<?= URL . $movies[$a]->trailers[0]->file_path; ?>" id="trailer-and-video-<?= $movies[$a]->trailers[0]->id; ?>"></video>
                            <a href="#trailer-and-video-<?= $movies[$a]->trailers[0]->id; ?>" class="popup-youtube">
                                <i class="icofont icofont-ui-play"></i>
                            </a>

                            <div class="video-text">
                                <h4>
                                    <a href="<?= URL . 'movie/detail/' . $movies[$a]->movie->id; ?>">
                                        <?= $movies[$a]->movie->name; ?>
                                    </a>
                                </h4>
                            </div>

                        <?php endif; ?>

                            </div>
                        </div>

                    <?php endfor; ?>
                    
                </div>
            </div>
        </div>
    </div>
</section><!-- video section end -->