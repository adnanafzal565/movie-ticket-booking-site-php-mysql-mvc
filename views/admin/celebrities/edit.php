<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Edit Celebrity </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin/celebrities/all">Celebrities</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Celebrity</li>
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
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="<?= URL; ?>admin/celebrities/edit/<?= $celebrity_id; ?>">

                <?= Security::csrf_token(); ?>
              
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $data->name; ?>" required>
              </div>

              <div class="form-group">
                <label for="picture">Picture</label>
                <input type="file" class="form-control" accept="image/*" id="picture" name="picture" onchange="previewPicture(this);">

                <img src="<?= URL . $data->picture; ?>" id="celeb-img" class="celeb-img" style="margin-top: 10px;">
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="7" class="form-control" id="description" name="description"><?= $data->description; ?></textarea>
              </div>

              <div class="form-group">
                  <label for="height">Height</label>
                  <input type="text" id="height" name="height" class="form-control" placeholder="5.7" value="<?= htmlentities($data->height); ?>">
              </div>

              <div class="form-group">
                  <label for="weight">Weight</label>
                  <input type="text" id="weight" name="weight" class="form-control" placeholder="1136LB" value="<?= $data->weight; ?>">
              </div>

              <div class="form-group">
                  <label for="eye_color">Eye color</label>
                  <input type="text" id="eye_color" name="eye_color" class="form-control"  value="<?= $data->eye_color; ?>">
              </div>

              <div class="form-group">
                  <label for="hair_color">Hair color</label>
                  <input type="text" id="hair_color" name="hair_color" class="form-control" value="<?= $data->hair_color; ?>">
              </div>

              <div class="form-group">
                  <label for="birthday">Birthday</label>
                  <input type="text" id="birthday" autocomplete="off" name="birthday" class="form-control" value="<?= $data->birthday; ?>">
              </div>

              <div class="form-group">
                  <label for="facebook">Facebook</label>
                  <input type="text" id="facebook" name="facebook" class="form-control" value="<?= $data->facebook; ?>">
              </div>

              <div class="form-group">
                  <label for="twitter">Twitter</label>
                  <input type="text" id="twitter" name="twitter" class="form-control" value="<?= $data->twitter; ?>">
              </div>

              <div class="form-group">
                  <label for="youtube">YouTube</label>
                  <input type="text" id="youtube" name="youtube" class="form-control" value="<?= $data->youtube; ?>">
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

  <script>

    window.addEventListener("load", function () {
        $("#birthday").datetimepicker({
            "timepicker": false,
            "scrollMonth": false,
            "format": "Y-m-d",
            "closeOnDateSelect": true
        });
    });

    function previewPicture(self) {
        if (self.files.length > 0) {
            var fileReader = new FileReader();
 
            fileReader.onload = function (event) {
                document.getElementById("celeb-img").setAttribute("src", event.target.result);
            };
 
            fileReader.readAsDataURL(self.files[0]);
        }
    }
  </script>