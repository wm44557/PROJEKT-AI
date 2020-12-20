
<div class="background">
    <div class="container">
        <nav class="nav">
            <div class="nav-logo">
                <img src="./images/logo.png">
            </div>
            <ul class="nav-menu">
                <li class="nav-menu__item">
                    <i class="material-icons">library_add</i>
                    <p>Dodaj fakturę</p>
                </li>
                <li class="nav-menu__item">
                    <i class="material-icons">history_edu</i>
                    <p>Faktury</p>
                </li>
                <li class="nav-menu__item">
                    <i class="material-icons">assignment</i>
                    <p>Licencje</p>
                </li>
                <li class="nav-menu__item">
                    <i class="material-icons">devices</i>
                    <p>Sprzęty</p>
                </li>
                <li class="nav-menu__item"></li>
                <li class="nav-menu__item"></li>
            </ul>
            <form  action="<?php echo STARTING_URL?>/logout" method="post"><input  class="button primary" type="submit" value="Wyloguj"></form>
        </nav>
        <div class="content">
            <h1>Panel User</h1>
            <a href="<?php echo STARTING_URL?>/user/add-invoice"><button>Dodaj fakture</button></a><br><br>
            <a href="<?php echo STARTING_URL?>/user/list-invoice"><button>Wyswietl faktury</button></a>
        </div>
    </div>
</div>



