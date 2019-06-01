<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="container-fluid" style="padding: 1%">
    <div class="row justify-content-center">
        <strong>@<?php echo $post->username ?></strong>
        <br>
        <div class="col-md-4">
            <img src="<?php echo base_url('/uploads/'.$post->image_name) ?>" class="img-fluid">
        </div>
        <br>
        <strong><?php echo $post->num_likes ?> Likes</strong>
        <br>
    </div>
</div>
