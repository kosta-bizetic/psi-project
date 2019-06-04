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
                <form class="col-md-2 offset-md-4" method="post" action="<?php echo site_url("$this->class_name/registration");?>">
                    <fieldset>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" required>
                          <?php echo form_error('username'); ?>
                        </div>

                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" id="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required>
                          <?php echo form_error('password'); ?>
                        </div>

                        <div class="form-group">
                          <label for="confirm-password">Confirm password</label>
                          <input type="password" id="confirm-password" class="form-control" name="confirm-password" value="<?php echo set_value('confirm-password'); ?>" placeholder="Confirm password" onkeyup='check();' required>
                          <?php echo form_error('confirm-password'); ?>
                          <span id='message'></span>
                        </div>
                        
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>" placeholder="Name" required>
                          <?php echo form_error('name'); ?>
                        </div>

                        <div class="form-group">
                          <label for="surname">Last name</label>
                          <input type="text" class="form-control" id="surname" name="surname" value="<?php echo set_value('surname'); ?>" placeholder="Last name" required>
                          <?php echo form_error('surname'); ?>
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email address" required>
                          <small id="emailHelp" class="email-sharing form-text">We'll never share your email with anyone else.</small>
                          <?php echo form_error('email'); ?>
                        </div>

                        <div class="form-group">
                          <label for="date_of_birth">Date of birth</label>
                          <input type="date" class="form-control" id="date_of_birth" value="<?php echo set_value('date_of_birth'); ?>" name="date_of_birth" required>
                          <?php echo form_error('date_of_birth'); ?>
                        </div>

                        <fieldset class="form-group">
                          <label for="gender">Gender</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="m" <?php echo set_checkbox('gender', 'm'); ?> required>
                              Male
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="f" <?php echo set_checkbox('gender', 'f'); ?> required>
                              Female
                            </label>
                          </div>
                          <?php echo form_error('gender'); ?>
                        </fieldset>

                        <fieldset class="form-group">
                          <label for="type">Account type</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="s" <?php echo set_checkbox('type', 's', TRUE); ?> required>
                              Standard
                            </label>
                          </div>
                          <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" value="b" <?php echo set_checkbox('type', 'b', FALSE); ?> required>
                              Business
                            </label>
                          </div>
                          <?php echo form_error('type'); ?>
                        </fieldset>

                        <button type="submit" id="submit" class="btn btn-primary">Register</button>
                  </fieldset>
                </form>
            </div>
        </div>

        <script>
            var check = function() {
              if (document.getElementById('password').value ===
                document.getElementById('confirm-password').value) {
                document.getElementById('message').style.color = 'lightgreen';
                document.getElementById('message').innerHTML = 'Matching';
                document.getElementById('submit').disabled = false;
              } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Not matching';
                document.getElementById('submit').disabled = true;
              }
            };
        </script>
    </body>
</html>
