<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Add Movie </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Movie</li>
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
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="<?= URL; ?>admin/movie/add">

                <?= Security::csrf_token(); ?>
              
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($input['name']) ? $input['name'] : ''; ?>" required>
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="7" class="form-control" id="description" name="description" required><?= isset($input['description']) ? $input['description'] : ''; ?></textarea>
              </div>

              <div class="form-group">
                  <label for="categories">Categories</label>
                  <select id="categories" multiple name="categories[]" class="form-control" required>
                      <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
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
                    <tbody id="cinema-tbody"></tbody>
                </table>

                <button type="button" onclick="addCinema();" class="btn btn-primary">Add Cinema</button>

                <input type="hidden" id="hidden_cinemas" value="<?= htmlentities(json_encode($cinemas)); ?>">
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
                        <tbody id="cast-tbody"></tbody>
                    </table>

                <button type="button" onclick="addCast();" class="btn btn-primary">Add Cast</button>
                <input type="hidden" id="hidden_casts" value="<?= htmlentities(json_encode($casts)); ?>">
              </div>

              <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" multiple class="form-control" accept="image/*" id="thumbnail" name="thumbnail[]" required>
              </div>

              <div class="form-group">
                <label for="trailers">Trailers</label>
                <input type="file" multiple class="form-control" accept="video/*" id="trailers" name="trailers[]" required>
              </div>

              <div class="form-group">
                <label for="writer">Writer</label>
                <input type="text" value="<?= isset($input['writer']) ? $input['writer'] : ''; ?>" class="form-control" id="writer" name="writer" required>
              </div>

              <div class="form-group">
                <label for="director">Director</label>
                <input type="text" value="<?= isset($input['director']) ? $input['director'] : ''; ?>" class="form-control" id="director" name="director" required>
              </div>

              <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" placeholder="1h35m" value="<?= isset($input['duration']) ? $input['duration'] : ''; ?>" required>
              </div>

              <div class="form-group">
                <label for="release_date">Release Date</label>
                <input type="text" class="form-control" id="release_date" name="release_date" autocomplete="off" value="<?= isset($input['release_date']) ? $input['release_date'] : ''; ?>" required>
              </div>

              <div class="form-group">
                <label for="languages">Languages</label>
                <input type="text" class="form-control" id="languages" name="languages" placeholder="English, Urdu" value="<?= isset($input['languages']) ? $input['languages'] : ''; ?>" required>
              </div>

              <div class="form-group">
                <label for="price_per_ticket">Price per ticket</label>
                <input type="number" class="form-control" id="price_per_ticket" name="price_per_ticket" value="<?= isset($input['price_per_ticket']) ? $input['price_per_ticket'] : ''; ?>" required>
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

  <script type="text/javascript">
    window.addEventListener("load", function () {
        $("#release_date").datetimepicker({
            "timepicker": false,
            "scrollMonth": false,
            "format": "Y-m-d",
            "closeOnDateSelect": true
        });
    });

    function initializeCinemaTimeDatetimePicker() {
        $(".cinema-time").datetimepicker({
            "scrollMonth": false,
            "format": "Y-m-d H:i",
            "step": 15
        });
    }

    var cinemas = 0;
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

    var casts = 0;
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
  </script>