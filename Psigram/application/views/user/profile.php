<!DOCTYPE html>

<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/userProfile.css') ?>">
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            $this->load->view('user/partial/userProfile.php', $this->data);

            foreach ($posts as $post) {
                $this->load->view('user/partial/singlePost', ['post' => $post, 'redirectPage' => "profile/".$post->id_user, 'show_comments_link' => true]);
            }

            $this->load->view('user/partial/likeHandlerScript.php');
        ?>

    </body>
</html>