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
                    <fieldset>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="password" value="<?php echo $user->password; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->name; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="surname">Last name</label>
                          <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $user->surname; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>" required>
                          <small id="emailHelp" class="email-sharing form-text">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="date_of_birth">Date of birth</label>
                          <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $user->date_of_birth; ?>" required>
                        </div>
                        <fieldset class="form-group">
                          <label for="gender">Gender</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="m" <?php if ($user->gender == 'm') echo 'checked'; ?> required>
                              Male
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="f" <?php if ($user->gender == 'f') echo 'checked'; ?>required>
                              Female
                            </label>
                          </div>
                        </fieldset>
                        <fieldset class="form-group">
                          <label for="type">User type</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="s" <?php if ($user->type == 's') echo 'checked'; ?> required>
                              Standard
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="b" <?php if ($user->type == 'b') echo 'checked'; ?> required>
                              Business
                            </label>
                          </div>
                        <button type="submit" name="submit" value="cancel" class="btn btn-primary">Cancel</button>
                        <button type="submit" name="submit" value="save" class="btn btn-primary">Save</button>
                  </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
