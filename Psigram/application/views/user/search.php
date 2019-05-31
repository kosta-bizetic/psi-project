<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <style>
            td {
                text-align:center;
                vertical-align:middle;
                width: 50%;
            }
            table {
              table-layout: fixed ;
              border-right:aqua;
              width: 100% ;
            }
        </style>
        <title><?php echo $title ?></title>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            foreach ($users as $user) {
                $this->load->view('user/partial/userPanel.php', ['user' => $user]);
            }
        ?>
    </body>
</html>
