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
        <?php if(isset($message))
            echo "<font color='red'>$message</font><br>";
        ?>
        <form method="post" action="<?php echo site_url("Guest/login");?>">
            Username: <input type="text" name="username" required/> <br/>
            Password: <input type="password" name="password" autofill required/> <br/>
            <input type="submit" value="Login"/>
        </form>
        <a href="<?php echo site_url("Guest/registration");?>">Register</a>
    </body>
</html>