<!DOCTYPE html>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Psigram</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url("User/feed")?>">Feed<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("User/addPost")?>">Add post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("User/profile")?>">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("User/logOut")?>">Log Out</a>
      </li>
    </ul>
      <form class="form-inline my-2 my-lg-0" method="post" action="<?php echo site_url("User/search");?>">
          <input class="form-control mr-sm-2" type="text" name="searc_text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

