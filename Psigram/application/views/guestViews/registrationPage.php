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
        <form method="post" action="<?php echo site_url("Guest/register");?>">
            Username: <input type="text" name="username" required/> <br/>
            Password: <input type="password" name="password" autofill required/> <br/>
            Name: <input type="text" name="name" required/> <br/>
            Surname: <input type="text" name="username" required/> <br/>
            Email: <input type="text" name="username" email required/> <br/>
            Date of birth: <input type="date" name="date_of_birth" required> <br/>
            Gender:
            <input type="radio" name="gender" value="m" required> Male 
            <input type="radio" name="gender" value="f" required> Female <br/>
            Type: 
            <input type="radio" name="type" value="u" checked> Basic 
            <input type="radio" name="type" value="b"> Business <br/>
            <input type="submit" value="Register"/>
        </form>
    </body>
</html>
