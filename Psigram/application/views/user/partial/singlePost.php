
<div class="container-fluid" style="padding: 1%">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <strong>@<?php echo $post->username ?></strong>
            <br/>
            <img ondblclick="location.href='<?php echo site_url("$this->class_name/likeHandler/".$post->id_post."/".$post->likes."/".$redirectPage)?>'" src="<?php echo base_url('/uploads/'.$post->image_name) ?>" class="img-fluid">
            <br/>
            <strong>
                <?php echo $post->num_likes ?> Likes
                <?php if ($post->likes) {
                    echo '<br/>You liked this.';
                } ?>
            </strong>
        </div>
    </div>
</div>
