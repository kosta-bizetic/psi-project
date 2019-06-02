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
            td {
                text-align:center;
                vertical-align:middle;
                width: 50%;
            }
            table {
              table-layout: fixed ;
              width: 100% ;
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
