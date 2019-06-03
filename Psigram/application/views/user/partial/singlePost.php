
<div class="container-fluid" style="padding: 1%">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a href="<?php echo site_url("$this->class_name/profile/$post->id_user") ?>"><strong>@<?php echo $post->username ?></strong></a>
            <?php
                if ($this->user->type == "a" || $this->user->id_user == $post->id_user) {
                    echo '<a href="'.site_url($this->class_name.'/deletePostHandler/'.$post->id_post).'"><strong style="float: right">X</strong></a>';
                }
            ?>
            <br/>
            <img ondblclick="location.href='<?php echo site_url("$this->class_name/likeHandler/".$post->id_post."/".$post->likes)?>'" src="<?php echo base_url('/uploads/'.$post->image_name) ?>" class="img-fluid">
            <br/>
            <a href="<?php echo site_url("$this->class_name/likers/$post->id_post") ?>">
            <strong>
                <?php
                    if ($post->likes) {
                        if ($post->num_likes == 2) {
                            echo 'You and '.($post->num_likes - 1).' other liked this.';
                        } else {
                            echo 'You and '.($post->num_likes - 1).' others liked this.';
                        }
                    } else {
                        if ($post->num_likes == 1) {
                            echo $post->num_likes.' person likes this.';
                        } else {
                            echo $post->num_likes.' people like this.';
                        }
                    }
                ?>
            </strong>
            </a>
            <?php
                if ($show_comments_link) {
                    echo '<a style="float: right" href="'.site_url("$this->class_name/post/$post->id_post").'">View comments</a>';
                }
            ?>
        </div>
    </div>
</div>
