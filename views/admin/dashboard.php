<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 29/04/2018
 * Time: 8:45 AM
 */
?>

<div class="content-wrapper">

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="d-sm-flex align-items-baseline report-summary-header">
                  <h5 class="font-weight-semibold">Report Summary</h5> <span class="ml-auto">Updated Report</span> <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                </div>
              </div>
            </div>
            <div class="row report-inner-cards-wrapper">
              <div class=" col-md -6 col-xl report-inner-card">
                <div class="inner-card-text">
                    <a href="<?= URL . 'admin/upcoming_movies' ?>" style="text-decoration: none; color: black;">
                        <span class="report-title">Upcoming movies</span>
                        <h4><?= count($comming_soon); ?></h4>
                    </a>
                </div>
                <div class="inner-card-icon bg-success">
                  <i class="icon-rocket"></i>
                </div>
              </div>
              <div class="col-md-6 col-xl report-inner-card">
                <div class="inner-card-text">
                    <a href="<?= URL . 'admin/movies_played_so_far' ?>" style="text-decoration: none; color: black;">
                        <span class="report-title">Movies played so far</span>
                        <h4><?= $played_so_far; ?></h4>
                    </a>
                </div>
                <div class="inner-card-icon bg-danger">
                  <i class="icon-briefcase"></i>
                </div>
              </div>
              <div class="col-md-6 col-xl report-inner-card">
                <div class="inner-card-text">
                    <a href="<?= URL . 'admin/currently_playing' ?>" style="text-decoration: none; color: black;">
                        <span class="report-title">Currently playing</span>
                        <h4><?= count($currently_playing); ?></h4>
                    </a>
                </div>
                <div class="inner-card-icon bg-warning">
                  <i class="icon-globe-alt"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>