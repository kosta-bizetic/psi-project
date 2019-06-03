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

            $this->load->view('user/partial/singlePost.php', ['post' => $post, 'redirectPage' => "post/$post->id_post"]);

            foreach ($comments as $comment) {
                $this->load->view('user/partial/singleComment.php', ['comment' => $comment]);
            }
        ?>
    </body>
</html>
