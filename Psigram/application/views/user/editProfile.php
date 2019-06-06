<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
    </head>
    <body>
        <?php $this->load->view('user/partial/header.php', $this->data); ?>
        <div class="container-fluid" style="padding-top: 2%">
            <div class="row">
                <form class="col-md-2 offset-md-4" method="post" action="<?php echo site_url("$this->class_name/editProfile");?>">
                    <fieldset>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', $user->username); ?>" placeholder="Username" required>
                          <?php echo form_error('username'); ?>
                        </div>

                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password', $user->password); ?>" placeholder="Password" required>
                          <?php echo form_error('password'); ?>
                        </div>

                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name', $user->name); ?>" placeholder="Name" required>
                          <?php echo form_error('name'); ?>
                        </div>

                        <div class="form-group">
                          <label for="surname">Last name</label>
                          <input type="text" class="form-control" id="surname" name="surname" value="<?php echo set_value('surname', $user->surname); ?>" placeholder="Last name" required>
                          <?php echo form_error('surname'); ?>
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $user->email); ?>" placeholder="Email address" required>
                          <small id="emailHelp" class="email-sharing form-text">We'll never share your email with anyone else.</small>
                          <?php echo form_error('email'); ?>
                        </div>

                        <div class="form-group">
                          <label for="date_of_birth">Date of birth</label>
                          <input type="date" class="form-control" id="date_of_birth" value="<?php echo set_value('date_of_birth', $user->date_of_birth); ?>" name="date_of_birth" required>
                          <?php echo form_error('date_of_birth'); ?>
                        </div>

                        <fieldset class="form-group">
                          <label for="gender">Gender</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="m" <?php echo set_checkbox('gender', 'm', $user->gender == 'm'); ?> required>
                              Male
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="f" <?php echo set_checkbox('gender', 'f', $user->gender == 'f'); ?> required>
                              Female
                            </label>
                          </div>
                          <?php echo form_error('gender'); ?>
                        </fieldset>

                        <fieldset class="form-group">
                          <label for="type">Account type</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="s" <?php echo set_checkbox('type', 's', $user->type == 's'); ?> required>
                              Standard
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="b" <?php echo set_checkbox('type', 'b', $user->type == 'b'); ?> required>
                              Business
                            </label>
                          </div>
                          <?php if ($user->type == 'a'): ?>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="a" <?php echo set_checkbox('type', 'a', $user->type == 'a'); ?> required>
                              Admin
                            </label>
                          </div>
                          <?php endif; ?>
                          <?php echo form_error('type'); ?>
                        </fieldset>

                        <button type="submit" name="submit" value="cancel" class="btn btn-primary">Cancel</button>
                        <button type="submit" name="submit" value="save" class="btn btn-primary">Save</button>
                  </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
