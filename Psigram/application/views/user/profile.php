<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <style>
            th, td {
                text-align:center;
                vertical-align:middle;
            }
        </style>
        <title><?php echo $title ?></title>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);
        ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                    echo '<table class="table col-md-8">
                            <tbody>
                              <tr class="table-primary">
                                <th scope="row">@'.$user->username.'</th>
                                <td>'.$user->name.' '.$user->surname.'</td>';

                    if ($user->id_user != $this->session->userdata['user']->id_user) {
                        if (!$follows) {
                            echo '<td><a href="'. site_url("User/followHandler/".$user->id_user).'"><button type="button" class="btn btn-success">Follow</button></a></td>';
                        } else {
                            echo '<td><a href="'. site_url("User/unfollowHandler/".$user->id_user).'"><button type="button" class="btn btn-danger">Unfollow</button></a></td>';
                        }
                    }

                    for ($i = 0; $i < 20; $i++) {
                        echo '<td></td>';
                    }

                    echo       '<td>'.$num_posts.'<br>Posts</td>
                                <td>'.$num_followers.'<br>Followers</td>
                                <td>'.$num_following.'<br>Follwoing</td>
                              </tr>
                            </tbody>
                          </table>';
                ?>
            </div>
        </div>
        <?php
            foreach ($posts as $post) {
                $this->load->view('user/partial/singlePost', ['image_name' => $post->image_name]);
            }
        ?>

    </body>
</html>