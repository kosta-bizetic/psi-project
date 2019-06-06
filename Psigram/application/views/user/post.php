<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
        <style>
            table {
                margin: 0.5em 0em;
                border-collapse: separate;
                border-spacing: 0px;
            }
            tr {
                background-color: white;
            }
            th {
                text-align: center;
                border-top: 1px solid rgb(0, 123, 255);
                border-bottom: 1px solid rgb(0, 123, 255);
                border-left: 1px solid rgb(0, 123, 255);
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
            }
            td {
                border-top: 1px solid rgb(0, 123, 255);
                border-bottom: 1px solid rgb(0, 123, 255);
            }
            #rightTD {
                border-right: 1px solid rgb(0, 123, 255);
                border-top-right-radius: 20px;
                border-bottom-right-radius: 20px;
            }
        </style>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            $this->load->view('user/partial/singlePost.php', ['post' => $post, 'show_comments_link' => false]);
        ?>

        <div class='container-fluid'>
            <div class='row justify-content-center'>
                <div class="col-md-4">
                    <table  style="table-layout: fixed; width: 100%">
                        <tbody>
                            <?php
                                foreach ($comments as $comment) {
                                    echo "<tr>
                                            <th scope='row'><a href='".site_url("$this->class_name/profile/$comment->id_user")."'>@".$comment->username."</a></td>
                                            <td style='word-wrap: break-word; width: 60%'>$comment->text</td>
                                            <td style='float:right; text-align:center'>".substr($comment->timestamp, 0, 16)."</td>
                                            <td id='rightTD' style='width: 5%'>";

                                    if ($this->user->type == "a" ||
                                            $this->user->id_user == $comment->id_user) {
                                        echo '<a href="'.site_url("$this->class_name/deleteCommentHandler/$comment->id_comment").'"><strong>X</strong></a>';
                                    }

                                    echo "  </td>
                                          </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <form method="post" action='<?php echo site_url("$this->class_name/addCommentHandler/$post->id_post") ?>'>
                        <input type="text" name="comment_text" class="form-control" placeholder="Add a comment" required>
                    </form>
                </div>
            </div>
        </div>

        <?php
            $this->load->view('user/partial/likeHandlerScript.php');
        ?>
    </body>
</html>
