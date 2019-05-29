<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Biza</title>
    </head>
    <body>
        <form action="<?php echo site_url("UserController/search");?>">
            <input type="text" name="search_text" placeholder="Search">
            <input type="submit" value="Search">
        </form>
        <form action="<?php echo site_url("UserController/viewProfile")?>">
            <input type="submit" value="Profil">
        </form>
        <?php
        
        ?>
    </body>
</html>
