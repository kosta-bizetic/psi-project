<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <br>
        <?php
        echo $user->name." ".$user->surname."\n";
        echo "@".$user->username."\n";
        echo $num_posts." objava"."\n";
        echo $num_followers." pratilaca"."\n";
        echo $num_following." ljudi koje prati"."\n";
        ?>
    </body>
</html>
