<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <style>
            label {
                color: white;
            }
        </style>
        <title><?php echo $title; ?></title>
    </head>
    <body style='background-image: url("<?php echo base_url('/assets/backgroundImage.jpg') ?>")'>
        <?php
            $this->load->view('guest/partial/header.php');
        ?>
        <div class="container-fluid" style="padding-top: 15%">
            <div class="row">
                <form class="col-md-2 offset-md-4" method="post" action="<?php echo site_url("Guest/loginHandler");?>">
                    <?php
                        if (isset($message)) {
                            echo "<font color='red'>$message</font>";
                        }
                    ?>
                    <fieldset>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" name="username" class="form-control" id="username" aria-describedby="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
