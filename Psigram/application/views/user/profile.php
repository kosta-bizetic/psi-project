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
        <?php $this->load->view('user/partial/header.php', $this->data); ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <table class="table col-md-8">
                    <tbody>
                      <tr class="table-primary">
                        <th scope="row">@<?php echo $user->username; ?></th>
                        <td><?php echo $user->name.' '.$user->surname; ?></td>

                <?php
                    if ($user->id_user != $this->session->userdata['user']->id_user) {
                        if (!$follows) {
                            echo '<td><a href="'.site_url("$this->class_name/followHandler/".$user->id_user).'"><button type="button" class="btn btn-success">Follow</button></a></td>';
                        } else {
                            echo '<td><a href="'.site_url("$this->class_name/unfollowHandler/".$user->id_user).'"><button type="button" class="btn btn-danger">Unfollow</button></a></td>';
                        }
                    }

                    for ($i = 0; $i < 20; $i++) {
                        echo '<td></td>';
                    }
                ?>
                            <td><?php echo $user->num_posts; ?><br>Posts</td>
                            <td><?php echo $user->num_followers; ?><br><a href="<?php echo site_url("$this->class_name/followers/".$user->id_user); ?>">Followers</a></td>
                            <td><?php echo $user->num_following; ?><br><a href="<?php echo site_url("$this->class_name/following/".$user->id_user); ?>">Following</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            foreach ($posts as $post) {
                $this->load->view('user/partial/singlePost', ['post' => $post, 'redirectPage' => "profile/".$post->id_user, 'show_comments_link' => true]);
            }
        ?>

    </body>
</html>