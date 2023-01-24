<?php
/**
 * Created by PhpStorm.
 * User: Adnan Afzal
 * Date: 28/04/2018
 * Time: 1:57 PM
 */
?>

<form role="form" onsubmit="return register();">
    <?= Security::csrf_token(); ?>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Name" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter Password" required>
    </div>

    <button type="submit" class="btn btn-primary">Register <i class="fa fa-spinner fa-spin" id="register-loader" style="display: none;"></i></button>
</form>
