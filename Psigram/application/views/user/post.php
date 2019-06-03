<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            $this->load->view('user/partial/singlePost.php', ['post' => $post, 'redirectPage' => "post/$post->id_post", 'show_comments_link' => false]);
        ?>

        <div class='container-fluid'>
            <div class='row justify-content-center'>
                <div class="col-md-4">
                    <?php
                        foreach ($comments as $comment) {
                            echo "<strong style='padding-right: 10px'>@$comment->username</strong>$comment->text<br/>";
                        }
                    ?>
                    <form style="padding-top: 2%" method="post" action='<?php echo site_url("$this->class_name/addCommentHandler/$post->id_post") ?>'>
                        <input type="text" name="comment_text" class="form-control" placeholder="Add a comment">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
