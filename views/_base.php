<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo STATIC_URL.'css/style.css' ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <title>Fakturant</title>
</head>
<body>
<div class="background">
    <div class="container">
        <?php if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "user"): ?>
        <nav class="nav">
            <div class="nav-logo">
                <img src="<?php echo STATIC_URL.'images/logo.png'?>">
            </div>
            <ul class="nav-menu">
                <a href="<?php echo STARTING_URL ?>/user/add-invoice">
                    <li class="nav-menu__item active">
                        <i class="material-icons">library_add</i>
                        <p>Dodaj fakturę</p>
                    </li>
                </a>
                <a href="<?php echo STARTING_URL ?>/user/list-invoice">
                <li class="nav-menu__item">
                    <i class="material-icons">history_edu</i>
                    <p>Faktury</p>
                </li>
                </a>
                <li class="nav-menu__item">
                    <i class="material-icons">assignment</i>
                    <p>Licencje</p>
                </li>
                <li class="nav-menu__item">
                    <i class="material-icons">devices</i>
                    <p>Sprzęty</p>
                </li>
                <a href="<?php echo STARTING_URL ?>/user/statistics">
                <li class="nav-menu__item">
                    <i class="material-icons">insert_chart</i>
                    <p>Statystyki</p>
                </li>
                </a>
                <li class="nav-menu__item">
                    <i class="material-icons">settings</i>
                    <p>Ustawienia użytkownika</p>
                </li>

            </ul>
            <form action="<?php echo STARTING_URL ?>/logout" method="post"><input class="button primary" type="submit"
                                                                                  value="Wyloguj"></form>
        </nav>
        <div class="content">
            <?php else: ?>
            <div class="content" style="grid-column: span 2; width: 100%;">
                <?php endif; ?>


                <?php echo $content ?>
            </div>

        </div>
    </div>
</div>
</body>
</html>