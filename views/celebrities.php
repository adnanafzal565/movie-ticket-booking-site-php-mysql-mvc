<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Celebrities Page</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- transformers area start -->
<section class="transformers-area">
    <div class="container">
        <div class="transformers-box">

            <?php $count = 0; foreach ($celebrities as $celebrity): ?>
                <div class="single-celebrity row flexbox-center <?= $count == 0 ? 'active' : ''; ?>">
                    <div class="col-lg-5 text-lg-left text-center">
                        <div class="transformers-content">
                            <img class="celeb-img" src="<?= URL . $celebrity->picture; ?>" alt="about" />
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="transformers-content mtr-30">
                            <h2 class="celeb-name">
                                <?= $celebrity->name; ?>
                            </h2>
                            <a href="javascript:void(0);" onclick="showBiography(this);" class="theme-btn">Biography</a>
                            <a href="javascript:void(0);" onclick="showFilmography(this);">Filmography</a>
                            <ul class="biography active">
                                <li>
                                    <div class="transformers-left">
                                        Height:
                                    </div>
                                    <div class="transformers-right celeb-height">
                                        <?= $celebrity->height; ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Weight:
                                    </div>
                                    <div class="transformers-right celeb-weight">
                                        <?= $celebrity->weight; ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Eye Color:
                                    </div>
                                    <div class="transformers-right celeb-eye-color">
                                        <?= $celebrity->eye_color; ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Hair Color: 
                                    </div>
                                    <div class="transformers-right celeb-hair-color">
                                        <?= $celebrity->hair_color; ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Birthday:
                                    </div>
                                    <div class="transformers-right celeb-birthday">
                                        <?= date("F d, Y", strtotime($celebrity->birthday)); ?>
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Follow:
                                    </div>
                                    <div class="transformers-right">
                                        <a class="celeb-fb" target="_blank" href="<?= $celebrity->facebook; ?>"><i class="icofont icofont-social-facebook"></i></a>
                                        <a class="celeb-twitter" target="_blank" href="<?= $celebrity->twitter; ?>"><i class="icofont icofont-social-twitter"></i></a>
                                        <a class="celeb-yt" target="_blank" href="<?= $celebrity->youtube; ?>"><i class="icofont icofont-youtube-play"></i></a>
                                    </div>
                                </li>
                            </ul>

                            <ul class="filmography">
                                <?php $count_movies = 1; foreach ($celebrity->movies as $movie): ?>
                                    <li>
                                        <div class="transformers-left">
                                            <?= $count_movies; ?>
                                        </div>
                                        <div class="transformers-right celeb-height">
                                            <a href="<?= URL . 'movie/detail/' . $movie->movie_id; ?>">
                                                <?= $movie->movie_name; ?>
                                            </a>
                                        </div>
                                    </li>
                                <?php $count_movies++; endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php $count++; endforeach; ?>

            <div class="details-thumb">
                <div class="details-thumb-prev" onclick="currentIndex--; showNextPrevious(0);">
                    <div style="display: contents; cursor: pointer;">
                        <div class="thumb-icon">
                            <i class="icofont icofont-simple-left"></i>
                        </div>
                        <div class="thumb-text">
                            <h4>Previous Celebrity</h4>
                            <p id="previous-celebrity-name"></p>
                        </div>
                    </div>
                </div>

                <div class="details-thumb-next" onclick="currentIndex++; showNextPrevious(1);">
                    <div style="display: contents; cursor: pointer;">
                        <div class="thumb-text">
                            <h4>Next Celebrity</h4>
                            <p id="next-celebrity-name"></p>
                        </div>
                        <div class="thumb-icon">
                            <i class="icofont icofont-simple-right"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <input type="hidden" id="hidden-celebrities" value="<?= htmlentities(json_encode($celebrities)); ?>">

    <script>
        var currentIndex = 0;

        var hiddenCelebrities = document.getElementById("hidden-celebrities").value;
        hiddenCelebrities = JSON.parse(hiddenCelebrities);

        window.addEventListener("load", function () {
            showNextPrevious(-1);
        });

        function showNextPrevious(isNext) {
            document.querySelector(".details-thumb-prev").style.visibility = "hidden";
            document.querySelector(".details-thumb-next").style.visibility = "hidden";

            if (isNext == 1) {
                var next = document.querySelector(".single-celebrity.active").nextElementSibling;
                document.querySelector(".single-celebrity.active").className = document.querySelector(".single-celebrity.active").className.replace("active", "");
                next.className += "active";
            } else if (isNext == 0) {
                var next = document.querySelector(".single-celebrity.active").previousElementSibling;
                document.querySelector(".single-celebrity.active").className = document.querySelector(".single-celebrity.active").className.replace("active", "");
                next.className += "active";
            }

            if (hiddenCelebrities[currentIndex + 1] != null) {
                document.querySelector(".details-thumb-next").style.visibility = "visible";
                $("#next-celebrity-name").html(hiddenCelebrities[currentIndex + 1].name);
            }

            if (hiddenCelebrities[currentIndex - 1] != null) {
                document.querySelector(".details-thumb-prev").style.visibility = "visible";
                $("#previous-celebrity-name").html(hiddenCelebrities[currentIndex - 1].name);
            }
        }

        function showFilmography(self) {
            self.className = "theme-btn";
            self.previousElementSibling.className = "";

            self.parentElement.querySelector(".filmography").className = "filmography active";
            self.parentElement.querySelector(".biography").className = self.parentElement.querySelector(".biography").className.replace("active", "");
        }
        function showBiography(self) {
            self.className = "theme-btn";
            self.nextElementSibling.className = "";

            self.parentElement.querySelector(".biography").className = "biography active";
            self.parentElement.querySelector(".filmography").className = self.parentElement.querySelector(".filmography").className.replace("active", "");
        }
    </script>

    <style>
        .single-celebrity {
            display: none;
        }
        .single-celebrity.active {
            display: flex;
        }
        .biography.active,
        .filmography.active {
            display: block;
        }
        .biography,
        .filmography {
            display: none;
        }
    </style>

</section><!-- transformers area end -->