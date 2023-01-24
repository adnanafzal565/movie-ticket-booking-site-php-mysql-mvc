<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Edit Movie </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin/movie/all">Movies</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Movie</li>
        </ol>
      </nav>
    </div>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php } ?>

    <?php if (!empty($message)) { ?>
        <div class="alert alert-success"><?= $message; ?></div>
    <?php } ?>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <!-- <h4 class="card-title">Default form</h4> -->
            <!-- <p class="card-description"> Basic form layout </p> -->
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="<?= URL; ?>admin/movie/edit/<?= $movie_id; ?>">

                <?= Security::csrf_token(); ?>
              
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $data->movie->name; ?>" required>
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="7" class="form-control" id="description" name="description" required><?= $data->movie->description; ?></textarea>
              </div>

              <div class="form-group">
                  <label for="categories">Categories</label>
                  <select id="categories" multiple name="categories[]" class="form-control" required>
                      <?php foreach ($categories as $category): ?>
                            <?php
                                $is_exists = false;
                                foreach ($data->categories as $cat)
                                {
                                    if ($cat->id == $category->id)
                                    {
                                        $is_exists = true;
                                        break;
                                    }
                                }
                            ?>
                            <option value="<?= $category->id; ?>" <?= $is_exists ? "selected" : ""; ?>><?= $category->name; ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>

              <div class="form-group">
                  <label for="cinemas">Playing in Cinemas</label>

                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Cinema</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                    <tbody id="cinema-tbody">
                        <?php $cinema_count = 0; foreach ($data->cinemas as $cinema): $cinema_count++; ?>
                            <tr>
                                <td><?= $cinema_count; ?></td>
                                
                                <td>
                                    <select class='form-control' name='cinemas[]'>
                                    <?php for ($a = 0; $a < count($cinemas); $a++) { ?>
                                        <option value="<?= $cinemas[$a]->id; ?>" <?= $cinemas[$a]->id == $cinema->id ? "selected" : ""; ?>><?= $cinemas[$a]->name; ?></option>
                                    <?php } ?>
                                    </select>
                                </td>

                                <td><input class='form-control cinema-time' type='text' autocomplete='off' value="<?= date('Y-m-d H:i', strtotime($cinema->movie_time)); ?>" name='cinema_time[]'></td>

                                <td><i class='fa fa-close' style='cursor: pointer;' onclick='deleteCinemaRow(this);'></i></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <button type="button" onclick="addCinema();" class="btn btn-primary">Add Cinema</button>

                <input type="hidden" id="hidden_cinemas" value="<?= htmlentities(json_encode($cinemas)); ?>">
                <input type="hidden" id="hidden_cinema_count" value="<?= $cinema_count; ?>">
              </div>

              <div class="form-group">
                  <label for="cinemas">Cast</label>

                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Picture</th>
                        <th></th>
                    </tr>
                    <tbody id="cast-tbody">
                        <?php
                            $cast_count = 0;
                            foreach ($data->casts as $cast):
                                $cast_count++;
                        ?>
                            <tr>
                                <td><?= $cast_count; ?></td>
                                
                                <td>
                                    <select class='form-control' name='casts[]' onchange="castSelected(this);">
                                        <option value=''>Select Cast</option>
                                        <?php for ($a = 0; $a < count($casts); $a++) { ?>
                                            <option data-picture="<?= $casts[$a]->picture; ?>" value="<?= $casts[$a]->id; ?>" <?= $casts[$a]->id == $cast->id ? "selected" : ""; ?>><?= $casts[$a]->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <td><img class="celeb-img" src="<?= URL . $cast->picture; ?>"></td>

                                <td><i class='fa fa-close' style='cursor: pointer;' onclick='deleteCastRow(this);'></i></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <button type="button" onclick="addCast();" class="btn btn-primary">Add Cast</button>

                <input type="hidden" id="hidden_casts" value="<?= htmlentities(json_encode($casts)); ?>">
                <input type="hidden" id="hidden_cast_count" value="<?= $cast_count; ?>">
              </div>

              <div class="form-group">
                <label for="thumbnail_input">Thumbnail</label>
                <input type="file" multiple class="form-control" accept="image/*" id="thumbnail_input" name="thumbnail[]" onchange="previewThumbnails(this);">

                <div class="row" id="thumbnails">
                    <?php foreach ($data->thumbnails as $thumbnail): ?>
                        <div class="col-md-4 single-thumbnail">
                            <img src="<?= URL . $thumbnail->file_path; ?>" style="width: 350px; height: 350px; object-fit: cover;">
                            <i class="fa fa-close thumbnail-delete" data-id="<?= $thumbnail->id; ?>" onclick="confirmDeleteThumbnail(this);"></i>
                        </div>
                    <?php endforeach; ?>
                </div>
              </div>

              <div class="form-group">
                <label for="trailers_input">Trailers</label>
                <input type="file" multiple class="form-control" accept="video/*" id="trailers_input" name="trailers[]" onchange="previewTrailers(this);">

                <div class="row" id="trailers">
                    <?php foreach ($data->trailers as $trailer): ?>
                        <div class="col-md-6 single-thumbnail">
                            <video src="<?= URL . htmlentities($trailer->file_path); ?>" style="width: 540px; height: 540px; object-fit: cover;" controls></video>
                            <i class="fa fa-close thumbnail-delete" data-id="<?= $trailer->id; ?>" onclick="confirmDeleteTrailer(this);"></i>
                        </div>
                    <?php endforeach; ?>
                </div>
              </div>

              <div class="form-group">
                <label for="writer">Writer</label>
                <input type="text" value="<?= $data->movie->writer; ?>" class="form-control" id="writer" name="writer" required>
              </div>

              <div class="form-group">
                <label for="director">Director</label>
                <input type="text" value="<?= $data->movie->director; ?>" class="form-control" id="director" name="director" required>
              </div>

              <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" placeholder="1h35m" value="<?= $data->movie->duration; ?>" required>
              </div>

              <div class="form-group">
                <label for="release_date">Release Date</label>
                <input type="text" class="form-control" id="release_date" name="release_date" autocomplete="off" value="<?= date('Y-m-d', strtotime($data->movie->release_date)); ?>" required>
              </div>

              <div class="form-group">
                <label for="languages">Languages</label>
                <input type="text" class="form-control" id="languages" name="languages" placeholder="English, Urdu" value="<?= $data->movie->languages; ?>" required>
              </div>

              <div class="form-group">
                <label for="price_per_ticket">Price per ticket</label>
                <input type="number" class="form-control" id="price_per_ticket" name="price_per_ticket" value="<?= $data->movie->price_per_ticket; ?>" required>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <!-- content-wrapper ends -->

  <style>
      .thumbnail-delete {
        float: right;
        position: relative;
        right: 27px;
        top: 5px;
        color: black;
        background: lightgray;
        height: fit-content;
        padding: 5px;
        border-radius: 50%;
        cursor: pointer;
      }
      .single-thumbnail {
        margin-top: 15px;
        display: flex;
      }
  </style>

  <script type="text/javascript">
    function confirmDeleteThumbnail(self) {
        var thumbnailId = self.getAttribute("data-id");
        swal({
          title: "Confirm Delete ?",
          text: "Are you sure you want to delete this ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = BASE_URL + "admin/delete_thumbnail/" + thumbnailId;
          }
        });
        return false;
      }

      function confirmDeleteTrailer(self) {
        var trailerId = self.getAttribute("data-id");
        swal({
          title: "Confirm Delete ?",
          text: "Are you sure you want to delete this ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = BASE_URL + "admin/delete_trailer/" + trailerId;
          }
        });
        return false;
      }

    function initializeCinemaTimeDatetimePicker() {
        $(".cinema-time").datetimepicker({
            "scrollMonth": false,
            "format": "Y-m-d H:i",
            "step": 15
        });
    }

    var cinemas = 0;
    var casts = 0;

    window.addEventListener("load", function () {
        cinemas = document.getElementById("hidden_cinema_count").value;
        casts = document.getElementById("hidden_cast_count").value;

        initializeCinemaTimeDatetimePicker();

        $("#release_date").datetimepicker({
            "timepicker": false,
            "scrollMonth": false,
            "format": "Y-m-d",
            "closeOnDateSelect": true
        });
    });

    function addCinema() {
        var allCinemas = document.getElementById("hidden_cinemas").value;
        allCinemas = JSON.parse(allCinemas);
        cinemas++;
 
        var html = "<tr>";
            html += "<td>" + cinemas + "</td>";
            
            html += "<td>";
                html += "<select class='form-control' name='cinemas[]'>";
                for (var a = 0; a < allCinemas.length; a++) {
                    html += "<option value='" + allCinemas[a].id + "'>" + allCinemas[a].name + "</option>";
                }
                html += "</select>";
            html += "</td>";

            html += "<td><input class='form-control cinema-time' type='text' autocomplete='off' name='cinema_time[]'></td>";

            html += "<td><i class='fa fa-close' style='cursor: pointer;' onclick='deleteCinemaRow(this);'></i></td>";
        html += "</tr>";
 
        var row = document.getElementById("cinema-tbody").insertRow();
        row.innerHTML = html;

        initializeCinemaTimeDatetimePicker();
    }

    function addCast() {
        var allCasts = document.getElementById("hidden_casts").value;
        allCasts = JSON.parse(allCasts);
        casts++;
 
        var html = "<tr>";
            html += "<td>" + casts + "</td>";
            
            html += "<td>";
                html += "<select class='form-control' name='casts[]' onchange='castSelected(this);'>";
                html += "<option value=''>Select Cast</option>";
                for (var a = 0; a < allCasts.length; a++) {
                    html += "<option data-picture='" + allCasts[a].picture + "' value='" + allCasts[a].id + "'>";
                        html += allCasts[a].name;
                    html += "</option>";
                }
                html += "</select>";
            html += "</td>";

            html += "<td>";
                html += "<img class='celeb-img' style='width: 100px;' src='" + BASE_URL + "public/img/user-placeholder.png'>";
            html += "</td>";

            html += "<td><i class='fa fa-close' style='cursor: pointer;' onclick='deleteCastRow(this);'></i></td>";
        html += "</tr>";
 
        var row = document.getElementById("cast-tbody").insertRow();
        row.innerHTML = html;
    }

    function castSelected(self) {
        if (self.value == "") {
            self.parentElement.nextElementSibling.querySelector("img").setAttribute("src", BASE_URL + "public/img/user-placeholder.png");
        } else {
            var picture = self.options[self.selectedIndex].getAttribute("data-picture");
            self.parentElement.nextElementSibling.querySelector("img").setAttribute("src", BASE_URL + picture);
        }
    }

    function previewThumbnails(self) {
        for (var a = 0; a < self.files.length; a++) {
            var fileReader = new FileReader();
 
            fileReader.onload = function (event) {
                var html = "";
                html += '<div class="col-md-4 single-thumbnail">';
                    html += '<img src="' + event.target.result + '" style="width: 350px; height: 350px; object-fit: cover;">';
                html += '</div>';

                document.getElementById("thumbnails").innerHTML += html;
            };
 
            fileReader.readAsDataURL(self.files[a]);
        }
    }

    function previewTrailers(self) {
        for (var a = 0; a < self.files.length; a++) {

            var blobURL = URL.createObjectURL(self.files[a]);
            var html = "";
            html += '<div class="col-md-6 single-thumbnail">';
                html += '<video src="' + blobURL + '" style="width: 540px; height: 540px; object-fit: cover;" controls></video>';
            html += '</div>';

            document.getElementById("trailers").innerHTML += html;
        }
    }

  </script>