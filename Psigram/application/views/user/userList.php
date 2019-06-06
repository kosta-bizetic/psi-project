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

        <style>
            tr {
                background-color: white;
            }
            tr:hover {
                background-color: rgb(211,211,211);
            }
            td {
                text-align:center;
                vertical-align:middle;
                width: 50%;
                padding: 1em;
            }
            .leftTD {
                border-top: 1px solid rgb(0, 123, 255);
                border-left: 1px solid rgb(0, 123, 255);
                border-bottom: 1px solid rgb(0, 123, 255);
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
            }
            .rightTD {
                border: 1px solid rgb(0, 123, 255);
                border-top-right-radius: 20px;
                border-bottom-right-radius: 20px;
            }
            table {
              table-layout: fixed;
              width: 100% ;
              cursor: pointer;
              margin-top: 1em;
              border-collapse: separate;
              border-spacing: 0px;
            }
        </style>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            foreach ($users as $user) {
                $this->load->view('user/partial/singleUser.php', ['user' => $user]);
            }
        ?>
    </body>
</html>
