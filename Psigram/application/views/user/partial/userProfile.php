<?php
/**
 * @author Luka Dojcilovic 2016/0135
 * @author Kosta Bizetic 2016/0121
 */
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <table class="table col-md-8">
            <tbody>
                <tr>
                    <th scope="row">@<?php echo $user->username; ?></th>
                    <td><?php echo $user->name.' '.$user->surname; ?></td>

                    <?php
                        if ($user->id_user != $this->session->userdata['user']->id_user) {
                            if (!$follows) {
                                echo '<td><a href="'.site_url("$this->class_name/followHandler/".$user->id_user).'"><button type="button" class="btn btn-success">Follow</button></a></td>';
                            } else {
                                echo '<td><a href="'.site_url("$this->class_name/unfollowHandler/".$user->id_user).'"><button type="button" class="btn btn-danger">Unfollow</button></a></td>';
                            }
                        } else {
                            echo '<td><a href="'.site_url("$this->class_name/editProfile").'"><button type="button" class="btn btn-primary">Edit Profile</button></a></td>';
                        }

                        if ($this->session->userdata['user']->type == 'b') {
                            echo '<td><a href="'.site_url("$this->class_name/statistics").'"><button type="button" class="btn btn-primary">Statistics</button></a></td>';
                        }

                        for ($i = 0; $i < 20; $i++) {
                            echo '<td></td>';
                        }
                    ?>

                    <td><?php echo $user->num_posts; ?><br>Posts</td>
                    <td><a href="<?php echo site_url("$this->class_name/followers/".$user->id_user)?>"><?php echo $user->num_followers; ?><br>Followers</a></td>
                    <td id="rightTD"><a href="<?php echo site_url("$this->class_name/following/".$user->id_user)?>"><?php echo $user->num_following; ?><br>Following</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>