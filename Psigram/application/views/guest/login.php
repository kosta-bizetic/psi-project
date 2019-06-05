<!DOCTYPE html>

<html>
    <head>

        <?php $this->load->view('partial/head.php', $this->data); ?>

        <style>
            label {
                color: white;
            }
        </style>
    </head>
    <body style='background-image: url("<?php echo base_url('/assets/images/backgroundImage.jpg') ?>")'>

        <?php $this->load->view('guest/partial/header.php'); ?>

        <div class="container-fluid" style="padding-top: 15%">
            <div class="row">
                <form class="col-md-2 offset-md-4" method="post" action="<?php echo site_url("$this->class_name/login");?>">
                    <?php echo validation_errors(); ?>
                    <fieldset>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" name="username" class="form-control" id="username" aria-describedby="username" value="<?php echo set_value('username'); ?>" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password" class="form-control" id="password" value="<?php echo set_value('password'); ?>" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
