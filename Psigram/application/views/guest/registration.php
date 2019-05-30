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
        <title><?php echo $title ?></title>
    </head>
    <body style='background-color: lightblue'>
        <?php
            $this->load->view('guest/partial/header.php');
        ?>
        <div class="container-fluid" style="padding-top: 2%">
            <div class="row">
                <form class="col-md-2 offset-md-4" method="post" action="<?php echo site_url("Guest/registrationHandler");?>">
                    <?php
                        if (isset($message)) {
                            echo "<font color='red'>$message</font>";
                        }
                    ?>
                    <fieldset>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                          <label for="Name">Name</label>
                          <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                          <label for="surname">Last name</label>
                          <input type="text" class="form-control" name="surname" placeholder="Last name" required>
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control" name="email" placeholder="Email address" required>
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="date_of_brith">Date of birth</label>
                          <input type="date" class="form-control" name="date_of_birth" required>
                        </div>
                        <fieldset class="form-group">
                          <label for="gender">Gender</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="m" required>
                              Male
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="f" required>
                              Female
                            </label>
                          </div>
                        </fieldset>
                        <fieldset class="form-group">
                          <label for="type">User type</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="u" checked required>
                              Basic
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="b" required>
                              Business
                            </label>
                          </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Register</button>
                  </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
