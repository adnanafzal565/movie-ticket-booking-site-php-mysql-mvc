<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Movie Detailed Page</h1>

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

<!-- transformers area start -->
<section class="transformers-area">
    <div class="container">
        <div class="transformers-box">
            <div class="row flexbox-center">
                <div class="col-lg-5 text-lg-left text-center">
                    <div class="movie-thumbnails transformers-content">
                        <?php $count = 0; foreach ($movie->thumbnails as $thumbnail): ?>
                            <img style="width: 100%;" class="<?= $count == 0 ? 'active' : ''; ?>" src="<?= URL . $thumbnail->file_path; ?>" alt="about" />
                        <?php $count++; endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="transformers-content">
                        <h2><?= $movie->movie->name; ?></h2>
                        
                        <p>
                            <?php
                                $count = 0;
                                $last_category = "";
                                foreach ($movie->categories as $category):
                                    echo $category->name . ($count == count($movie->categories) - 1 ? "" : " | ");
                                    $count++;
                                    $last_category = $category->name;
                                endforeach;
                            ?>
                        </p>

                        <div id="movie-rating" data-rating="<?= $ratings; ?>"></div>

                        <ul>
                            <li>
                                <div class="transformers-left">
                                    Movie:
                                </div>
                                <div class="transformers-right">
                                    <?= $last_category; ?>
                                </div>
                            </li>

                            <li>
                                <div class="transformers-left">
                                    Cast:
                                </div>
                                <div class="transformers-right">
                                    <?php
                                        $count = 0;
                                        foreach ($movie->casts as $cast)
                                        {
                                            ?>

                                            <a href="<?= URL . 'celebrity/detail/' . $cast->cast_id; ?>">
                                                <?= $cast->celebrity_name; ?>
                                            </a>

                                            <?php
                                            $count++;

                                            if ($count < count($movie->casts))
                                            {
                                                echo ", ";
                                            }
                                        }
                                    ?>
                                </div>
                            </li>

                            <li>
                                <div class="transformers-left">
                                    Writer:
                                </div>
                                <div class="transformers-right">
                                    <?= $movie->movie->writer; ?>
                                </div>
                            </li>
                            <li>
                                <div class="transformers-left">
                                    Director:
                                </div>
                                <div class="transformers-right">
                                    <?= $movie->movie->director; ?>
                                </div>
                            </li>

                            <li>
                                <div class="transformers-left">
                                    Time: 
                                </div>
                                <div class="transformers-right">
                                    <?= $movie->movie->duration; ?>
                                </div>
                            </li>
                            <li>
                                <div class="transformers-left">
                                    Release:
                                </div>
                                <div class="transformers-right">
                                    <?= date("Y-m-d", strtotime($movie->movie->release_date)); ?>
                                </div>
                            </li>
                            <li>
                                <div class="transformers-left">
                                    Language:
                                </div>
                                <div class="transformers-right">
                                    <?= $movie->movie->languages; ?>
                                </div>
                            </li>
                            <li>
                                <div class="transformers-left">
                                    Cinema:
                                </div>
                                <div class="transformers-right" style="width: 100%;">

                                    <div class="row">
                                        <?php $count = 0; foreach ($movie->cinemas as $cinema): ?>
                                            <div class="col-md-3 transformers-bottom">
                                                <?= $cinema->name; ?> <br>
                                                <p>
                                                    <?= date("M d, Y", strtotime($cinema->movie_time)); ?>
                                                    <span><?= date("h:i A", strtotime($cinema->movie_time)); ?></span>
                                                </p>
                                            </div>
                                        <?php $count++; endforeach; ?>
                                    </div>
                                    
                                </div>
                            </li>
                            <li>
                                <div class="transformers-left">
                                    Share:
                                </div>
                                <div class="transformers-right">
                                    <a href="javascript:void(0);" onclick="shareOnFacebook();"><i class="icofont icofont-social-facebook"></i></a>
                                    
                                    <a target="_blank" href="http://twitter.com/share?text=<?= $movie->movie->name; ?>&url=<?= URL . 'movie/detail/' . $movie->movie->id; ?>&hashtags=<?= str_replace(" ", "_", $movie->movie->name); ?>"><i class="icofont icofont-social-twitter"></i></a>

                                    <a target="_blank" href="https://youtube.com/c/AdnanAfzal565"><i class="icofont icofont-youtube-play"></i></a>
                                </div>
                            </li>

                            <li>
                                <h3 style="cursor: pointer;" onclick="$('.show-trailers').show();">Watch Trailer</h3>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="offset-md-2 movie-thumbnail-indicators">
                    <?php $count = 0; foreach ($movie->thumbnails as $thumbnail): ?>
                        <div onclick="gotoThumbnail(this);" data-id="<?= $movie->movie->id; ?>" data-index="<?= $count; ?>" class="owl-dot <?= $count == 0 ? 'active' : ''; ?>"></div>
                    <?php $count++; endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="show-trailers" style="top: 20%;">
        <div class="container">
            <div class="buy-ticket-area" style="padding-top: 50px; background: black;">
                <a href="javascript:void(0);" style="color: white;" onclick="closeTrailers();"><i class="icofont icofont-close"></i></a>
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
                                    <div onclick="gotoTrailer(this);" data-index="<?= $count; ?>" class="owl-dot <?= $count == 0 ? 'active' : ''; ?>"></div>
                                <?php $count++; endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        function closeTrailers() {
            $('.show-trailers').hide();
            $('.show-trailers video').each(function() {
                $(this).get(0).pause();
            });
        }

        function gotoTrailer(self) {
            var index = self.getAttribute("data-index");

            var movieTrailerVideos = document.querySelector(".show-trailers .movie-trailer-videos").children;
            if (movieTrailerVideos.length > index) {
                for (var a = 0; a < movieTrailerVideos.length; a++) {
                    movieTrailerVideos[a].className = "";
                }
                movieTrailerVideos[index].className = "active";
            }

            var movieTrailerIndicators = document.querySelector(".show-trailers .movie-trailer-indicators").children;
            for (var a = 0; a < movieTrailerIndicators.length; a++) {
                movieTrailerIndicators[a].className = "owl-dot";
            }
            self.className = "owl-dot active";
        }

        function gotoThumbnail(self) {
            var index = self.getAttribute("data-index");
            var id = self.getAttribute("data-id");

            var movieThumbnails = document.querySelector(".movie-thumbnails").children;
            if (movieThumbnails.length > index) {
                for (var a = 0; a < movieThumbnails.length; a++) {
                    movieThumbnails[a].className = "";
                }
                movieThumbnails[index].className = "active";
            }

            var movieThumbnailIndicators = document.querySelector(".movie-thumbnail-indicators").children;
            for (var a = 0; a < movieThumbnailIndicators.length; a++) {
                movieThumbnailIndicators[a].className = "owl-dot";
            }
            self.className = "owl-dot active";
        }
    </script>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : 'your_fb_app_id',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v8.0'
            });
        };

        function shareOnFacebook() {
            FB.ui({
                method: 'share',
                href: window.location.href,
            }, function(response){});
        }
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

