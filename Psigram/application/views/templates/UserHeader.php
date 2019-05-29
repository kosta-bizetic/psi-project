<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
    </head>
    <body>
        <form action="<?php echo site_url("User/search");?>">
            <input type="text" name="search_text" placeholder="Search">
            <input type="submit" value="Search">
        </form>
        
        <a href="<?php echo site_url("User/viewProfile")?>"> Profil </a>
        <br>
        <a href="<?php echo site_url("User/logOut")?>"> Log Out </a>
    </body>
</html>
