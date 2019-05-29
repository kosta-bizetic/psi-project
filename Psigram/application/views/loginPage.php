<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Psigram</title>
    </head>
    <body>
        <form method="post" action="<?php echo site_url("GuestController/login");?>">
            Username: <input type="text" name="username"/> <br/>
            Password: <input type="password" name="password"/> <br/>
        </form>
    </body>
</html>
