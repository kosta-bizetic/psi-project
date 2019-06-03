<!DOCTYPE html>

<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
    </head>
    <body>
        <?php $this->load->view('user/partial/header.php', $this->data); ?>
        <div class="container-fluid" style="padding-top: 2%">
            <div class="row">
                <form class="col-md-2 offset-md-4" method="post" action="<?php echo site_url("$this->class_name/editProfileHandler");?>">
                    <?php
                        if (isset($message)) {
                            echo "<font color='red'>$message</font>";
                        }
                    ?>
                    <div class="container">
                        <div class="row">
                          <div class="col-xs-"><label for="username">Username</label></div>
                          <div class="col-xs-"><input type="text" class="form-control" id="username" name="username" placeholder="Username" required></div>
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
                          <small id="emailHelp" class="email-sharing form-text">We'll never share your email with anyone else.</small>
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
                        <button type="submit" class="btn btn-primary">Finish</button>
                  </div>
                </form>
            </div>
        </div>
    </body>
</html>
