<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Celebrity Detail </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin/celebrities/all">Celebrities</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?= $data->name; ?></li>
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
            <h4 class="card-title text-center">Basic Information</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->

            <table class="table table-bordered" style="margin-top: 20px;">

                <tr>
                    <td colspan="2">
                        <img class="celeb-img" src="<?= URL . $data->picture; ?>">
                    </td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td><?= $data->name; ?></td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td style="overflow-x: scroll; max-width: 100px;"><?= $data->description; ?></td>
                </tr>

                <tr>
                    <th>Height</th>
                    <td><?= htmlentities($data->height); ?></td>
                </tr>

                <tr>
                    <th>Weight</th>
                    <td><?= $data->weight; ?></td>
                </tr>

                <tr>
                    <th>Eye Color</th>
                    <td><?= $data->eye_color; ?></td>
                </tr>

                <tr>
                    <th>Hair Color</th>
                    <td><?= $data->hair_color; ?></td>
                </tr>

                <tr>
                    <th>Birthday</th>
                    <td><?= date("d M (l), Y", strtotime($data->birthday)); ?></td>
                </tr>

                <tr>
                    <th>Facebook</th>
                    <td>
                        <a href="<?= $data->facebook; ?>" target="_blank">
                            <?= $data->facebook; ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <th>Twitter</th>
                    <td>
                        <a href="<?= $data->twitter; ?>" target="_blank">
                            <?= $data->twitter; ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <th>YouTube</th>
                    <td>
                        <a href="<?= $data->youtube; ?>" target="_blank">
                            <?= $data->youtube; ?>
                        </a>
                    </td>
                </tr>
            </table>
            
          </div>
        </div>
      </div>
      
    </div>

  </div>
  <!-- content-wrapper ends -->