<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Movie Detail </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin/movie/all">Movies</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $data->movie->name; ?></li>
        </ol>
      </nav>
    </div>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php } ?>

    <?php if (!empty($message)) { ?>
        <div class="alert alert-success"><?= $message; ?></div>
    <?php } ?>

    <?php if (isset($_SESSION["error"])) { ?>
        <div class="alert alert-danger"><?= $_SESSION["error"]; ?></div>
    <?php unset($_SESSION["error"]); } ?>

    <?php if (!empty($_SESSION["message"])) { ?>
        <div class="alert alert-success"><?= $_SESSION["message"]; ?></div>
    <?php unset($_SESSION["message"]); } ?>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Basic Information</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->

            <table class="table table-bordered" style="margin-top: 20px;">
                <tr>
                    <th>Name</th>
                    <td><?= $data->movie->name; ?></td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td style="overflow-x: scroll; max-width: 100px;"><?= $data->movie->description; ?></td>
                </tr>

                <tr>
                    <th>Category</th>
                    <td>
                        <?php
                            $count = 0;
                            foreach ($data->categories as $category):
                                echo $category->name . ($count == count($data->categories) - 1 ? "" : " | ");
                                $count++;
                            endforeach;
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>Duration</th>
                    <td><?= $data->movie->duration; ?></td>
                </tr>

                <tr>
                    <th>Release Date</th>
                    <td><?= date("d M (l), Y", strtotime($data->movie->release_date)); ?></td>
                </tr>

                <tr>
                    <th>Languages</th>
                    <td><?= $data->movie->languages; ?></td>
                </tr>

                <tr>
                    <th>Price per ticket</th>
                    <td><?= $data->movie->price_per_ticket; ?></td>
                </tr>

                <tr>
                    <th>Writer</th>
                    <td><?= $data->movie->writer; ?></td>
                </tr>

                <tr>
                    <th>Director</th>
                    <td><?= $data->movie->director; ?></td>
                </tr>
            </table>
            
          </div>
        </div>
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Playing in Cinemas</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->

            <table class="table table-bordered datatable" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cinema</th>
                        <th>Time</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $cinema_count = 0; foreach ($data->cinemas as $cinema): $cinema_count++; ?>
                        <tr>
                            <td><?= $cinema_count; ?></td>
                            
                            <td><?= $cinema->name; ?></td>

                            <td><?= date('d M, Y - h:i A', strtotime($cinema->movie_time)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
          </div>
        </div>
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Casts</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->

            <table class="table table-bordered datatable" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Picture</th>
                    </tr>
                </thead>

                <tbody id="cast-tbody">
                    <?php foreach ($data->casts as $cast): ?>
                        <tr>
                            <td><?= $cast->name; ?></td>
                            
                            <td>
                                <img src="<?= URL . $cast->picture; ?>" class="celeb-img">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
          </div>
        </div>
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Thumbnails</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->

            <div class="row">
                <?php foreach ($data->thumbnails as $thumbnail): ?>
                    <div class="col-md-4" style="margin-top: 20px;">
                        <img src="<?= URL . $thumbnail->file_path; ?>" style="width: 350px; height: 350px; object-fit: cover;">
                    </div>
                <?php endforeach; ?>
            </div>
            
          </div>
        </div>
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Trailers</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->

            <div class="row">
                <?php foreach ($data->trailers as $trailer): ?>
                    <div class="col-md-6" style="margin-top: 20px;">
                        <video src="<?= URL . $trailer->file_path; ?>" style="width: 540px; height: 540px; object-fit: cover;" controls></video>
                    </div>
                <?php endforeach; ?>
            </div>
            
          </div>
        </div>
      </div>
      
    </div>

  </div>
  <!-- content-wrapper ends -->

<script>
    window.addEventListener("load", function () {
        $('.datatable').DataTable();
    });
</script>