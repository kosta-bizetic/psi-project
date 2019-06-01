<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title><?php echo $title.' - '.$posttitle ?></title>
    </head>
    <body>
        <?php
            $this->load->view('user/partial/header.php', $this->data);

            foreach ($posts as $post) {
                $this->load->view('user/partial/singlePost', ['post' => $post, 'redirectPage' => 'feed']);
            }
        ?>
    </body>
</html>
