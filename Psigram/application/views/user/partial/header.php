<!DOCTYPE html>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a style="padding-right: 8.75%" class="navbar-brand" href="<?php echo site_url("User/feed")?>">Psigram</a>
  <div class="collapse navbar-collapse" id="navbarColor01">
    <form class="form-inline my-2 my-lg-0 ml-auto mr-auto" method="post" action="<?php echo site_url("User/search");?>">
      <input class="form-control mr-sm-2" type="text" name="search_text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("User/feed")?>">Feed</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("User/addPost")?>">Add post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("User/profile/".$this->user->id_user)?>">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("User/logOut")?>">Log Out</a>
      </li>
    </ul>
  </div>
</nav>

