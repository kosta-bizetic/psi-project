<!DOCTYPE html>

<html>
    <head>
        <?php $this->load->view('partial/head.php', $this->data); ?>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            echo form_open_multipart("$this->class_name/addPostHandler");?>
                <?php if(isset($error)) echo $error."<br>";?>
                <p> Choose picture: </p>
                <input type="file" name="image" type="image/*">
                <input type="submit" name="upload" value="Submit">
            </form>
    </body>
</html>