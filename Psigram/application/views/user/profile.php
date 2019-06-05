<!DOCTYPE html>

<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>

        <style>
            th, td {
                text-align:center;
                vertical-align:middle;
            }
        </style>
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