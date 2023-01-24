<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Edit Cinema </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin/cinema/">Cinemas</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);"><?= $cinema_id; ?></a></li>
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
            <!-- <h4 class="card-title">Edit Category</h4> -->
            <!-- <p class="card-description"> Basic form layout </p> -->
            <form class="forms-sample" method="POST" action="<?= URL; ?>admin/cinema/edit/<?= $cinema_id; ?>">
                <?= Security::csrf_token(); ?>
              <div class="form-group">
                <label for="name">Cinema Name</label>
                <input type="text" class="form-control" id="name" value="<?= $cinema->name; ?>" name="name" required>
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