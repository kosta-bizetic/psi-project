<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            foreach ($posts as $post) {
                $this->load->view('user/partial/singlePost', ['post' => $post, 'redirectPage' => 'feed', 'show_comments_link' => true]);
            }

            $this->load->view('user/partial/likeHandlerScript.php');
        ?>
    </body>
</html>
