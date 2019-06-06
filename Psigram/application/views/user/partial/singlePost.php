<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */
?>

<div class="container-fluid" style='background-color: lightsteelblue; padding-top: 0px; padding-bottom: 0px'>
    <div class="row justify-content-center">
        <div class="col-md-4" style="background-color: white; margin-top: 1em; border: 1px solid rgb(0, 123, 255);  border-radius: 20px">
            <div style="text-align: center;">
                <a href="<?php echo site_url("$this->class_name/profile/$post->id_user") ?>"><strong style="float:left">@<?php echo $post->username ?></strong></a>
                <?php
                    if ($post->sponsored) {
                        echo '<strong style="display: inline-block">Sponsored</strong>';
                    }

                    if ($this->user->type == "a" || $this->user->id_user == $post->id_user) {
                        echo '<a href="'.site_url($this->class_name.'/deletePostHandler/'.$post->id_post).'"><strong style="float: right">X</strong></a>';
                    }
                ?>
            </div>
            <br/>
            <div style="text-align: center">
                <img ondblclick="likeHandler(<?php echo "$post->id_post" ?>)" src="<?php echo base_url('/uploads/'.$post->image_name) ?>" class="img-fluid">
            </div>
            <div style="text-align: center">
                <a href="<?php echo site_url("$this->class_name/likers/$post->id_post") ?>">
                    <strong id="<?php echo 'LikeText'.$post->id_post ?>" style="float:left">
                        <?php
                            if ($post->likes) {
                                if ($post->num_likes == 2) {
                                    echo 'You and '.($post->num_likes - 1).' other like this.';
                                } else if ($post->num_likes == 1) {
                                    echo 'You like this.';
                                } else {
                                    echo 'You and '.($post->num_likes - 1).' others like this.';
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
                    if ($this->user->type == "b" && $this->user->id_user == $post->id_user) {
                        echo '<a href="'.site_url("$this->class_name/sponsorHandler/$post->id_post").'"><strong>';
                        if ($post->sponsored) {
                            echo 'Unpromote post';
                        } else {
                            echo 'Promote post';
                        }
                        echo '</strong>';
                    }

                    if ($show_comments_link) {
                        echo '<a style="float: right" href="'.site_url("$this->class_name/post/$post->id_post").'"><strong>View comments</strong></a>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
