<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION['user_id'])) :?>
    <nav>Navbar <form action="<?php echo STARTING_URL?>/logout" method="post"><input type="submit" value="Wyloguj"></form> </nav>
    <?php endif ?>
    <?php echo $content ?>
</body>
</html>