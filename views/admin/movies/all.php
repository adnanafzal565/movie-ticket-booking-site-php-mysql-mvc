<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Movies </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= URL; ?>admin">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Movies</li>
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
      
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <!-- <h4 class="card-title">All Movies</h4> -->
            <!-- <p class="card-description"> Add class <code>.table-bordered</code> -->
            </p>
            <table class="table table-bordered" id="table-movies">
              <thead>
                <tr>
                    <th>#</th>
                  <th> Name </th>
                  <th>Duration</th>
                  <th>Languages</th>
                  <th>Price per ticket</th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($movies as $movie) { ?>
                    <tr>
                        <td><?= $movie->id; ?></td>
                      <td> <?= $movie->name; ?> </td>
                      <td> <?= $movie->duration; ?> </td>
                      <td> <?= $movie->languages; ?> </td>
                      <td> <?= $movie->price_per_ticket; ?> </td>
                      <td>

                        <a class="btn btn-primary btn-sm" href="<?= URL; ?>admin/movie/detail/<?= $movie->id; ?>">
                            Detail
                        </a>

                        <a class="btn btn-info btn-sm" href="<?= URL; ?>admin/movie/edit/<?= $movie->id; ?>">
                            Edit
                        </a>

                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="return confirmDelete(this);" data-href="<?= URL; ?>admin/movie/delete/<?= $movie->id; ?>">
                            Delete
                        </a>
                      </td>
                    </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>

  </div>
  <!-- content-wrapper ends -->

  <script>
      function confirmDelete(self) {
        swal({
          title: "Confirm Delete ?",
          text: "Are you sure you want to delete this ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = self.getAttribute("data-href");
          }
        });
        return false;
      }

        window.addEventListener("load", function () {
            $('#table-movies').DataTable({
                "order": [[
                    0, "desc"
                ]]
            });
        });
  </script>