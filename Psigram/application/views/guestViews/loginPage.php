<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="container-fluid" style="padding-top: 15%">
<div class="row">
<form class="col-md-2 offset-md-4" method="post" action="<?php echo site_url("Guest/login");?>">
    <?php if(isset($message))
    echo "<font color='red'>$message</font><br>";
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
    <button type="submit" class="btn btn-primary">Log in</button>
  </fieldset>
</form>
</div>
</div>
</body>
</html>
