<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php echo form_open_multipart('User/addPost');?>
    <?php if(isset($error)) echo $error;?> <br>
    <p> Izaberite sliku </p> <br>
    <input type="file" name="image" type="image/*">
    <input type="submit" name="upload" value="Submit">
</form>