</section><!-- transformers area end -->

<!-- details area start -->
<section class="details-area" id="section-comments">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="details-content">
                    <div class="details-overview">
                        <h2>Overview</h2>
                        <p><?= $movie->movie->description; ?></p>
                    </div>

                    <div class="details-thumb">

                        <div class="details-thumb-prev">
                            <?php if ($previous_movie != null): ?>
                                <div onclick="window.location.href = this.getAttribute('data-href');" data-href="<?= URL . 'movie/detail/' . $previous_movie->id; ?>" style="display: contents; cursor: pointer;">
                                    <div class="thumb-icon">
                                        <i class="icofont icofont-simple-left"></i>
                                    </div>
                                    <div class="thumb-text">
                                        <h4>Previous Movie</h4>
                                        <p><?= $previous_movie->name; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="details-thumb-next">
                            <?php if ($next_movie != null): ?>
                                <div onclick="window.location.href = this.getAttribute('data-href');" data-href="<?= URL . 'movie/detail/' . $next_movie->id; ?>" style="display: contents; cursor: pointer;">
                                    <div class="thumb-text">

                                        <h4>Next Movie</h4>
                                        <p>
                                            <?= $next_movie->name; ?>
                                        </p>
                                    </div>
                                    <div class="thumb-icon">
                                        <i class="icofont icofont-simple-right"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-center text-lg-left">
                <div class="portfolio-sidebar">
                    <img src="<?= IMG; ?>sidebar/sidebar1.png" alt="sidebar" />
                    <img src="<?= IMG; ?>sidebar/sidebar2.png" alt="sidebar" />
                    <img src="<?= IMG; ?>sidebar/sidebar4.png" alt="sidebar" />
                </div>
            </div>
        </div>
    </div>
</section><!-- details area end -->

<input type="hidden" id="hidden_cinemas" value="<?= htmlentities(json_encode($cinemas)); ?>">

<script>
    function onCinemaSelected(self) {
        var html = "";
        if (self.value != "") {
            var hiddenCinemas = JSON.parse(document.getElementById("hidden_cinemas").value);
            for (var a = 0; a < hiddenCinemas.length; a++) {
                if (hiddenCinemas[a].id == self.value) {
                    for (var b = 0; b < hiddenCinemas[a].times.length; b++) {
                        html += "<option value='" + hiddenCinemas[a].times[b] + "'>" + hiddenCinemas[a].times[b] + "</option>";
                    }
                }
            }
        }
        document.getElementById("selected_time").innerHTML = html;
    }
</script>