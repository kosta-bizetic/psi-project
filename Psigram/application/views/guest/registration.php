<!DOCTYPE html>

<html>
    <head>

        <?php $this->load->view('partial/head.php', $this->data); ?>

        <style>
            label {
                color: white;
            }
            .email-sharing {
                color: white;
            }
        </style>
    </head>
    <body style='background-image: url("<?php echo base_url('/assets/backgroundImage.jpg') ?>")'>
        <?php $this->load->view('guest/partial/header.php'); ?>
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
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                          <label for="surname">Last name</label>
                          <input type="text" class="form-control" id="surname" name="surname" placeholder="Last name" required>
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                          <small id="emailHelp" class="email-sharing form-text">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="date_of_birth">Date of birth</label>
                          <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
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
                              <input type="radio" class="form-check-input" name="type" value="s" checked required>
                              Standard
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
